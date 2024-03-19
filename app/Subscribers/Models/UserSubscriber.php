<?php 

namespace App\Subscribers\Models;

use App\Events\Models\User\UserCreated;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Events\Dispatcher;


/**
 * - Event Subscriber is a class that let us to group our event -listener mappings in one place 
 * - We register Subscriber in the $subscribe property from the Event Service Provider
 * */
class UserSubscriber
{

    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserCreated::class, SendWelcomeEmail::class);
    }

}