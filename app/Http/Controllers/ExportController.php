<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Writer;

class ExportController extends Controller
{
    public function exportCSV()
    {
        // Fetch all records from the 'products' table
        $tableData = DB::table('products')->get();

        // Specify the directory path where you want to save the CSV file
        $directory = storage_path('app/exports');

        // Ensure the directory exists; create it if it doesn't
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // Specify the file path for the CSV file within the directory
        $filePath = $directory . '/export.csv';

        try {
            // Check if the CSV file already exists
            if (file_exists($filePath)) {
                // Append data to an existing CSV file
                $this->appendDataToCSV($filePath, $tableData);
            } else {
                // Create a new CSV file and write data to it
                $this->writeDataToNewCSV($filePath, $tableData);
            }

            // Return a response indicating the file path where the CSV file was saved
            return response()->json(['message' => 'CSV file exported successfully.', 'filePath' => $filePath]);

        } catch (Exception $e) {
            // Handle any exceptions that occur during CSV file operations
            return response()->json(['error' => 'Failed to export CSV file.'], 500);
        }
    }

    /**
     * Append data to an existing CSV file.
     *
     * @param string $filePath
     * @param \Illuminate\Support\Collection $tableData
     * @throws \League\Csv\Exception
     */
    private function appendDataToCSV($filePath, $tableData)
    {
        // Open the existing CSV file in append mode
        $csv = Writer::createFromPath($filePath, 'a+');

        // Insert data rows into the CSV file
        foreach ($tableData as $row) {
            $rowData = (array) $row;
            $csv->insertOne($rowData);
        }

        // Close the CSV file after writing data
        $csv->output();
    }

    /**
     * Create a new CSV file and write data to it.
     *
     * @param string $filePath
     * @param \Illuminate\Support\Collection $tableData
     * @throws \League\Csv\Exception
     */
    private function writeDataToNewCSV($filePath, $tableData)
    {
        // Create a new CSV file and open it in write mode
        $csv = Writer::createFromPath($filePath, 'w+');

        // Insert header row into the CSV file
        $csv->insertOne(['id', 'customer_id', 'product_id', 'price', 'quantity', 'total_amount', 'created_at', 'updated_at']);

        // Insert data rows into the CSV file
        foreach ($tableData as $row) {
            $rowData = (array) $row;
            $csv->insertOne($rowData);
        }

        // Close the CSV file after writing data
        $csv->output();
    }
}
        