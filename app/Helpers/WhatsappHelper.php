<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappHelper
{
    public static function send($to, $message)
    {
        $sid   = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from  = env('TWILIO_WHATSAPP_FROM', 'whatsapp:+14155238886'); // default to sandbox

        // ✅ Normalize number:
        // strip "whatsapp:" if user accidentally passes it
        $to = preg_replace('/^whatsapp:/', '', $to);

        // make sure it starts with +
        if (strpos($to, '+') !== 0) {
            $to = '+' . $to;
        }

        // add whatsapp: back
        $to = "whatsapp:$to";

        // Debug log
        Log::info('WhatsApp Payload', [
            'from' => $from,
            'to'   => $to,
            'body' => $message,
        ]);

        // Send to Twilio
        $response = Http::withBasicAuth($sid, $token)->asForm()->post(
            "https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json",
            [
                'From' => $from,
                'To'   => $to,
                'Body' => $message,
            ]
        );

        if ($response->failed()) {
            Log::error('Twilio Error', $response->json());
        } else {
            Log::info('Twilio Success', $response->json());
        }

        return $response->successful();
    }
}
