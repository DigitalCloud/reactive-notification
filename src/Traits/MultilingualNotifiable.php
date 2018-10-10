<?php

namespace Digitalcloud\MultilingualNotification\Traits;

use Digitalcloud\MultilingualNotification\Models\MultilingualDatabaseNotification;
use Illuminate\Notifications\Notifiable;

trait MultilingualNotifiable
{
    use Notifiable;

    public function notifications()
    {
        return $this->morphMany(MultilingualDatabaseNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
