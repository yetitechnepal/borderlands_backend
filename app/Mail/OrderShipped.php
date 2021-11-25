<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@theyetitech.com',"Yeti Tech Nepal")
        ->subject("Payment Success")
        ->markdown("bac.mails.index")
        ->with([
            'name' => "Yeti Tech",
            'link' => 'facebook.com'
        ]);
    }
}
