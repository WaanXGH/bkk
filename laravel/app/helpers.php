<?php


use App\Models\User;
use App\Models\relasi;
use App\Models\Loker;

use Illuminate\Support\Facades\Storage;

function get_setting_value($key)
{
    $data = User::where('key', $key)->first();
    if (isset($data->value)) {
        return $data->value;
    } else {
        return 'empty';
    }
}

function get_Loker()
{
    $data = Loker::all();
    return $data;
}

function get_relasi()
{
    $data = relasi::all();
    return $data;
}

function get_ImageUrl($path)
{
    if ($path && Storage::disk('public')->exists($path)) {
        dd(Storage::disk('public')->exists($path), $path);
    } else {
        return 'empty';
    } // Return null if the image doesn't exist
}
