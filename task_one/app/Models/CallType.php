<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallType extends Model
{
    protected $fillable = ['call_type','description'];

    public function activityLogs(){
        return $this->hasMany(ActivityLog::class);
    }
}
