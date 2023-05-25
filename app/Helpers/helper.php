<?php
use App\Setting;

function setting($key, $default = null)
{
    $id = auth()->check() ? auth()->id() : 1;
    return Setting::where('user_id', $id)->first()->value ?? $default;
}
