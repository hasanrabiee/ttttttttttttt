<?php

namespace App\Jobs;

use App\Speaker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FinishStream implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $StreamID;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ID)
    {
        $this->StreamID = $ID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Speaker = Speaker::find($this->StreamID);
        $Speaker->StreamID = null;
        $Speaker->StreamUrl = null;
        $Speaker->HaveStreamKey = 'No';
        $Speaker->save();



    }
}
