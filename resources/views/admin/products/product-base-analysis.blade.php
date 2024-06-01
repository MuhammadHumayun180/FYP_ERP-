<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Analysis</title>
    <style>
        .plot {
            width: 100%;
            height: auto;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Product Analysis</h1>
    <label for="product-select">Choose a product:</label>
    <select id="product-select">
        <!-- Options will be populated dynamically -->
    </select>
    <button onclick="analyzeProduct()">Analyze</button>
    <canvas id="myChart" class="plot"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartInstance = null;  // Reference to the chart instance

        document.addEventListener('DOMContentLoaded', function () {
            fetch('http://127.0.0.1:5000/products')
                .then(response => response.json())
                .then(data => {
                    const productSelect = document.getElementById('product-select');
                    data.products.forEach(product => {
                        const option = document.createElement('option');
                        option.value = product;
                        option.textContent = product;
                        productSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        });

        function analyzeProduct() {
            const productSelect = document.getElementById('product-select');
            const productName = productSelect.value;

            const url = `http://127.0.0.1:5000/analyze-products?product_name=${encodeURIComponent(productName)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error(`Error: ${data.error}`);
                    } else {
                        // Draw chart
                        drawChart(data.top_selling_products);
                    }
                })
                .catch(error => console.error('Error analyzing product:', error));
        }

        function drawChart(topSellingProducts) {
            const ctx = document.getElementById('myChart').getContext('2d');

            // Destroy the existing chart instance if it exists
            if (chartInstance) {
                chartInstance.destroy();
            }

            // Extracting data for the chart
            const labels = Object.keys(topSellingProducts.total_quantity);
            const quantities = Object.values(topSellingProducts.total_quantity);
            const sales = Object.values(topSellingProducts.total_sales);
            const prices = Object.values(topSellingProducts.price);

            // Normalize price data for better visualization
            const maxPrice = Math.max(...prices);
            const normalizedPrices = prices.map(price => (price / maxPrice) * Math.max(...quantities) / 2); // Adjusting the normalization scale

            // Creating the chart
            chartInstance = new Chart(ctx, {
                data: {
                    labels: labels,
                    datasets: [{
                        type: 'bar',
                        label: 'Total Quantity',
                        data: quantities,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        yAxisID: 'y-quantity'
                    }, {
                        type: 'bar',
                        label: 'Total Sales',
                        data: sales,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        yAxisID: 'y-sales'
                    }, {
                        type: 'bar',
                        label: 'Price',
                        data: normalizedPrices,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1,
                        yAxisID: 'y-price'
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Top Selling Products Analysis'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (context.parsed.y !== null) {
                                        if (context.dataset.label === 'Price') {
                                            // Revert to original price value for display
                                            const originalPrice = (context.raw / Math.max(...quantities) * 2) * maxPrice;
                                            label += ': $' + originalPrice.toFixed(2);
                                        } else {
                                            label += ': ' + context.parsed.y.toLocaleString();
                                        }
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        'y-quantity': {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Total Quantity'
                            }
                        },
                        'y-sales': {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false
                            },
                            title: {
                                display: true,
                                text: 'Total Sales (USD)'
                            }
                        },
                        'y-price': {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false
                            },
                            title: {
                                display: true,
                                text: 'Price (USD)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return `$${(value / Math.max(...quantities) * 2) * maxPrice}`;
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
