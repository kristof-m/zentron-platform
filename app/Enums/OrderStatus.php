<?php

namespace App\Enums;

enum OrderStatus: string
{
    case InCart = 'in_cart';
    case Confirmed = 'confirmed';
    case Paid = 'paid';
    case Shipped = 'shipped';
}
