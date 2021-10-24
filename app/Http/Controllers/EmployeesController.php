<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Company;
use App\Notifications\CompanyNotify;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
       $this->middleware('auth');
     }

    public function index()
    {
      $employees = Employee::with('company')->get();
      return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $companies = Company::all();
      return view('employees.create', ['companies' => $companies]);
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
          'first_name'  => 'required|max:15',
          'last_name'   => 'required|max:15',
      ]);

      $insert = Employee::create([
          'first_name'   => $request->first_name,
          'last_name'    => $request->last_name,
          'email'        => $request->email,
          'phone'        => $request->phone,
          'company_id'   => $request->companies_id,
      ]);

      if ($insert) {
        $sendMail = Company::find($request->companies_id);
        $sendMail->notify(new CompanyNotify($request->email));
        return redirect()->route('employees.index');
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comp  = Company::find($id);
        return response()->json($comp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee  = Employee::find($id);
        $companies = Company::all();
        return response()->json(['employee' => $employee, 'company' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
          'first_name_edit'  => 'required|max:15',
          'last_name_edit'   => 'required|max:15',
      ]);

      $update = Employee::where('id', $id)->update([
          'first_name'   => $request->first_name_edit,
          'last_name'    => $request->last_name_edit,
          'email'        => $request->email_edit,
          'phone'        => $request->phone_edit,
          'company_id'   => $request->companies_id_edit,
      ]);

      if ($update) {
        return redirect()->route('employees.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $destroy = Employee::where('id', $id)->delete();
      if ($destroy) {
          return response()->json($destroy);
      }
    }
}
