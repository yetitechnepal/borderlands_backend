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
    public $req;
    public $pkg;
    public $com;
    public $book;
    public $quick;
    public function __construct($order,$package,$company,$quickdate,$quick)
    {
        $this->req = $order;
        $this->pkg = $package;
        $this->com = $company;
        $this->book = $quickdate;
        $this->quick = $quick;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('alish@alishmanandhar.com.np',$this->com['companyName'])
        ->subject("Payment Success - View Invoice")
        ->markdown("bac.mails.index")
        ->with('book',$this->book)
        ->with('pkg',$this->pkg)
        ->with('com',$this->com)
        ->with('quick',$this->quick)
        ;
    }
}
