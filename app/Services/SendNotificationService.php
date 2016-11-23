<?php

namespace App\Services;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Database\Eloquent\Model;

class SendNotificationService
{
    protected static $FCM_URL = 'https://fcm.googleapis.com/fcm/send';
    protected static $FCM_TOKEN = 'key=AIzaSyDWjzUsHpWI0K-ZNxdMOGteeUp0nTpP33A';
    
    protected $user;
    protected $alert;
    
    public function setUser(Model $user)
    {
        $this->user = $user;
        return $this;
    }
    
    public function setAlert(Model $alert)
    {
        $this->alert = $alert;
        return $this;
    }
    
    public function send()
    {
        $response = Curl::to(self::$FCM_URL)
            ->withHeader(
                "Authorization:" . self::$FCM_TOKEN
            )
            ->withData([
                'to' => $this->user->fcm_token,
                'notification' => [
                    'title' => 'MS Diary',
                    'body' => $this->alert->reminder->name,
                ]
            ])
            ->asJson()
            ->post();
        return $response;
    }
    
//    public static function send()
//    {
//        $response = Curl::to(self::$FCM_URL)
//            ->withHeader(
//                "Authorization:" . self::$FCM_TOKEN
//            )
//            ->withData([
//                'to' => 'cpv0iH5GyKs:APA91bGdW4zKwUiIlfjgd9b8hajfrrjkm9ZqGJfLrwSB0pSAsMeOJC_ixO1OgxX1Jyj_IRAI7SlBPMnpW83dvJr8rSI9WCrc3ZqToPrlpU4JmXsWD4stM6yJlKU743NemAnG8CiNbBc7',
//                'notification' => [
//                    'body' => 'from laravel'
//                ]
//            ])
//            ->asJson()
//            ->returnResponseObject()
//            ->post();
//        dump($response);
//    }
}