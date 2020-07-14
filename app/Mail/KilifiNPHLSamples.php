<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KilifiNPHLSamples extends Mailable
{
    use Queueable, SerializesModels;

    public $samples;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($samples)
    {
        $this->samples = $samples;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Kilifi Samples Submitted to NPHL")->view('mail.kilifi');
    }
}
