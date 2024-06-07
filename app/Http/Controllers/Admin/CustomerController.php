<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Customer::orderBy('created_at', 'asc')->get();
            return  Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='d-flex justify-content-center '>
                <a href='".route('admin.customer-edit',$row->id)."'class='edit btn  btn-sm mx-1'><i class='fa-solid fa-pen-to-square' style='color:green'></i></a>
                <a href='".route('admin.customer-delete',$row->id)."' class='delete btn  btn-sm mx-1'><i class='fa-solid fa-trash'style='color:red'></i></a>
                </div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.customers.customer-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::get();

        return view('admin.customers.customer-create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // Validation rules
          $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20', // Adjust max length accordingly
            'id_card_number' => 'required|string|max:20', // Adjust max length accordingly
            'company_id' => 'required|exists:companies,id',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20', // Adjust max length accordingly
            'other_details' => 'nullable|string|min:10',
        ]);

        // Create a new Customer
        $customer = Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'id_card_number' => $request->input('id_card_number'),
            'company_id' => $request->input('company_id'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code'),
            'other_details' => $request->input('other_details'),
        ]);

        // Optionally, you can redirect the user with a success message
        return redirect()->route('admin.customer-list')->with('success', 'Customer added successfully');
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
        $customerEdit = Customer::findorFail($id);
        $companies = Company::all();
        // return $customerEdit;

        return view('admin.customers.customer-edit', compact('customerEdit','companies'));




    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customerEdit = Customer::findorFail($id);

        return $customerEdit;

    }
}
