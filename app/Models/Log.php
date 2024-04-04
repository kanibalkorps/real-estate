<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "ip_address",
        "user_id",
        "action"
    ];

    public static function error($action, $user = null){
        $ipAddress = Request::ip();
        self::create([
            'type' => "error",
            'ip_address' => $ipAddress,
            'user_id' => $user->id,
            'action' => $action
        ]);
    }

    public static function info($action, $user = null){
        $ipAddress = Request::ip();
        self::create([
            'type' => "info",
            'ip_address' => $ipAddress,
            'user_id' => $user->id,
            'action' => $action
        ]);
    }
}
