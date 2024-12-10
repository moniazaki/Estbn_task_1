<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $fillable = ['activity_type','description'];

    public function activityLogs(){
        return $this->hasMany(ActivityLog::class);
    }
}
