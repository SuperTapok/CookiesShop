<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Employee;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index () {
        $activities = Activity::all();

        return view('manage_activities', ['activities' => $activities]);
    }

    public function add_activity ()
    {
        return view('add_activity');
    }

    public function add_activity_api (Request $request) {
        $input = $request->all();

        $activity = new Activity();

        $activity->name =  $input['name'];
        $activity->cookies =  $input['cookies'];

        $activity->description = $input['description'] ?? "";

        $activity->save();

        return $this->successResponse([
            'message' => "Наградное действие добавлено!"
        ]);

    }

    public function edit_activity ($id)
    {
        $activity  = Activity::find($id);

        return view('edit_activity', ['activity' => $activity]);
    }

    public function edit_activity_api (Request $request) {
        $input = $request->all();

        $activity = Activity::find($input['id']);

        $activity->name =  $input['name'];
        $activity->cookies =  $input['cookies'];
        $activity->description = $input['description'] ?? "";

        $activity->save();

        return $this->successResponse([
            'message' => "Наградное действие изменено!"
        ]);
    }

    public function delete_activity ($id) {
        $activity = Activity::find($id);
        
        $activity->delete();

        return $this->successResponse([
            'message' => "Наградное действие удалено!"
        ]);
    }

    public function reward_employee ()
    {
        $employees = Employee::all();
        $activities = Activity::all();

        return view('reward_employee', ['activities' => $activities, 'employees' => $employees]);
    }

    public function reward_employee_api ()
    {
        $employee = Employee::where('id', request()->employee)->get()->first();
        $employee->activities()->attach([request()->activity => [
            'given_at' => date("Y-m-d H:i:s") 
        ]]);
        $employee->cookies_num += Activity::find(request()->activity)->cookies;
        $employee->save();

        return $this->successResponse([
            'message' => "Награждение начислено на счёт сотрудника!"
        ]);
    }
}
