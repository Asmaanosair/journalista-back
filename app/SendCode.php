<?php


namespace App;


class SendCode
{

    public static function sendCode($phone)
    {

        $basic  = new \Nexmo\Client\Credentials\Basic('ec4ff442', 'xGjhuBOtXjZ0Vs0i');

        $client = new \Nexmo\Client($basic);

        $code = rand(1111, 9999);


        $message = $client->message()->send([
            'to' => $phone,
            'from' => 'Journalista',
            'text' => 'Hello from Jounalista SMS Your Code Verification'.$code
        ]);

        return $code ;
    }
}
