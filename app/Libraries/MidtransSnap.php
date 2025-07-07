<?php

namespace App\Libraries;

use Midtrans\Snap;
use Midtrans\Config;

class MidtransSnap
{
    public function __construct()
    {
        Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; 
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($params)
    {
        return Snap::createTransaction($params);
    }
}
