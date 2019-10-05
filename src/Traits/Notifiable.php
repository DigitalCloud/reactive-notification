<?php

namespace Digitalcloud\ReactiveNotification\Traits;

use Digitalcloud\ReactiveNotification\Models\DatabaseNotification;
use Illuminate\Notifications\Notifiable as BaseNotifiable;

trait Notifiable
{
    use BaseNotifiable;

    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
