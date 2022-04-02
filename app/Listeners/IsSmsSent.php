<?php

namespace App\Listeners;
use  App\Models\SMS;
use App\Events\SendingSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsSmsSent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendingSms $event)
    {
     
        Log::info($event->data);
      $sms=$event->data;
        Log::info($sms['phone']);
        DB::table('s_m_s')->insert([
            'phone'=>$sms['phone'],
            'message'=>$sms['message'],
            'rType'=>$sms['rType'],
            'status'=>$sms['status'],
        ]);
      
        return response()->json([
            'success'=>true,
            'message'=>'Sms Added'
        ]);
        // Log::info("message");
    }
}
