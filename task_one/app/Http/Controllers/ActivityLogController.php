<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(){
        $activityLogs = ActivityLog::with(['activityType','callType'])->get();
        return response()->json($activityLogs,200);
    }

    public function show($id){
        $activityLogs = ActivityLog::with(['activityType','callType'])->find($id);
        if(!$activityLogs){
            return response()->json(['error'=>'This Activity Log is not found'],404);
        }
        return response()->json($activityLogs,200);
    }

    public function store(Request $request){

        $validated = $request->validate([
            'activity_types_id' =>'required|exists:activity_types,id',
            'call_types_id' => 'required|exists:call_types,id',
            'operator_comment' => 'nullable|string|max:255',
            'user_comment' => 'nullable|string|max:255'
        ]);

        $activityLog = ActivityLog::create($validated);
        return response()->json($activityLog,201);
    }

    public function update(Request $request,$id){

        $activityLog = ActivityLog::find($id);
        if(!$activityLog){
            return response()->json(['error'=>'This Activity Log is not found'],404);
        }
        $validated = $request->validate([
            'activity_types_id' =>'sometimes|exists:activity_types,id',
            'call_types_id' => 'sometimes|exists:call_types,id',
            'operator_comment' => 'nullable|string|max:255',
            'user_comment' => 'nullable|string|max:255'
        ]);

        $activityLog->update($validated);
        return response()->json($activityLog,200);
    }

    public function destroy($id){
        $activityLog = ActivityLog::find($id);
        if(!$activityLog){
            return response()->json(['error'=>'This Activity Log is not found'],404);
        }
        $activityLog->delete();
        return response()->json(['success'=>'This Activity Log is deleted successfully'],200);
    }
}
