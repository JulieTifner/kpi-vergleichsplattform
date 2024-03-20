@extends('layouts.app')

@section('content')
    <div class="container-xl pt-5 mb-3">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-12 col-lg-7 chart-border">
                    <canvas id="percent" class="canvas-chart"></canvas>
                </div>
                <div class="col-12 col-lg-7 chart-border">
                    <canvas id="num" class="canvas-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const data = {
                labels: ['january', 'ferbruary', 'march', 'april', 'may', 'june', 'july', 'august', 'september',
                    'october', 'november', 'december'
                ],
                datasets: [{
                        label: 'My First Dataset',
                        data: [65, 59, 80, 81, 56, 55, 40, 33, 28, 56, 28, 46],
                        backgroundColor: 'rgb(248, 110, 56)',
                        borderColor: 'rgb(248, 110, 56)',
                        borderWidth: 1
                    },
                    {
                        label: 'My Second Dataset',
                        data: [15, 65, 50, 41, 26, 75, 10, 37, 38, 29, 18, 76],
                        backgroundColor: 'rgb(49, 104, 255)',
                        borderColor: 'rgb(49, 104, 255',
                        borderWidth: 1
                    }
                ]
            };
            const config = {
                type: 'bar',
                data: data,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Diagram 1'
                        },
                    },
                    responsive: true,
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            var ctx = document.getElementById('percent').getContext('2d');
            new Chart(ctx, config);

        });
        document.addEventListener('DOMContentLoaded', function() {

            const data = {
                labels: ['january', 'ferbruary', 'march', 'april', 'may', 'june', 'july', 'august', 'september',
                    'october', 'november', 'december'
                ],
                datasets: [{
                        label: 'My First Dataset',
                        data: [65, 59, 80, 81, 56, 55, 40, 33, 28, 56, 28, 46],
                        backgroundColor: 'rgb(248, 110, 56)',
                        borderColor: 'rgb(248, 110, 56)',
                        borderWidth: 1
                    },
                    {
                        label: 'My Second Dataset',
                        data: [15, 65, 50, 41, 26, 75, 10, 37, 38, 29, 18, 76],
                        backgroundColor: 'rgb(49, 104, 255)',
                        borderColor: 'rgb(49, 104, 255',
                        borderWidth: 1
                    }
                ]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Diagram 2'
                        },
                    },
                    responsive: true,
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };
            var ctx = document.getElementById('num').getContext('2d');
            new Chart(ctx, config);
        });
    </script>
@endsection
