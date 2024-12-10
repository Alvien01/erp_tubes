<?php

namespace App\Http\Controllers;

use App\Models\VendorIndividual;
use App\Models\VendorCompany;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;

class VendorIndividualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $individual = VendorIndividual::all();
        $company = VendorCompany::all();

        // Combine data from both tables
        $vendors = $individual->concat($company);

        return view('purchase.vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase.vendor.create-individual');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'nama_perusahaan' => 'required',
                'alamat' => 'required',
                'telp' => 'required|numeric', // Add numeric validation
                'email' => 'required|email', // Add email validation
                'posisi_pekerjaan' => 'required',
            ]);

            $input = $request->all();

            VendorIndividual::create($input);

            return redirect('/purchase/vendor')->with('message', 'Data Berhasil ditambahkan');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorIndividual  $vendorIndividual
     * @return \Illuminate\Http\Response
     */
    public function show(VendorIndividual $vendorIndividual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorIndividual  $vendorIndividual
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorIndividual $vendorIndividual, $id)
    {
        $individual = VendorIndividual::find($id);
        return view('purchase.vendor.edit-individual', compact('individual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorIndividual  $vendorIndividual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorIndividual $vendorIndividual, $id)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'nama_perusahaan' => 'required',
                'alamat' => 'required',
                'telp' => 'required|numeric', // Add numeric validation
                'email' => 'required|email', // Add email validation
                'posisi_pekerjaan' => 'required',
            ]);
            $individual = VendorIndividual::find($id);

            $input = $request->all();

            $individual->update($input);

            return redirect('/purchase/vendor')->with('message', 'Data Berhasil ditambahkan');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorIndividual  $vendorIndividual
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorIndividual $vendorIndividual, $id)
    {
        $individual = VendorIndividual::find($id);
        $individual->delete();

        return redirect('/purchase/vendor')->with('message', 'Data Berhasil dihapus');
    }
}
