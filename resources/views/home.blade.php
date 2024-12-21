@extends('layouts.dashboard')
@section('membercontent')

        <!-- Content Start -->
        <div class="content pt-4 px-4">
            <!-- Your content goes here -->
            <div class="row bg-white rounded align-items-center mx-0 mb-4 pt-3 pb-3">
                <div class="col-md-12 text-center ">
                    <h4 class="text-secondary">Ready-made Assessment Tool for Educators</h4>
                </div>
            </div>




            <div class="row pt-3 pb-3 bg-white rounded align-items-center justify-content-center mx-0 mb-4" style="position: relative; background-image: url('{{asset('img/bg.png')}}'); background-position: bottom right; background-repeat: no-repeat; background-size: 1000px 600px;">
                <div class="col-md-9 col-lg-6 col-xs-9">
                    <div class="rounded h-100 p-4" style="position: relative;">
                        <p class="text-center mb-5 text-dark"> This tool allows you to turn your data into information and intelligence needed for decision making to improve classroom experience</p>
                        
                        <form action="{{url('startassessment') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row formborder">
                                <div class="col-md-12 mt-2 col-xs-12">
                                    <h4  class="text-center mb-2 text-dark">Fill the form below!</h4>
                                </div>
                                <div class="col-md-6 mt-4 col-xs-12">
                                    <label class="form-label text-dark">Number of Students In Class <span class="text-danger">*</span></label>
                                    <input type="text" name="class" class="form-control number-input" required="">
                                </div>
                                <div class="col-md-6 mt-4 col-xs-12" id="nav-subject">
                                    <label class="form-label text-dark">Number of Subjects <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" id="subject" class="form-control number-input" required="">
                                </div>
                                <div class="col-md-12 mt-4 col-xs-12" id="nav-year"  style="display:none;">
                                    <label class="form-label text-dark">Number of Years</label>
                                    <input type="text" name="year" id="year" class="form-control number-input">
                                </div>

                                <div class="col-md-12 mt-4 col-xs-12">
                                    <label class="form-label text-dark mt-4">Enter Score Overall Band <span class="text-danger">*</span></label>
                                    <input type="text" name="total" class="form-control number-input" required="">
                                </div>


                                <hr class="bg-secondary text-secondary mt-5"><br>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary rounded-pill m-2">Proceed To Enter Records</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





            @endsection
            