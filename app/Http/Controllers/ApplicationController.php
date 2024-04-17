<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{

    public function showForm()
    {
        return view('application.form');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'position_applied' => 'required|string|max:255',
            'email' => 'required|unique:applications,email',
            'contact_number' => 'required|numeric|digits:11', // Adjust as per your validation requirements
            'cv' => 'required|mimes:pdf|max:2048',
        ]);

        $cvPath = null;

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv_files');
        }

      $application =   Application::create([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'position_applied' => $request->input('position_applied'),
            'cv_path' => $cvPath,
        ]);

        if($application){
            // toastr()->success('Application submitted successfully!');
            return redirect()->route('/')->with('success', 'Application submitted successfully!');
        }else{
            // toastr()->error('Application submitted successfully!');
            return redirect()->back('/')->with('error','Application submitted successfully!');
        }
    }




    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Application::orderBy('created_at', 'asc')->get();

            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='d-flex justify-content-center '>
                <a href='".route('admin.talent_acquisitions.view', $row->id)."' class='edit btn btn-success btn-sm mx-1'>View</a>
                <a href='".route('admin.time-attendance-reports.delete', $row->id)."' class='delete btn btn-danger btn-sm mx-1'>Delete</a>
            </div>";

            return $actionBtn;

            })->addColumn('user_cv', function($row){

                if ($row->cv_path) {
                    return '<i class="fas fa-file"></i> <a href="'.route("pdf.show", $row->id).'" target="_blank">Download CV</a>';
                } else {
                    return 'No CV';
                }
            })
            ->rawColumns(['action','user_cv'])->make(true);

        }

        return view('admin.talent_acquisition.application-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application, $id)
    {
        // Retrieve the application by ID
         $application = Application::findOrFail($id);

        //  $application = Application::findOrFail($id);

        $file_path = storage_path('app/cv_files/' . $application->cv_path);

         return view('admin.talent_acquisition.application-view', compact('application','file_path'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
