<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeSchedule;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeScheduleRequest;
use Illuminate\Support\Facades\Auth;
use Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;


class EmployeeScheduleController extends Controller
{
    private EmployeeSchedule $schedule;
    private Employee $employee;

    public function __construct(EmployeeSchedule $schedule, Employee $employee)
    {
        $this->schedule = $schedule;
        $this->employee = $employee;
    }

    public function index()
    {
        $schedules = $this->schedule::with('employee')->get();
        return view('employee_schedules.index')->with([
            'schedules' => $schedules
        ]);
    }

    public function create()
    {
        $employees = $this->employee::all();
        return view('employee_schedules.create')->with([
            'employees' => $employees
        ]);
    }

    public function store(StoreEmployeeScheduleRequest $request)
    {
        $employeeId = $request->post('employee_id');
        $employee = $this->employee::where('employee_id', $employeeId)->firstOrFail();
        $scheduleYear = date('Y', strtotime($request->post('schedule_date')));

        // Verify is chosen date is not a holiday
        $holidays = json_decode(Http::get("https://date.nager.at/Api/v2/PublicHolidays/$scheduleYear/$employee->country_code"));

        $scheduleDate = $request->post('schedule_date');
        $scheduleConflict = [];
        foreach($holidays as $holiday)
        {
            if($scheduleDate == $holiday->date){
                $scheduleConflict[] = $holiday->name;
            }
        }
        if(empty($scheduleConflict)){
            $this->schedule->employee_id = $employeeId;
            $this->schedule->title = $request->post('title');
            $this->schedule->details= $request->post('details');
            $this->schedule->schedule_date = $request->post('schedule_date');
            $this->schedule->schedule_start_time = $request->post('schedule_start_time');
            $this->schedule->schedule_end_time = $request->post('schedule_end_time');
            $this->schedule->is_active = TRUE;
            $this->schedule->created_by = Auth::id();
            $this->schedule->save();

            return back()->with([
                'success' => 'Successfully Created Employee Schedule!'
            ]);
        }
        else{
            $scheduleConflicts = implode(',', $scheduleConflict);
            return back()->with([
                'failed' => "Chosen Schedule Date is: $scheduleConflicts. Please choose another date."
            ]);
        }
    }

    public function show($id)
    {
        $employeeSchedule = $this->schedule::findOrFail(Crypt::decryptString($id));
        return view('employee_schedules.show')->with([
            'schedule' => $employeeSchedule 
        ]);
    }

    public function edit($id)
    {
        $employees = $this->employee::all();
        $employeeSchedule = $this->schedule::findOrFail(Crypt::decryptString($id));

        return view('employee_schedules.edit')->with([
            'employees' => $employees,
            'schedule' => $employeeSchedule 
        ]);
    }

    public function update(StoreEmployeeScheduleRequest $request, $id)
    {
        $schedule = $this->schedule::find(Crypt::decryptString($id));
        $employeeId = $request->post('employee_id');
        $employee = $this->employee::where('employee_id', $employeeId)->firstOrFail();
        $scheduleYear = date('Y', strtotime($request->post('schedule_date')));

        // Verify is chosen date is not a holiday
        $holidays = json_decode(Http::get("https://date.nager.at/Api/v2/PublicHolidays/$scheduleYear/$employee->country_code"));

        $scheduleDate = $request->post('schedule_date');
        $scheduleConflict = [];
        foreach($holidays as $holiday)
        {
            if($scheduleDate == $holiday->date){
                $scheduleConflict[] = $holiday->name;
            }
        }
        if(empty($scheduleConflict)){
            $schedule->employee_id = $employeeId;
            $schedule->title = $request->post('title');
            $schedule->details= $request->post('details');
            $schedule->schedule_date = $request->post('schedule_date');
            $schedule->schedule_start_time = $request->post('schedule_start_time');
            $schedule->schedule_end_time = $request->post('schedule_end_time');
            $schedule->is_active = $request->post('is_active');
            $schedule->created_by = Auth::id();
            $schedule->save();

            return back()->with([
                'success' => 'Successfully Updated Employee Schedule!'
            ]);
        }
        else{
            $scheduleConflicts = implode(',', $scheduleConflict);
            return back()->with([
                'failed' => "Chosen Schedule Date is: $scheduleConflicts. Please choose another date."
            ]);
        }
    }

    public function destroy($id)
    {
        $schedule = $this->schedule::find(Crypt::decryptString($id));
        $schedule->delete();

        return back()->with([
            'success' => 'Schedule Successfully Deleted!',
        ]);
    }
}
