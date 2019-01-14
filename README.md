# LaravelEventStore

## 1. Setup dependency
```shell
composer require tlikai/laravel-event-store
```

## 2. Setup database
```shell
php artisan migrate
```

## 3. Implementation `ShouldBeStored` interface
```php

use App\User;
use Uniqueway\LaravelEventStore\ShouldBeStored;

class UserCreated implements ShouldBeStored
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // return stored event data
    public function getData()
    {
        return [
            'user_id' => $this->user->id,
        ];
    }
}
```

## 4. Fire events
```php
$user = User::create(['name' => 'likai'])
event(new UserCreated($user));
```

## Inspired by

* [rails_event_store](http://railseventstore.org)
* [ninjasimon/laravel-persistable-events](https://github.com/ninjasimon/laravel-persistable-events)
