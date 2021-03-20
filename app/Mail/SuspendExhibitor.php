<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class SuspendExhibitor extends Mailable
{


    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $boothInfo;

    public function __construct($booth)
    {
        $this->boothInfo=$booth;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.suspendExhibitor')->with([
            "booth"=>$this->boothInfo
        ]);;
    }
}
