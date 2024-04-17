<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CustomerService;
use App\Models\Customer;

use Yajra\DataTables\Facades\Datatables;

class CustomerServiceController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            // $data = PreSalesService::orderBy('created_at', 'asc')->get();
            $data = CustomerService::with('customer')->latest()->get();
            return  Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='d-flex justify-content-center '>
                <a href='".route('admin.crm-salesServices-edit',$row->id)."' class='edit btn btn-success btn-sm mx-1'>Edit</a>
                <a href='".route('admin.crm-salesServices-delete',$row->id)."' class='delete btn btn-danger btn-sm mx-1'>Delete</a>

                </div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.customer-services.customer-services-list');
    }

    public function create()
    {
        $customers = Customer::all();
        // $products = Product::all();
        // return view('admin.sale-services.sales-services-create', compact('customers'));
        return view('admin.customer-services.customer-services-create',compact('customers'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,processing,completed',
        ]);

        // Create a new customer service entry
        $customerService = new CustomerService();
        $customerService->customer_id = $validatedData['customer_id'];
        $customerService->service_name = $validatedData['service_name'];
        $customerService->description = $validatedData['description'];
        $customerService->status = $validatedData['status'];
        $customerService->save();

        // Redirect back with a success message
        return redirect()->route('admin.customer.service-list')->with('success', 'Customer service created successfully.');
    }

    public function edit($id)
    {
        $sales = Sales::find($id);
        return $sales;
    }
    public function Update(Request $request,$id)
    {
        $sales = Sales::find($id);
        return $sales;
    }
    public function destroy($id)
    {
        $sales = Sales::find($id);
        return $sales;
    }

}
