<?php

namespace App\Event;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// It executes the job but do not register anything to the database
class PostCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $requestData;

    /**
     * Create a new event instance.
     */
    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }
}
