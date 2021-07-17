<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurcheseConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $order_details)
    {
        $this->user_name = $user_name;
        $this->order_info = $order_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pusrche Confirm of Tohoney')
            ->markdown('mail.purchese-confirm', [
                'user_name' => $this->user_name,
                'order_info' => $this->order_info,
            ]);
    }
}
