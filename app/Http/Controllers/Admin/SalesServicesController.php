<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SalesService;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Payment;
use Yajra\DataTables\Facades\DataTables;


class SalesServicesController extends Controller
{
    public function index(Request $request){
        $data = SalesService::with(['customer', 'product', 'payment'])->get();
        // return $data;

        if ($request->ajax()) {
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('product_name', function($row) {
                    return $row->product->name;
                })
                ->addColumn('customer_name', function($row) {
                    return $row->customer->name;
                })
                ->addColumn('quantity', function($row) {
                    return $row->quantity;
                })
                ->addColumn('price', function($row) {
                    return $row->price;
                })
                ->addColumn('total_price', function($row) {
                    return $row->total_price;
                })
                ->addColumn('payment_status', function($row) {
                    return $row->payment ? $row->payment->payment_status : '';
                })
                ->addColumn('transaction_type', function($row) {
                    return $row->payment ? $row->payment->transaction_type : '';
                })
                ->addColumn('amount_paid', function($row) {
                    return $row->payment ? $row->payment->amount : '';
                })
                ->addColumn('transaction_id', function($row) {
                    return $row->payment ? $row->payment->transaction_id : '';
                })
                ->addColumn('payment_method', function($row) {
                    return $row->payment ? $row->payment->payment_method : '';
                })
                ->addColumn('bank_name', function($row) {
                    return $row->payment ? $row->payment->bank_name : '';
                })
                ->addColumn('bank_account_number', function($row) {
                    return $row->payment ? $row->payment->bank_account_number : '';
                })
                ->addColumn('transaction_reference', function($row) {
                    return $row->payment ? $row->payment->transaction_reference : '';
                })
                ->addColumn('action', function($row) {
                    $actionBtn = "<div class='d-flex justify-content-center '>
                        <a href='".route('admin.crm-salesServices-edit',$row->id)."' class='edit btn btn-success btn-sm mx-1'>Edit</a>
                        <a href='".route('admin.crm-salesServices-delete',$row->id)."' class='delete btn btn-danger btn-sm mx-1'>Delete</a>
                    </div>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
            return view('admin.sale-services.sales-services-list');

    }

    public function getCustomerProducts(Request $request)
    {

    }

    public function create(){
        // $salesService = SalesService::findOrFail($id);
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.sale-services.sales-services-create', compact('customers','products'));
    }

    public function store(Request $request)
    {

        //Validate the incoming request data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'payment_status' => 'required|in:pending,completed',
            'transaction_type' => 'required|in:purchase,sale',
            'amount' => 'required|numeric',
            'transaction_id' => 'required|string',
            'payment_method' => 'required|string',
            'bank_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'transaction_reference' => 'required|string',
        ]);

        // $totalPrice = $validatedData['quantity']*$validatedData['price'];

        // Create SalesService record
        $salesService = SalesService::create([
            'customer_id' => $validatedData['customer_id'],
            'product_id' => $validatedData['product_id'],
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'total_price' => $validatedData['quantity'] * $validatedData['price'], // Calculate total price
        ]);

        $products = Product::find($request->product_id);
        $products->customer_id = $request->customer_id;
        $products->save();

        // Create Payment record
        $payment = Payment::create([
            'product_id' => $validatedData['product_id'],
            'customer_id' => $validatedData['customer_id'],
            'sales_service_id' => $salesService->id,
            'amount' => $validatedData['amount'],
            'transaction_type' => $validatedData['transaction_type'],
            'payment_status' => $validatedData['payment_status'],
            'transaction_id' => $validatedData['transaction_id'],
            'payment_method' => $validatedData['payment_method'],
            'bank_name' => $validatedData['bank_name'],
            'bank_account_number' => $validatedData['bank_account_number'],
            'transaction_reference' => $validatedData['transaction_reference'],
        ]);
            // Redirect to the appropriate route
            return redirect()->route('admin.crm-salesServices-list')->with('success', 'Payment and sales service details added successfully');



    }

    public function edit($id)
    {
        // Find the sales service by ID
        $salesService = SalesService::findOrFail($id);

        // Find the associated payment record
        $payment = Payment::where('sales_service_id', $id)->firstOrFail();

        // Fetch customers and products
        $customers = Customer::all();
        $products = Product::all();

        return view('admin.sale-services.sales-services-edit', compact('payment','customers','products','salesService'));
        // return view('sales_services.edit', compact('salesService', 'customers', 'products'));
    }

    public function update(Request $request, $id)
    {
        // return $request->input();

        // $validatedData = $request->validate([
        //     'customer_id' => 'required|exists:customers,id',
        //     'product_id' => 'required|exists:products,id',
        //     'type' => 'required|in:sale,service',
        //     'quantity' => 'required|integer|min:1',
        //     'total_price' => 'required|numeric|min:0',
        // ]);

        // $salesService = SalesService::findOrFail($id);
        // $salesService->update($validatedData);
         // Validate the request data
         $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'payment_status' => 'required|in:pending,completed',
            'transaction_type' => 'required|in:purchase,sale',
            'amount' => 'required|numeric',
            'transaction_id' => 'required|string',
            'payment_method' => 'required|string',
            'bank_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'transaction_reference' => 'required|string',
        ]);

        // Find the sales service by ID
        $salesService = SalesService::findOrFail($id);

        // Update sales service data
        $salesService->update([
            'customer_id' => $validatedData['customer_id'],
            'product_id' => $validatedData['product_id'],
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'total_price' => $validatedData['quantity'] * $validatedData['price'], // Calculate total price,
        ]);

        // Find the associated payment record
        $payment = Payment::where('sales_service_id', $id)->firstOrFail();

        // Update payment data
        $payment->update([
            // 'payment_status' => $validatedData['payment_status'],
            'amount' => $validatedData['amount'],
            'transaction_id' => $validatedData['transaction_id'],
            'payment_method' => $validatedData['payment_method'],
            'bank_name' => $validatedData['bank_name'],
            'payment_status' => $validatedData['payment_status'],
            'transaction_type' => $validatedData['transaction_type'],
            'bank_account_number' => $validatedData['bank_account_number'],
            'transaction_reference' => $validatedData['transaction_reference'],
        ]);


        return redirect()->route('admin.crm-salesServices-list')->with('success', 'Sales or service record updated successfully');
    }

    public function destroy($id)
    {
        $salesService = SalesService::findOrFail($id);
        $salesService->delete();

        return redirect()->route('admin.crm-salesServices-list')->with('success', 'Sales or service record deleted successfully');
    }

}
