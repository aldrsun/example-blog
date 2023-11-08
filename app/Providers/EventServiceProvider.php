<?php

namespace App\Providers;

use App\Event\PostCreated;
use App\Event\CommentCreated;
use App\Event\PostLikeCreated;
use App\Event\PostLikeDestroyed;
use App\Listeners\StorePost;
use App\Listeners\StoreComment;
use App\Listeners\StorePostLike;
use App\Listeners\DestroyPostLike;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PostCreated::class => [
            StorePost::class,
        ],
        CommentCreated::class => [
            StoreComment::class,
        ],
        PostLikeCreated::class => [
            StorePostLike::class,
        ],
        PostLikeDestroyed::class => [
            DestroyPostLike::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
