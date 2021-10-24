<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Company;
use App\User;
use Auth;

class CompaniesController extends Controller
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
        $companies = Company::all();
        return view('companies.index', ['companies' => $companies]);
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
        $logo_path = 'logo/' . Auth::user()->id .'';
        $file_name = $request->file('logo_file')->getClientOriginalName();

        $request->validate([
            'company_name'  => 'required|max:50',
        ]);

        $insert = Company::create([
            'name'      => $request->company_name,
            'email'     => $request->email,
            'logo'      => $logo_path .'/' . $file_name,
            'website'   => $request->website,
        ]);

        if ($insert->save()) {
            $path = Storage::putFileAs('public/'.$logo_path, $request->file('logo_file'), $file_name);
            return redirect()->route('companies.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $company  = Company::find($id);
      return response()->json($company);
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
      $logo_path  = 'logo/' . Auth::user()->id .'';
      $file_name  = $request->file('logo_file')->getClientOriginalName();

      $request->validate([
          'company_name'  => 'required|max:50',
      ]);

      $update = Company::where('id', $id)->update([
          'name'      => $request->company_name,
          'email'     => $request->email,
          'logo'      => $logo_path .'/' . $file_name,
          'website'   => $request->website,
      ]);

      if ($update) {
          $path = Storage::putFileAs('public/'.$logo_path, $request->file('logo_file'), $file_name);
          return redirect()->route('companies.index')->with('success', 'Data berhasil diupdate!');
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
      $getData = Company::find($id);
      $destroy = Company::where('id', $id)->delete();
      if ($destroy) {
          Storage::delete('public/' . $getData->logo);
          return response()->json($destroy);
      }
    }

}
