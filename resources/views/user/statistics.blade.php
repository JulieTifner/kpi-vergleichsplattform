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
        </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        //percent
        document.addEventListener('DOMContentLoaded', function() {
            var questionsData = @json($questionTypePercent);
            var avgData = @json($calcAverage);

            const questionNames = questionsData.map(question => question.questionName);
            const answerNames = questionsData.map(question => question.answerName);

            const avg = avgData.map(question => question.averagePercent).filter(num => num !== 0);

            const data = {
                labels: questionNames,
                datasets: [{
                        label: 'Your Answers',
                        data: answerNames,
                        backgroundColor: 'rgb(248, 110, 56)',
                        borderColor: 'rgb(248, 110, 56)',
                        borderWidth: 1
                    },
                    {
                        label: 'Average Answers',
                        data: avg,
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
                            text: 'Percent'
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


        //Number
        document.addEventListener('DOMContentLoaded', function() {
            var questionsData = @json($questionTypeNum);
            var avgData = @json($calcAverage);
            console.log(questionsData);

            const questionNames = questionsData.map(question => question.questionName);
            const answerNames = questionsData.map(question => question.answerName);

            const avg = avgData.map(question => question.averageNum).filter(num => num !== 0);
            console.log(avgData)

            const data = {
                labels: questionNames,
                datasets: [{
                        label: 'Your Answers',
                        data: answerNames,
                        backgroundColor: 'rgb(248, 110, 56)',
                        borderColor: 'rgb(248, 110, 56)',
                        borderWidth: 1
                    },
                    {
                        label: 'Average Answers',
                        data: avg,
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
                            text: 'Number'
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
