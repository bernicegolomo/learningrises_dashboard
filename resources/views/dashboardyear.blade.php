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
                                <canvas id="classSizeByYearChart" width="400" height="500"></canvas>
                            </div>
                        </div>
                            
                    </div>

                    <div class="col-md-4 text-center">
                        <div class="bg-white rounded align-items-center mx-0 pt-3 pb-3">
                            <h5 class="text-center fs-18 text-dark">
                                Average Scores by Year
                                <i class="bi bi-info-circle info-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="It is the measure of class performance and it is derived by summing up all individual scores which is then divided by the number of students in the class. It gives a quick snapshot of how a class performed on average."></i>
                            </h5>
                            <div class="d-flex justify-content-center">
                                <canvas id="averageScoreByYearChart" width="300" height="200"></canvas>
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
                                <canvas id="scoreDistributionByYearChart" width="600" height="220"></canvas>
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
                <script>
                    fetch('{{ url('/getClassSizeByYear/' . $data->id) }}')
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            const years = data.map(item => item.year);
                            const classSizes = data.map(item => item.class_size);

                            // Define an array of colors to apply to each bar
                            const backgroundColors = [
                                'rgba(139, 128, 0, 0.6)',   // #8b8000 - your primary color
                                'rgba(188, 176, 0, 0.6)',
                                'rgba(199, 199, 199, 0.6)',
                                'rgba(150, 140, 10, 0.6)',
                                'rgba(230, 180, 50, 0.6)',
                                'rgba(100, 100, 50, 0.6)',
                                'rgba(220, 190, 80, 0.6)',
                                'rgba(170, 160, 40, 0.6)',
                                'rgba(200, 200, 100, 0.6)',
                                'rgba(160, 140, 60, 0.6)',
                                // Add more colors as needed
                            ];

                            const ctx = document.getElementById('classSizeByYearChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: years,
                                    datasets: [{
                                        label: 'Class Size by Year',
                                        data: classSizes,
                                        backgroundColor: backgroundColors.slice(0, classSizes.length), // Ensure colors array matches data length
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });


                </script>

                <script>
                    fetch('{{ url('/getAverageScoreByYear/' . $data->id) }}')
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // Check structure here

                            const years = data.map(item => item.year);
                            const averageScores = data.map(item => {
                                if (item.scores && item.scores.length > 0) {
                                    const totalScore = item.scores.reduce((sum, score) => sum + parseInt(score, 10), 0);
                                    return totalScore / item.scores.length;
                                } else {
                                    return 0; // Default if no scores
                                }
                            });

                            const ctx = document.getElementById('averageScoreByYearChart').getContext('2d');
                            if (ctx) {
                                new Chart(ctx, {
                                    type: 'doughnut', // Change to doughnut
                                    data: {
                                        labels: years,
                                        datasets: [{
                                            label: 'Average Score by Year',
                                            data: averageScores,
                                            backgroundColor: [
                                                'rgba(75, 192, 192, 0.6)',
                                                'rgba(153, 102, 255, 0.6)',
                                                'rgba(199, 199, 199, 0.6)',
                                                'rgba(150, 140, 10, 0.6)',
                                                'rgba(230, 180, 50, 0.6)',
                                                'rgba(100, 100, 50, 0.6)',
                                                'rgba(220, 190, 80, 0.6)',
                                                'rgba(170, 160, 40, 0.6)',
                                                'rgba(200, 200, 100, 0.6)',
                                                'rgba(160, 140, 60, 0.6)',
                                            ],
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(context) {
                                                        return `${context.label}: ${context.raw.toFixed(2)}`;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            } else {
                                console.error("Canvas element not found.");
                            }
                        })
                        .catch(error => console.error('Error fetching data:', error));

                </script>

                <script>
                    fetch('{{ url('/getScoreDistributionByYear/' . $data->id) }}')
                        .then(response => response.json())
                        .then(data => {
                            const years = Object.keys(data);
                            const ranges = Object.keys(data[years[0]]); // Assuming all years have the same ranges

                            // Initialize datasets
                            const datasets = ranges.map((range, index) => ({
                                label: `${range}`,
                                data: years.map(year => data[year][range] || 0),
                                backgroundColor: getColor(index),
                                borderColor: getColor(index),
                                borderWidth: 1
                            }));

                            const ctx = document.getElementById('scoreDistributionByYearChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: years, // Years on the y-axis
                                    datasets: datasets
                                },
                                options: {
                                    responsive: true,
                                    indexAxis: 'y', // Make the bar chart horizontal
                                    plugins: {
                                        legend: {
                                            position: 'right' // Move legend to the right for better visibility
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(tooltipItem) {
                                                    return `Year ${tooltipItem.label}: ${tooltipItem.raw}`;
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        x: {
                                            stacked: true, // Enable stacking on the x-axis
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Number of Students'
                                            }
                                        },
                                        y: {
                                            stacked: true, // Enable stacking on the y-axis
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Years'
                                            }
                                        }
                                    }
                                }
                            });
                        });

                    // Function to generate a color for each dataset
                    function getColor(index) {
                        const colors = [
                            '#FF6384',
                            '#36A2EB',
                            '#FFCE56',
                            '#4BC0C0',
                            '#9966FF',
                            '#FF9F40',
                            '#E7E9ED',
                            '#C9CBCF',
                            '#F1C40F',
                            '#E74C3C'
                        ];
                        return colors[index % colors.length];
                    }
                </script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(isset($subjectScores) && count($subjectScores) > 0)
        @foreach($subjectScores as $subject => $scores)
            // Log the scores to ensure the data is correct
            console.log("Scores for subject {{ $subject }}:", @json($scores));

            const ctx = document.getElementById('statsChart_{{ $subject }}').getContext('2d');
            const modes = @json($scores['modes']);

            // Verify if canvas element exists
            if (!ctx) {
                console.error('Canvas element for {{ $subject }} not found');
                return;
            }

            // Initialize the chart
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mean', 'Median', 'Mode(s)', 'Std Dev'],
                    datasets: [{
                        label: '{{ $subject }} Statistics',
                        data: [
                            {{ $scores['mean'] }},
                            {{ $scores['median'] }},
                            modes.length > 1 ? modes.join(', ') : modes[0],  // Handle multiple modes
                            {{ $scores['stdDev'] }}
                        ],
                        backgroundColor: 'rgba(153, 102, 255, 0.6)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        pointStyle: 'circle',
                        pointRadius: 5
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
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    if (context.label === 'Mode(s)') {
                                        // Display all modes properly in the tooltip
                                        return `Mode(s): ${modes.join(', ')}`;
                                    } else {
                                        return `${context.label}: ${context.raw}`;
                                    }
                                }
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