<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Company::orderBy('created_at', 'asc')->get();
            return  Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='d-flex justify-content-center '>
                <a href='".route('admin.company-edit',$row->id)."' class='edit btn  btn-sm mx-1'><i class='fa-solid fa-pen-to-square' style='color:green'></i></a>
                <a href='".route('admin.company-delete',$row->id)."'class='delete btn  btn-sm mx-1'><i class='fa-solid fa-trash'style='color:red'></i></a>
                </div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.companies.company-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.companies-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'industry' => 'required',
        'size' => 'required|numeric',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'zip_code' => 'required|numeric',
        'phone' => 'required|numeric',
        'email' => 'required|email',
    ]);

    Company::create($request->all());
    return redirect()->route('admin.company-list')->with('success', 'Company added successfully');


}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companyData =  Company::findorFail($id);

        return view('admin.companies.companies-edit', compact('companyData'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // Validation rules for company update
            $request->validate([
                'name' => 'required|string|max:255',
                'industry' => 'required|string|max:255',
                'size' => 'required|numeric',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'zip_code' => 'required|numeric|digits:5', // Adjust digits as needed
                'phone' => 'required|numeric|digits:11', // Adjust digits as needed
                'email' => 'required|email|max:255',
                // Add other validation rules as needed
            ]);

            // Find the company by ID
            $updateCompany = Company::findOrFail($id);

            // Update company fields
            $updateCompany->update([
                'name' => $request->input('name'),
                'industry' => $request->input('industry'),
                'size' => $request->input('size'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip_code' => $request->input('zip_code'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                // Add other fields as needed
            ]);

            // Redirect with success message
            return redirect()->route('admin.company-list')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);

        // Delete the company
        $company->delete();

        // Redirect with success message
        return redirect()->route('admin.company-list')->with('success', 'Company deleted successfully');

    }
}
