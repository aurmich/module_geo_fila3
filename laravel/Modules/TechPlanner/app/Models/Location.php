<?php

namespace Modules\TechPlanner\Models;

class Location extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'name',
        'address',
        'city',
        'postal_code',
        'country',
    ];
}
