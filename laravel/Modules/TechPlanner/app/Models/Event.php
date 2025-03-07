<?php

namespace Modules\TechPlanner\Models;

class Event extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
