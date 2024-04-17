<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Procurement;
use App\Models\Product;
use App\Models\Supplier;
use Yajra\DataTables\Facades\DataTables;


class ProcurementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Procurement::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product_name', function($row) {
                    return $row->product->name;
                })
                ->addColumn('supplier_name', function($row) {
                    return $row->supplier->name;
                })
                ->addColumn('action', function($row) {
                    $actionBtn = "<div class='d-flex justify-content-center '>
                    <a href='".route('admin.procurement-edit',$row->id)."' class='edit btn btn-success btn-sm mx-1'>Edit</a>
                    <a href='".route('admin.procurement-delete',$row->id)."' class='delete btn btn-danger btn-sm mx-1'>Delete</a>
                    </div>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.procurements.procurement-list');
    }


    public function getSupplierProducts(Request $request)
    {
        $supllierId = $request->get('supllier_id');

        $customer = Supplier::findOrFail($supllierId);

        $products = $customer->products()->get(['id', 'name']); // Assuming you have defined the relationship correctly

        return response()->json(['products' => $products]);

    }
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('admin.procurements.procurement-create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {

        // return "procurement";

           // Validate the request data
           $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'other_cost' => 'required|numeric|min:0',
        ]);

         // $totalCost = $validatedData['quantity'] * $validatedData['cost'] + $validatedData['other_cost'];
         $totalCost = ($validatedData['quantity'] * $validatedData['cost']) + $validatedData['other_cost'];
         $validatedData['total_cost'] = $totalCost;


        Procurement::create($validatedData);

        return redirect()->route('admin.procurement-list')->with('success', 'Procurement record added successfully');
    }

    public function edit($id)
    {
        $procurement = Procurement::findOrFail($id);
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.procurements.procurement-edit', compact('procurement', 'products', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'other_cost' => 'required|numeric|min:0',
        ]);

        $totalCost = ($validatedData['quantity'] * $validatedData['cost']) + $validatedData['other_cost'];
        $validatedData['total_cost'] = $totalCost;

        $procurement = Procurement::findOrFail($id);
        $procurement->update($validatedData);

        return redirect()->route('admin.procurement-list')->with('success', 'Procurement record updated successfully');
    }

    public function destroy($id)
    {
        $procurement = Procurement::findOrFail($id);
        $procurement->delete();
        return redirect()->route('admin.procurement-list')->with('success', 'Procurement record deleted successfully');
    }


}
