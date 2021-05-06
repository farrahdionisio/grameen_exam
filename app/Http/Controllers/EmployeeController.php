<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Support\Facades\Crypt;

class EmployeeController extends Controller
{
    private Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function index()
    {
        $employees = $this->employee::all();
        return view('employees.index')->with([
            'employees' => $employees
        ]);
    }

    public function create()
    {
        $countries = Http::get('https://date.nager.at/Api/v2/AvailableCountries'); // Get all available countries from api

        return view('employees.create')->with([
            'countries' => json_decode($countries)
        ]);
    }


    public function store(StoreEmployeeRequest $request)
    {
        $this->employee->employee_id = $request->post('employee_id');
        $this->employee->name = $request->post('name');
        
        $countryCode = $request->post('country_code');
        $this->employee->country_code = $countryCode;
        $countryName = json_decode(Http::get('https://date.nager.at/Api/v2/CountryInfo?countryCode=' . $countryCode));
        $this->employee->country_name = $countryName->commonName;
        $this->employee->save();

        return back()->with([
            'success' => 'Successfully Created Employee Record!'
        ]);
       
    }


    public function show($id)
    {
        $employee = $this->employee::where('employee_id', Crypt::decryptString($id))
                                            ->with('employee_schedule')
                                            ->get();
        return view('employees.show')->with([
            'employee' => $employee[0]
        ]);
    }


    public function edit($id)
    {
        $employee = $this->employee::findOrFail(Crypt::decryptString($id));
        $countries = json_decode(Http::get('https://date.nager.at/Api/v2/AvailableCountries')); 
        
        return view('employees.edit')->with([
            'employee' => $employee,
            'countries' => $countries
        ]);
    }


    public function update(StoreEmployeeRequest $request, $id)
    {
        $employee = $this->employee::find(Crypt::decryptString($id));
        $employee->employee_id = $request->post('employee_id');
        $countryCode = $request->post('country_code');
        $employee->country_code = $countryCode;
        $countryName = json_decode(Http::get('https://date.nager.at/Api/v2/CountryInfo?countryCode=' . $countryCode));
        $employee->country_name = $countryName->commonName;
        $employee->save();

        return back()->with([
            'success' => 'Successfully Updated Employee Record!',
        ]);
    }


    public function destroy($id)
    {
        $employee = $this->employee::find(Crypt::decryptString($id));
        $employee->delete();
        return back()->with([
            'success' => 'Employee Successfully Deleted!',
        ]);
    }

    public function showEmployees()
    {
        $employees = $this->employee::all();
        return $employees;
    }
}
