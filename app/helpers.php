<?php

use App\Models\About;
use Illuminate\Support\Facades\Auth;

if (!function_exists('adminInfo')) {
    function adminInfo() {
        return \App\Models\About::first();
    }
}
