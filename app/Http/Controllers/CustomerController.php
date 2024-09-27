<?php

namespace App\Http\Controllers;

use App\Models\CustomerIndividual;
use App\Models\CustomerCompany;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $individual = CustomerIndividual::all();
        $company = CustomerCompany::all();

        // Combine data from both tables
        $customer = $individual->concat($company);
        return view('sales.customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateIndividual()
    {
        $individual = CustomerIndividual::all();
        return view('sales.customer.create-individual');
    }

    public function CreateCompany()
    {
        return view('sales.customer.create-company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreIndividual(Request $request)
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

            CustomerIndividual::create($input);

            return redirect('/sales/customer')->with('message', 'Data Berhasil ditambahkan');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
    public function StoreCompany(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|numeric', // Add numeric validation
            'email' => 'required|email', // Add email validation
        ]);

        $input = $request->all();

        CustomerCompany::create($input);

        return redirect('/sales/customer')->with('message', 'Data Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerIndividual  $customerIndividual
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerIndividual $customerIndividual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerIndividual  $customerIndividual
     * @return \Illuminate\Http\Response
     */
    public function editCompany(CustomerCompany $customerCompany, $id)
    {
        $company = CustomerCompany::find($id);
        return view('sales.customer.edit-company', compact('company'));
    }
    public function editIndividual(CustomerIndividual $customerIndividual, $id)
    {
        $individual = CustomerIndividual::find($id);
        return view('sales.customer.edit-individual', compact('individual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerIndividual  $customerIndividual
     * @return \Illuminate\Http\Response
     */
    public function updateIndividual(Request $request, CustomerIndividual $customerIndividual, $id)
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
            $individual = CustomerIndividual::find($id);

            $input = $request->all();

            $individual->update($input);

            return redirect('/sales/customer')->with('message', 'Data Berhasil ditambahkan');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
    public function updateCompany(Request $request, CustomerCompany $customerCompany, $id)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'telp' => 'required|numeric', // Add numeric validation
                'email' => 'required|email', // Add email validation
            ]);

            $company = CustomerCompany::find($id);

            $input = $request->all();
            $company->update($input);

            return redirect('/sales/customer')->with('message', 'Data Berhasil ditambahkan');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerIndividual  $customerIndividual
     * @return \Illuminate\Http\Response
     */
    public function destroyIndividual(CustomerIndividual $customerIndividual, $id)
    {
        $individual = CustomerIndividual::find($id);
        $individual->delete();

        return redirect('/sales/customer')->with('message', 'Data Berhasil dihapus');
    }
    public function destroyCompany(CustomerCompany $customerCompany, $id)
    {
        $company = CustomerCompany::find($id);
        $company->delete();

        return redirect('/sales/customer')->with('message', 'Data Berhasil dihapus');
    }
}
