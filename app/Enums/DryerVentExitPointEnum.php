<?php declare(strict_types=1);

namespace App\Enums;
use App\Enums\Enumeration;

class DryerVentExitPointEnum extends Enumeration
{
    const ZEROTOTENFEET = '0-10 Feet Off the Ground';
    const TENPLUSFEET = '10+ Feet Off the Ground';
    const ROOFTOP = 'Rooftop';

}