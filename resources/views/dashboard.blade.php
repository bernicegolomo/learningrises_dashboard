@extends('layouts.dashboard')
@section('membercontent')

            <div class="content pt-4 px-4 pb-4">
                @if(isset($score_id))
                    <div class="row bg-white rounded align-items-center mx-0 mb-4 pt-3 pb-3">
                        <div class="col-md-12 text-center ">
                            <h4 class="text-secondary">You can always review this report using your RECORD ENTRY ID: <strong>{{$score_id}}</strong></h4>
                        </div>
                    </div>
                @endif
                
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="bg-white rounded align-items-center mx-0 pt-3 pb-3">
                            <h5 class="text-center fs-18 text-dark">
                                Class Size
                                <!-- Information Icon with Tooltip -->
                                <i class="bi bi-info-circle info-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="The total number of students in a class in a given time."></i>
                            </h5>
                            <div class="chart-container">
                                <canvas id="classSizeChart" width="600" height="400"></canvas>
                            </div>
                        </div>
                            
                    </div>

                    <div class="col-md-4 text-center">
                        <div class="bg-white rounded align-items-center mx-0 pt-3 pb-3">
                            <h5 class="text-center fs-18 text-dark">
                                Average Scores by Subject
                                <i class="bi bi-info-circle info-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="It is the measure of class performance and it is derived by summing up all individual scores which is then divided by the number of students in the class. It gives a quick snapshot of how a class performed on average."></i>
                            </h5>
                            <div class="d-flex justify-content-center">
                                <canvas id="averageScoresGaugeChart" width="600" height="200"></canvas>
                            </div>
                        </div>
                            
                    </div>

                    <div class="col-md-5 text-center">
                        <div class="bg-white rounded align-items-center mx-0 pt-3 pb-3">
                            <h5 class="text-center fs-18 text-dark">
                                Combined Score Distribution
                                <i class="bi bi-info-circle info-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="This provides visual representation of the data. It displays the distribution of the score along a defined scale."></i>
                            </h5>
                            <div class="d-flex justify-content-center">
                                <canvas id="scoreDistributionChart" width="600" height="200"></canvas>
                            </div>
                        </div>
                            
                    </div>
                </div>

                @if(isset($subjectScores) && count($subjectScores) > 0)
                    @foreach($subjectScores as $subject => $scores)
                        <div class="row mt-4 bg-white rounded align-items-center mx-0 mb-4 pt-3 pb-3">
                            <div class="row mt-3 align-items-center mx-0 mb-3 pt-3 pb-3">
                                <div class="col-md-12 text-center">
                                    <h4 class="text-secondary mt-3">PERFORMANCE DETAILS FOR {{ $subject }}</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <div class="bg-white rounded align-items-center mx-0 pt-3 pb-3">
                                        <h5 class="text-center fs-18 text-dark">
                                            Highest Scores
                                            <i class="bi bi-info-circle info-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="This provides visual representation of the highest scores for {{ $subject }}."></i>
                                        </h5>
                                        <div class="d-flex justify-content-center">
                                            <canvas id="highestScoresChart_{{ $subject }}" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="bg-white rounded align-items-center mx-0 pt-3 pb-3">
                                        <h5 class="text-center fs-18 text-dark">
                                            Lowest Scores
                                            <i class="bi bi-info-circle info-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="This provides visual representation of the lowest scores for {{ $subject }}."></i>
                                        </h5>
                                        <div class="d-flex justify-content-center">
                                            <canvas id="lowestScoresChart_{{ $subject }}" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="bg-white rounded align-items-center mx-0 pt-3 pb-3">
                                        <h5 class="text-center fs-18 text-dark">
                                            Other Statistics
                                            <i class="bi bi-info-circle info-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Standard deviation of how spread out the score is in a set of numbers. It helps you understand how much variation exists within your data set. For example, if every student has the same score the standard deviation is zero but as the score varies across then the standard deviation becomes higher. Median: It is the middle score of the class when the scores  are arranged in order, from lowest to highest. It also measures group performance."></i>
                                        </h5>
                                        <div class="d-flex justify-content-center">
                                            <canvas id="statsChart_{{ $subject }}" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 text-center">
                                    <div class="bg-white rounded align-items-center mx-0 pt-3 pb-3">
                                        <h5 class="text-center fs-18 text-dark">
                                            Score Range for {{ $subject }}
                                            <i class="bi bi-info-circle info-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="This gauge displays the score range (difference between highest and lowest scores) for {{ $subject }}."></i>
                                        </h5>
                                        <div class="d-flex justify-content-center">
                                            <canvas id="rangeGaugeChart_{{ $subject }}" width="400" height="150"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
                
                
                
				
            @endsection

            @push('scripts')
                <!-- Define the generateColors and generateBorderColors functions -->
                <script>

                            
                    function generateColors(numColors) {
                        const colors = [];
                        const baseColors = [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(199, 199, 199, 0.6)',
                            'rgba(83, 102, 255, 0.6)',
                            'rgba(255, 205, 86, 0.6)',
                            'rgba(75, 203, 192, 0.6)'
                        ];

                        for (let i = 0; i < numColors; i++) {
                            colors.push(baseColors[i % baseColors.length]);
                        }

                        return colors;
                    }

                    function generateBorderColors(colors) {
                        return colors.map(color => color.replace('0.6', '1'));
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        // Check if classSize is set and valid
                        var classSize = @json($classsize ?? null);
                        if (classSize !== null && !isNaN(classSize)) {
                            var classSizeCtx = document.getElementById('classSizeChart').getContext('2d');
                            var maxClassSize = classSize + 10; // Example maximum class size

                            var classSizeChart = new Chart(classSizeCtx, {
                                type: 'bar',
                                data: {
                                    labels: ['Class Size'],
                                    datasets: [{
                                        label: 'Class Size',
                                        data: [classSize],
                                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: ''
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Number of Students'
                                            }
                                        }
                                    },
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(tooltipItem) {
                                                    return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        }

                        // Check if averageScores is set and valid
                        var averageScores = @json($averageScores ?? []);
                        if (Array.isArray(averageScores) && averageScores.length > 0) {
                            var averageScoresGaugeCtx = document.getElementById('averageScoresGaugeChart').getContext('2d');

                            var labels = averageScores.map(function(score) {
                                return score.subject;
                            });

                            var data = averageScores.map(function(score) {
                                return score.average_score;
                            });

                            var colors = generateColors(labels.length);

                            var averageScoresGaugeChart = new Chart(averageScoresGaugeCtx, {
                                type: 'doughnut',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Average Score',
                                        data: data,
                                        backgroundColor: colors,
                                        borderColor: generateBorderColors(colors),
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(tooltipItem) {
                                                    return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2);
                                                }
                                            }
                                        },
                                        doughnutlabel: {
                                            labels: [{
                                                text: 'Average',
                                                font: {
                                                    size: '20'
                                                }
                                            }, {
                                                text: (data.reduce((a, b) => a + b, 0) / data.length).toFixed(2),
                                                font: {
                                                    size: '30',
                                                    weight: 'bold'
                                                },
                                                color: '#ff0000'
                                            }]
                                        }
                                    }
                                }
                            });
                        }


                    @if(isset($data) && !empty($data) > 0)
                        fetch('{{ url("/getScoreDistributionData/$data->id") }}')
                            .then(response => response.json())
                            .then(distributionData => {
                                console.log(distributionData); // Check if the data is being fetched correctly

                                var ctxScoreDistribution = document.getElementById('scoreDistributionChart').getContext('2d');

                                var labels = Object.keys(distributionData);
                                var scoreRanges = Object.keys(distributionData[labels[0]]);
                                var colors = generateColors(scoreRanges.length);

                                var datasets = scoreRanges.map((range, index) => {
                                    return {
                                        label: range,
                                        data: labels.map(subject => distributionData[subject][range]),
                                        backgroundColor: colors[index],
                                        borderColor: generateBorderColors([colors[index]])[0],
                                        borderWidth: 1
                                    };
                                });

                                var scoreDistributionChart = new Chart(ctxScoreDistribution, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: datasets
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        indexAxis: 'y',
                                        scales: {
                                            x: {
                                                stacked: true,
                                                title: {
                                                    display: true,
                                                    text: 'Number of Students'
                                                }
                                            },
                                            y: {
                                                stacked: true,
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Subjects'
                                                }
                                            }
                                        },
                                        plugins: {
                                            tooltip: {
                                                callbacks: {
                                                    label: function(tooltipItem) {
                                                        return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            })
                            .catch(error => console.error('Error fetching data:', error)); 
                        @endif 
                    });
                    </script>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        @if(isset($subjectScores) && count($subjectScores) > 0)
                            @foreach($subjectScores as $subject => $scores)
                                new Chart(document.getElementById('highestScoresChart_{{ $subject }}').getContext('2d'), {
                                    type: 'bar',
                                    data: {
                                        labels: @json(array_keys($scores['highest'])),
                                        datasets: [{
                                            label: 'Highest Scores',
                                            data: @json(array_values($scores['highest'])),
                                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        indexAxis: 'y',
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Scores'
                                                }
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: 'Students'
                                                }
                                            }
                                        }
                                    }
                                });

                                new Chart(document.getElementById('lowestScoresChart_{{ $subject }}').getContext('2d'), {
                                    type: 'bar',
                                    data: {
                                        labels: @json(array_keys($scores['lowest'])),
                                        datasets: [{
                                            label: 'Lowest Scores',
                                            data: @json(array_values($scores['lowest'])),
                                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        indexAxis: 'y',
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Scores'
                                                }
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: 'Students'
                                                }
                                            }
                                        }
                                    }
                                });

                                new Chart(document.getElementById('statsChart_{{ $subject }}').getContext('2d'), {
                                    type: 'line',
                                    data: {
                                        labels: ['Mean', 'Median', 'Mode', 'Std Dev'],
                                        datasets: [{
                                            label: '{{ $subject }} Statistics',
                                            data: [{{ $scores['mean'] }}, {{ $scores['median'] }}, {{ $scores['mode'] }}, {{ $scores['stdDev'] }}],
                                            backgroundColor: 'rgba(153, 102, 255, 0.6)',
                                            borderColor: 'rgba(153, 102, 255, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Statistic'
                                                }
                                            },
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Value'
                                                }
                                            }
                                        }
                                    }
                                });
                            @endforeach
                        @endif
                    });
                    </script>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        if (typeof Chart !== 'undefined') {
                            @if(isset($subjectScores) && count($subjectScores) > 0)
                                @foreach($subjectScores as $subject => $data)
                                    var ctx = document.getElementById('rangeGaugeChart_{{ $subject }}').getContext('2d');
                                    
                                    var rangeValue = {{ $data['range'] }};
                                    var maxRange = {{ $data['total'] }};

                                    new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            datasets: [{
                                                data: [rangeValue, maxRange - rangeValue],
                                                backgroundColor: ['#8b8000', '#e0e0e0'],
                                                borderWidth: 0
                                            }],
                                            labels: ['Range', '']
                                        },
                                        options: {
                                            circumference: 180,
                                            rotation: 270,
                                            cutout: '70%',
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: {
                                                tooltip: {
                                                    callbacks: {
                                                        label: function(tooltipItem) {
                                                            return 'Range: ' + tooltipItem.raw + ' out of ' + maxRange;
                                                        }
                                                    }
                                                },
                                                legend: {
                                                    display: false
                                                }
                                            }
                                        }
                                    });
                                @endforeach
                            @endif
                        }
                    });
                    </script>


            @endpush