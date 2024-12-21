@extends('layouts.dashboard')
@section('membercontent')

        <!-- Content Start -->
        <div class="content pt-4 px-4">
            <!-- Your content goes here -->
            <div class="row bg-white rounded align-items-center mx-0 mb-4 pt-3 pb-3">
                <div class="col-md-12 text-center ">
                    <h4 class="text-secondary">Review Your Entry</h4>
                    <p class="text-dark"><em>Enter your entry ID to reveiw your dashboard analysis</em></p>
                </div>
            </div>




            <div class="row pt-3 pb-3 bg-white rounded align-items-center justify-content-center mx-0 mb-4" style="position: relative; background-image: url('{{asset('img/bg.png')}}'); background-position: bottom right; background-repeat: no-repeat; background-size: 1000px 600px;">
                <div class="col-md-9 col-lg-6 col-xs-9">
                    <div class="rounded h-100 p-4" style="position: relative;">
                        <form action="{{url('reports') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row formborder">
                                <div class="col-md-12 mt-4 col-xs-12 mb-4">
                                    <label class="form-label">Entry ID</label>
                                    <input type="number" name="id" class="form-control" required="">
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary rounded-pill m-2">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





            @endsection
            