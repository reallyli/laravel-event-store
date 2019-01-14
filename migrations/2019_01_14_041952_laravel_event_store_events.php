<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaravelEventStoreEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_event_store_events', function (Blueprint $table) {
            $table->string('id')->length(36)->primary();
            $table->string('event_class')->length(1000);
            $table->json('metadata');
            $table->json('data');
            $table->datetime('created_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laravel_event_store_events');
    }
}
