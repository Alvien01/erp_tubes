<?php

namespace App\Http\Controllers;

use App\Models\VendorCompany;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;


class VendorCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase.vendor.create-company');
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
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|numeric', // Add numeric validation
            'email' => 'required|email', // Add email validation
        ]);

        $input = $request->all();

        VendorCompany::create($input);

        return redirect('/purchase/vendor')->with('message', 'Data Berhasil ditambahkan');
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
        $company = VendorCompany::find($id);
        return view('purchase.vendor.edit-company', compact('company'));
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
        try {
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'telp' => 'required|numeric', // Add numeric validation
                'email' => 'required|email', // Add email validation
            ]);

            $company = VendorCompany::find($id);

            $input = $request->all();
            $company->update($input);

            return redirect('/purchase/vendor')->with('message', 'Data Berhasil ditambahkan');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
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
        $company = VendorCompany::find($id);
        $company->delete();

        return redirect('/purchase/vendor')->with('message', 'Data Berhasil dihapus');
    }
}
