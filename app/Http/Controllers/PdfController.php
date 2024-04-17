<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

use App\Models\Application;
use PDF;

class PdfController extends Controller
{
    public function showPdf($id)
    {
        $application = Application::findOrFail($id);
        // Assuming the CV file path is stored in the 'cv_path' field
        $cvFilePath = storage_path('app/' . $application->cv_path);
        // return $cvFilePath;
        // Check if the CV file exists
        if (file_exists($cvFilePath)) {
            // return Response::download($cvFilePath, 'applicant_cv.pdf');
            $fileName = $application->full_name . "'s_Resume-" . now()->format('m-d-Y') . ".pdf";
            return response()->download($cvFilePath, $fileName);
        } else {
            // Handle the case where the CV file is not found
            abort(404, 'CV file not found');
        }


    }
}
