<?php

namespace Digitalcloud\ReactiveNotification\Traits;

use Digitalcloud\ReactiveNotification\Models\DatabaseNotification;

trait Notifiable
{
    use Illuminate\Notifications\Notifiable;

    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
