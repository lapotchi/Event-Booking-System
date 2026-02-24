<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case SUCCESS = 'sucess';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
}