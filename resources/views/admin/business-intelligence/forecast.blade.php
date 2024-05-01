{{-- resources/views/business-intelligence/business-intelligence.forecast.blade.php--}}

@extends('layouts.app')

@section('main-content')



<div class="container-fluid">

    {{-- <!-- Content Row --> --}}
    <div class="row">

        {{-- <!-- Area Chart --> --}}
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                {{-- <!-- Card Header - Dropdown --> --}}

                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Sales</h3>
                    <button type="button" class="btn btn-primary" onclick="generateCSV()">Generate CSV</button>

                   
                </div>

                {{-- <!-- Card Body --> --}}
                <div class="card-body rounded-circle">
                    <!-- Canvas for Chart.js -->
                    <canvas id="forecastChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    var forecastData = {!! json_encode($forecastData) !!};
    var ctx = document.getElementById('forecastChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array.from(Array(forecastData.length).keys()), // Time steps as labels
            datasets: [{
                label: 'ARIMA Forecast',
                data: forecastData,
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.1)',
                pointRadius: 5,
                pointHoverRadius: 8,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false,
                    title: {
                        display: true,
                        text: 'Forecasted Value'
                    },
                    ticks: {
                        stepSize: 5,  // Set the step size for y-axis ticks
                        precision: 2   // Number of decimal places to display
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Time Steps'
                    }
                }
            }
        }
    });

    function    generateCSV() {
        // Make an AJAX request to the export CSV endpoint
        fetch('{{ route("export.csv") }}', {
            method: 'GET',
        })
        .then(response => {
            if (response.ok) {
                return response.blob();
            }
            else{

                throw new Error('Failed to export CSV');
            }
        })
        .then(blob => {
            // Create a temporary anchor element to download the CSV file
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'export.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error('CSV export failed:', error.message);
            alert('Failed to export CSV');
        });
    }
</script>
@endsection