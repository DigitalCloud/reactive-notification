# Reactive Laravel Notification

## Installation

[PHP](https://php.net) >=5.6 and [Laravel](http://laravel.com) ^5.3 are required.

To get the latest version of Reactive Laravel notification, simply require the project using [Composer](https://getcomposer.org):

```bash
composer require digitalcloud/reactive-notification
```

publishing migration file
```bash
php artisan vendor:publish --provider="Digitalcloud\ReactiveNotification\ReactiveNotificationServiceProvider"
```

migrate published migration files 
```bash
php artisan migrate
```

## Usage

1. Change trait used in model from `Illuminate\Notifications\Notifiable` to `Digitalcloud\ReactiveNotification\Traits\Notifiable`
```PHP
<?php

namespace App;

use Digitalcloud\ReactiveNotification\Traits\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
}
```

2. Change delivery channel from `database` or `DatabaseChannel` to `Digitalcloud\ReactiveNotification\Channels\DatabaseChannel`
```PHP
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Digitalcloud\ReactiveNotification\Channels\DatabaseChannel;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return [DatabaseChannel::class,'.../'];
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
$result = $user->notifications()->first()->data;
```
the result will be
`[
             "title" => "Invoice title",
             "details" => "Invoice details"
 ]`
 
then change the old language from `en` into `ar`
 ```PHP
\App::setLocale("ar");
$result = $user->notifications()->first()->data;
```
and the result will be
`[
             "title" => "عنوان الفاتورة",
             "details" => "تفاصيل الفاتورة"
 ]`
