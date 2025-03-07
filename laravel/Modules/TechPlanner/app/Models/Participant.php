<?php

namespace Modules\TechPlanner\Models;

class Participant extends BaseModel
{
    /* @var list<string> */

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
}
