<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    //show
    public function show($id)
    {
        $company = Company::find(1);
        return view('pages.company.show', compact('company'));
    }

    //edit
    public function edit()
    {
        $company = Company::find(1);
        return view('pages.company.edit', compact('company'));
    }

    //update
    public function update(Request $request, Company $company)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius_km' => 'required',
            'phone' => 'required',
            'tlp' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        #update
        $request->update($request->all());

        return redirect()->route('company.show')->with('success', 'Company updated successfully');
    }
}
