<?php

namespace Modules\Family\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SmsVerify
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public string $mobile;

  /**
   * Create a new event instance.
   */
  public function __construct(string $mobile)
  {
    $this->mobile = $mobile;
  }

  /**
   * Get the channels the event should be broadcast on.
   */
  public function broadcastOn(): array
  {
    return [
      new PrivateChannel('channel-name'),
    ];
  }

}
