<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['activity_types_id','call_types_id','operator_comment','user_comment'];

    public function activityType(){
        return $this->belongsTo(ActivityType::class,'activity_types_id');
    }

    public function callType(){
        return $this->belongsTo(CallType::class,'call_types_id');
    }
}
