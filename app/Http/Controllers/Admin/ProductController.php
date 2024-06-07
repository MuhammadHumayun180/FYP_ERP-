<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;

use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request){


        if ($request->ajax()) {
            $data = Product::with(['payments', 'supplier'])->orderBy('created_at', 'asc')->get();
            // return $data;
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('supplier_name', function ($row) {
                    $supplierName = $row->supplier ? $row->supplier->name : 'Not Available';
                    return $supplierName;
                })
                ->addColumn('payment_status', function ($row) {
                    $paymentStatus = $row->payments->isNotEmpty() ? $row->payments->first()->payment_status : 'Not Available';
                    return $paymentStatus;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = "<div class='d-flex justify-content-center '>
                    <a href='".route('admin.product-edit',$row->id)."'  class='edit btn  btn-sm mx-1'><i class='fa-solid fa-pen-to-square' style='color:green'></i></a>
                    <a href='".route('admin.product-delete',$row->id)."' class='delete btn  btn-sm mx-1'><i class='fa-solid fa-trash'style='color:red'></i></a>
                    </div>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.products.product-list');

    }

    public function create(){
        $suppliers = Supplier::all();
        return view('admin.products.product-create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        // return $request->input();

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
            'transaction_type' => 'required|string',
            'payment_status' => 'required|string',
            'transaction_id' => 'required|string',
            'payment_method' => 'required|string',
            'bank_name' => 'required|string|max:255',
            'bank_account_number' => ['required', 'string', 'regex:/^\d{10,20}$|^[0-9]{10,20}$/'], // Pattern for bank account number or mobile number
            'transaction_reference' => 'required|string|regex:/^[a-zA-Z0-9]{8,}$/', // Pattern for transaction reference number
        ]);

        $total_price = $request->quantity * $request->price;
        // Create a new product
        $product = new Product();
        $product->name = $request->name;
        $product->supplier_id = $request->supplier_id;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->total_price = $total_price;
        $product->save();

        // Create a new payment record associated with the product
        $payment = new Payment();
        $payment->product_id = $product->id;
        $payment->amount = $request->amount;
        $payment->transaction_type = $request->transaction_type;
        $payment->payment_status = $request->payment_status;
        $payment->transaction_id = $request->transaction_id;
        $payment->payment_method = $request->payment_method;
        $payment->bank_name = $request->bank_name;
        $payment->bank_account_number = $request->bank_account_number;
        $payment->transaction_reference = $request->transaction_reference;
        $payment->save();

        return redirect()->route('admin.product-list')->with('success','Prodcut Created Successfully');

    }

    public function edit($id){
        // $product =  Product::findorFail($id);
        // return view('admin.products.product-edit', compact('product'));
        // Find the product by ID
            $product =  Product::findOrFail($id);
            // Find the associated payment record
            $payment = Payment::where('product_id', $id)->first();
             $suppliers = Supplier::all();

            // Pass both product and payment data to the view
            return view('admin.products.product-edit', compact('product', 'payment','suppliers'));
    }


    public function update(Request $request, $id)
    {

        // return $request->input();

        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'sku' => 'required|string|max:50',
        //     'description' => 'nullable|string',
        //     'category' => 'nullable|string|max:255',
        //     'brand' => 'nullable|string|max:255',
        //     'model' => 'nullable|string|max:255',
        //     'quantity' => 'required|integer|min:0',
        //     'price' => 'required|numeric|min:0',
        // ]);

        // $total_price = $validatedData['quantity'] * $validatedData['price'];
        // // Add the total_cost to the validated data
        // $validatedData['total_price'] =  $total_price;

        // $product = Product::findOrFail($id);
        // $product->update($validatedData);

        // Validate the incoming request data for product
        $validatedProductData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Calculate total price for the product
        $totalPrice = $validatedProductData['quantity'] * $validatedProductData['price'];
        // Add the total_price to the validated product data
        $validatedProductData['total_price'] = $totalPrice;

        // Update the product
        $product = Product::findOrFail($id);
        $product->update($validatedProductData);

        // Validate the incoming request data for payment
        $validatedPaymentData = $request->validate([
            'amount' => 'required|numeric',
            'transaction_type' => 'required|string',
            'payment_status' => 'required|string',
            'transaction_id' => 'required|string',
            'payment_method' => 'required|string',
            'bank_name' => 'required|string|max:255',
            'bank_account_number' => ['required', 'string', 'regex:/^\d{10,20}$|^[0-9]{10,20}$/'], // Pattern for bank account number or mobile number
            'transaction_reference' => 'required|string|regex:/^[a-zA-Z0-9]{8,}$/',
        ]);

        // Find the associated payment record
        $payment = Payment::where('product_id', $id)->firstOrFail();
        // Update the payment record
        $payment->update($validatedPaymentData);
        return redirect()->route('admin.product-list')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.product-list')->with('success', 'Product deleted successfully');
    }
        public function showProductDropdown()
        {
            // Fetch product list from Flask backend
            $response = Http::get('http://localhost:5000/products');  // Replace with your Flask backend URL
            $products = $response->json()['products'];

            // Pass product list to the view
            return view('admin.products.product-base-analysis', compact('products'));
        }

    public function analyzeProduct(Request $request)
    {
        $productName = $request->query('product_name');

        // Fetch product analysis from Flask backend
        $response = Http::get('http://localhost:5000/analyze-products', [
            'product_name' => $productName
        ]);

        // Return the response from Flask backend
        return response()->json($response->json());
    }

}
