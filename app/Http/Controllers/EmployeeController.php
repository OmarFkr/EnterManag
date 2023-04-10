<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
     /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $employees = Employee::orderBy('id','desc')->paginate(5);

        return response()->json([
            'http response status codes' => '200',
            'employees' => $employees,
        ]);
        
        //return view('companies.index', compact('companies'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('companies.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        $employee = Employee::create($request->post());

        return response()->json([
            'http response status codes' => '200',
            'employee' => $employee,
        ]);

        //return redirect()->route('companies.index')->with('success','Company has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Employee  $employee
    * @return \Illuminate\Http\Response
    */
    public function show(Employee $employee)
    {
        return response()->json([
            'http response status codes' => '200',
            'employee' => $employee,
        ]);

        //return view('companies.show',compact('company'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Employee  $employee
    * @return \Illuminate\Http\Response
    */
    public function edit(Employee $employee)
    {
        return view('employees.edit',compact('employee'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Employee  $employee
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        $updatedEmployee = $employee->fill($request->post())->save();

        return response()->json([
            'http response status codes' => '200',
            'updatedEmployee' => $updatedEmployee,
        ]);

        //return redirect()->route('companies.index')->with('success','Company Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Employee  $employee
    * @return \Illuminate\Http\Response
    */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'http response status codes' => '200',
            'deletedEmployee' => $employee,
        ]);

        //return redirect()->route('companies.index')->with('success','Company has been deleted successfully');
    }
}
