# Laravel Multilingual Notification
Multilingual database notifications for laravel.

This package is designed for store notification once in the database then loading it in several languages.
 

## Installation

[PHP](https://php.net) >=7.1.0 and [Laravel](http://laravel.com) ^5.3 are required.

To get the latest version of Laravel multilingual notification, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require digitalcloud/multilingual-notification
```

publishing migration file
```bash
$ php artisan vendor:publish --provider="Digitalcloud\\MultilingualNotification\\MultilingualNotificationServiceProvider"
```

## Usage

1. Change trait used in model from `notifable` to `MultilingualNotifiable`
```PHP
<?php

namespace App;

use Digitalcloud\MultilingualNotification\Traits\MultilingualNotifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use MultilingualNotifiable;
}
```

2. Change delivery channel from `database` or `DatabaseChannel` to `DBChannel`
```PHP
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Digitalcloud\MultilingualNotification\Channels\DBChannel;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return [DBChannel::class,'.../'];
    }
    
    
    public function toDatabase($notifiable){
        return [
          "title"=> trans("invoice_title"),
          "details"=> trans("invoice_details"),
        ];
    }
}
```

## Example
```PHP
$user->notify(new InvoicePaid($invoice));

\App::setLocale("en");
$result = $user->notification()->first()->data;
```
the result will be
`[
             "title" => "Invoice title",
             "details" => "Invoice details",
 ]`
 
then change the old language from en into ar
 ```PHP
\App::setLocale("ar");
$result = $user->notification()->first()->data;
```
and the result will be
`[
             "title" => "عنوان الفاتورة",
             "details" => "تفاصيل الفاتورة",
 ]`