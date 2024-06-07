<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sales;
use App\Models\Product;
use App\Models\Customer;

use Yajra\DataTables\Facades\DataTables;


class SalesAutomationController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            // $data = Sales::with(['customer','product'])->orderBy('created_at', 'asc')->get();
            // $data = Sales::get();
            $data = Sales::with('product', 'customer')->latest()->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('product_name', function($row){
                return $row->product->name;
            })
            ->addColumn('customer_name', function($row){
                return $row->customer->name;
            })
                ->addColumn('action', function($row){
                $actionBtn = "<div class='d-flex justify-content-center '>
                    <a href='".route('admin.sales.automation-edit', $row->id)."' class='edit btn  btn-sm mx-1'><i class='fa-solid fa-pen-to-square' style='color:green'></i></a>
                    <a href='".route('admin.sales.automation-delete', $row->id)."' class='delete btn  btn-sm mx-1'><i class='fa-solid fa-trash'style='color:red'></i></a>
                    </div>";
                
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.sales.sales-list');
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.sales.sales-create', compact('products','customers'));
    }

    public function getCustomerProducts(Request $request){
        $customerId = $request->input('customer_id');

            if(empty($customerId))
            {
                return response()->json([
                    'success' => false,
                    'message'=>'Product Not Found',
                    'data' => [
                        'products' => $customerId
                    ]
                ]);
            }
        // Fetch customer's products
        $products = Product::where('customer_id',$customerId)->get();
        // $products = $customer->products;

        // Return JSON response
        return response()->json([
            'success' => true,
            'data' => [
                'products' => $products
            ]
        ]);
    }
    public function getCustomerProductData(Request $request){
        $productId = $request->input('product_id');

        // return
            // Fetch product data
            $product = Product::find($productId);

            // Return JSON response
            return response()->json([
                'success' => true,
                'data' => [
                    'product' => $product
                ]
            ]);

    }



     // Store a newly created sales record in the database
     public function store(Request $request)
     {
         // Validate the form data
         $validatedData = $request->validate([
             'customer' => 'required|exists:customers,id',
             'product' => 'required|exists:products,id',
             'quantity' => 'required|integer|min:1',
             'price' => 'required|numeric|min:0.01',
            //  'total_amount' => 'required|numeric|min:0.01',
         ]);

         // Create a new sales record
         Sales::create([
             'customer_id' => $request->input('customer'),
             'product_id' => $request->input('product'),
             'quantity' => $request->input('quantity'),
             'price' => $request->input('price'),
             'total_amount' => $request->input('quantity') * $request->input('price'),
         ]);

         // Redirect back with success message
         return redirect()->route('admin.sales.automation-list')->with('success', 'Sales record created successfully!');
     }

     public function edit($id){
        $sales = Sales::find($id);
        return $sales;
     }
     public function update(Request $request, $id){
        $sales = Sales::find($id);
        return $sales;
     }

     public function destroy($id)
     {
        $sales = Sales::find($id);
        return $sales;
     }

}
