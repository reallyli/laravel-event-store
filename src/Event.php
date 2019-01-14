<?php

namespace Uniqueway\LaravelEventStore;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Event extends Model
{
    public $guarded = [];

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'laravel_event_store_events';

    protected $casts = [
        'data' => 'json',
        'metadata' => 'json',
    ];

    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->id = Uuid::uuid4()->toString();
        });
    }

    /**
     * Create from laravel event
     *
     * @param ShouldBeStored $event
     * @return Event
     */
    public static function createFromEvent(ShouldBeStored $event) : Event
    {
        $storedEvent = new static;
        $storedEvent->event_class = get_class($event);
        $storedEvent->data = $event->getData();
        $storedEvent->created_at = Carbon::now();
        $storedEvent->metadata = [
            'timestamp' => $storedEvent->created_at->toDateTimeString()
        ];

        $storedEvent->saveOrFail();

        return $storedEvent;
    }
}
