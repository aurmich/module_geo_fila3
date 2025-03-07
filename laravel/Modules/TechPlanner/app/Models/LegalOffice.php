<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

/**
 * Class LegalOffice.
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 */
class LegalOffice extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];
}
