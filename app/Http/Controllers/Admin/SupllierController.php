<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Supplier;
use Yajra\DataTables\Facades\DataTables;


class SupllierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Supplier::orderBy('created_at', 'asc')->get();
            return  Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='d-flex justify-content-center '>
                <a href='".route('admin.supplier-edit',$row->id)."' class='edit btn  btn-sm mx-1'><i class='fa-solid fa-pen-to-square' style='color:green'></i></a>
                <a href='".route('admin.supplier-delete',$row->id)."' class='delete btn  btn-sm mx-1'><i class='fa-solid fa-trash'style='color:red'></i></a>
                </div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.suppliers.supplier-list');



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.suppliers.supplier-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
        ]);

        // Create a new supplier instance
        $supplier = new Supplier();
        $supplier->name = $validatedData['name'];
        $supplier->contact_person = $validatedData['contact_person'];
        $supplier->contact_number = $validatedData['contact_number'];

        // Save the supplier
        $supplier->save();

        // Redirect to a route or return a response as needed
        return redirect()->route('admin.supplier-list')->with('success', 'Supplier added successfully');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.supplier-edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validatedData);

        return redirect()->route('admin.supplier-list')->with('success', 'Supplier updated successfully');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('admin.supplier-list')->with('success', 'Supplier deleted successfully');
    }


}
