<?php

namespace Modules\Notify\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'template',
    ];
}
