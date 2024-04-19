<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ForecastController extends Controller
{
    public function getForecast()
    {
        try {
            // Send GET request to Flask API endpoint
            $response = Http::get('http://127.0.0.1:5000/predict-arima');

            // Handle response data (assuming JSON response)
            $data = $response->json();

            // Extract forecasted values from response
            $forecastData = isset($data['forecast']) ? $data['forecast'] : [];
            //  dump($forecastData);
            // Plot the graph using the forecasted values (proceeds data)
            // Implement graph plotting logic here using $forecastData

            // Render the view with the plotted graph
            return view('admin.business-intelligence.forecast')->with('forecastData', $forecastData);


        } catch (\Exception $e) {
            // Handle HTTP request error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
