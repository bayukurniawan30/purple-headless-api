<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Orion\Http\Controllers\Controller;

class SettingsController extends Controller
{
    protected $model = Setting::class;
}
