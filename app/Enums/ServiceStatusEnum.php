<?php declare(strict_types=1);

namespace App\Enums;

use App\Enums\Enumeration;

class ServiceStatusEnum extends Enumeration
{
    public const REQUEST_RECEIVED = 'Request Received';
    public const PENDING = 'Pending';
    public const IN_PROGRESS = 'In Progress';
}
