<?php

declare(strict_types=1);

namespace Modules\Notify\Datas;

use Illuminate\Notifications\Notification;
use Modules\Notify\Models\Notification as NotificationModel;
use Spatie\LaravelData\Data;

class NotificationData extends Data {
    // public string $mobile_phone;
    // public string $token;
    // public int $q;
    public string $from;
    public ?string $from_email=null;
    public string $to;
    public ?string $subject=null;
    public ?string $body_html=null;
    public string $body;
    public array $channels=[];




     /** Get the notification routing information for the given driver.
     *
     * @param string $driver
     *
     * @return mixed
     */
    public function routeNotificationFor($driver,Notification $notification) {
        //dddx(['driver'=>$driver,'a'=>$a]);
        //return $this->routes[$driver] ?? null;
        if($driver=='database'){
            return app(NotificationModel::class);
        }
        return $this->to;
    }
    
}
