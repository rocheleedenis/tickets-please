<?php

namespace App\Enums;

enum StatusEnum: string
{
    case ACTIVE = 'A';
    case HOLD = 'H';
    case CLOSED = 'C';
    case CANCELLED = 'X';
}