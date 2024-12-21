<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Learning Crisis | Performance Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('img/favicon.png')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-top px-4 py-0">
            <div class="container">
                <a href="{{url('/')}}" class="navbar-brand mx-4 mb-1">
                    <img class="img-fluid" src="{{asset('img/logo1.png')}}" style="height:60px; width: auto; display:block; margin:0 auto;" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://learningrises.org">Website</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('reports')}}">Reports</a>
                        </li>
                    </ul>
                    <form class="d-none d-md-flex ms-4">
                        <input class="form-control bg-white border-0" type="search" placeholder="Search">
                    </form>
                    
                </div>
            </div>
        </nav>
        <!-- Navbar End -->


                @yield('membercontent')


                

            <!-- Footer Start -->
            <div class="container-fluid pt-4 bg-white" style="z-index:10999">
                <div class="bg-white rounded-top p-4">
                    <div class="row">
                        <div class="col-12 text-center text-dark">
                            &copy; <a href="{{url('/')}}">Learning Rises</a>, All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/chart/chart.min.js')}}"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://cdn2.hubspot.net/hubfs/476360/Chart.js"></script>
    <script src="https://cdn2.hubspot.net/hubfs/476360/utils.js"></script>
    <!-- Include Chart.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Chart.js Gauge plugin via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-doughnutlabel"></script>
    

    @stack('scripts')
    <SCRIPT language=Javascript>
       
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       //-->
    </script>

    <style>
        .chart-container {
            width: 50%;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
        }

        .info-icon {
            color: rgba(75, 192, 192, 0.6); /* Blue color for the icon */
            cursor: pointer;
            font-size: 1.5rem; /* Larger icon size */
            margin-left: 8px; /* Space between title and icon */
        }
        .tooltip-inner {
            background-color: #343a40; /* Dark background for tooltip */
            color: #fff; /* White text color */
            font-size: 0.875rem; /* Slightly smaller text */
            max-width: 200px; /* Responsive width */
            word-wrap: break-word; /* Wrap long words */
        }
        .tooltip-arrow {
            border-top-color: #343a40; /* Dark color for the tooltip arrow */
        }
        @media (max-width: 768px) {
            .tooltip-inner {
                max-width: 150px; /* Smaller width on smaller screens */
            }
        }

        #averageScoreByYearChart {
            width: 200px !important;
            height: 200px !important;
        }
    </style>

    <script>
        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var numberInputs = document.querySelectorAll('.number-input');

            numberInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9.]/g, '');
                });
            });
        });
    </script>
    
    

    <script>
        $('#subject').on('keydown, keyup', function () {
            //get a reference to the text input value
            var texInputValue = $('#subject').val();
            
            if (texInputValue == 1 ) {
                $('#nav-year').css('display', 'block');
                $('#nav-year-tab').css('display', 'block');
                $("#year").attr('required', '');
                //$('#nav-year-tab').addClass('active');    
                //$('#nav-subject-tab').removeClass('active');
            }else{
                $('#nav-year').css('display', 'none');
                $('#nav-year-tab').css('display', 'none');                
                $("#year").removeAttr('required');
            }
        });
    </script>

    
    
<style>
    
    .wrappers {
    box-shadow: 5px 0 5px -2px rgba(0, 0, 0, 0.7);
    font-size:12px;
    }

    input[type=radio] {
    position: absolute;
    opacity: 0.001;
    }

    .wrapper {
    padding: 1em;
    border-radius: 1em;
    box-shadow: 0 1em 2em rgba(0, 0, 0, 0.7);
    font-size:12px;
    }
    .wrapper label {
    margin-right: 2em;
    padding-bottom: 0.2em;
    line-height: 2;
    font-weight: bold;
    border-bottom: 0.2em solid transparent;
    transition: 0.3s cubic-bezier(0.3, 0.1, 0.3, 1);
    cursor: pointer;
    }
    .wrapper label:hover {
    color: #FFF028;
    }

    .chart {
    position: relative;
    display: grid;
    grid-gap: 1em;
    margin-top: 2em;
    padding: 1em 0 3em 0;
    }
    .chart:hover .value {
    filter: blur(0.1em);
    opacity: 0.63;
    }
    .chart .value {
    --value: 0%;
    width: var(--value);
    background-image: linear-gradient(to right, #E1C340, #37A6A0);
    box-shadow: inset 0 0 0 99vw rgba(255, 255, 255, calc(70% - var(--value)));
    padding: 5px;
    border-radius: 0 0.6em 0.6em 0;
    transition: 0.4s cubic-bezier(0.3, -0.1, 0.1, 1.4);
    }

    
    .chart .value:hover {
    opacity: 1;
    filter: blur(0);
    }
    
    .chart .value::before {
    white-space: nowrap;
    color: white;
    text-transform: uppercase;
    font-size: 0.9em;
    letter-spacing: 0.1em;
    font-weight: bold;
    text-shadow: 0 0.2em 1em #37A6A0;
    filter: drop-shadow(0 0.1em 0.2em #37A6A0);
    content: attr(data-name);
    }
    
    

    *,
    *::before,
    *::after {
    margin: 0;
    padding: 0;
    list-style-type: none;
    box-sizing: border-box;
    }

    ::-webkit-scrollbar {
    display: none;
    }


    .semi-donut {
    --percentage: 0;
    --fill: #FFF028;
    width: 200px;
    height: 100px;
    position: relative;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    overflow: hidden;
    color: var(--fill);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    box-sizing: border-box;
    }
    .semi-donut:after {
    content: "";
    width: 200px;
    height: 200px;
    border: 20px solid;
    border-color: rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.15) var(--fill) var(--fill);
    position: absolute;
    border-radius: 50%;
    left: 0;
    top: 0;
    box-sizing: border-box;
    transform: rotate(calc( 1deg * ( -45 + var(--percentage) * 1.8 ) ));
    -webkit-animation: fillAnimation 1s ease-in;
            animation: fillAnimation 1s ease-in;
    }


</style>
    
</body>

</html>