@extends('layouts.dashboard')
@section('membercontent')

            <div class="container-fluid pt-4 px-4">
                <div class="row bg-secondary rounded align-items-center mx-0 mb-4 pt-3 pb-3">
                    <div class="col-md-12 text-center ">
                        <h4 class="text-white">Ready-made Assessment Tool for Educators</h4>
                    </div>
                </div>

                <div class="row pt-3 pb-3 bg-secondary rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-9">
                        <div class="bg-secondary rounded h-100 p-4">
                            <p class="text-center mb-5 text-white"> This tool allows you to turn your data into information and intelligence needed for decision making to improve classroom experience</p>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-class-tab" data-bs-toggle="tab" data-bs-target="#nav-class" type="button" role="tab" aria-controls="nav-class" aria-selected="true">Class Size</button>
                                    <button class="nav-link" id="nav-subject-tab" data-bs-toggle="tab" data-bs-target="#nav-subject" type="button" role="tab" aria-controls="nav-subject" aria-selected="false">Subjects</button>
                                    <button class="nav-link" id="nav-year-tab" data-bs-toggle="tab" data-bs-target="#nav-year" type="button" role="tab" aria-controls="nav-year" aria-selected="false" style="display:none;">Year</button>
                                </div>
                            </nav>
                            <form action="{{url('startassessment') }}" method="POST"  enctype="multipart/form-data">   
                                @csrf 
                                <div class="tab-content pt-4 me-3" id="nav-tabContent">
                                    <div class="tab-pane  active show" id="nav-class" role="tabpanel" aria-labelledby="nav-class-tab">
                                        <label class="form-label">Enter Total Number of Students In Class</label>
                                        <input type="number" name="class" class="form-control" required="">
                                    </div>
                                    <div class="tab-pane fade" id="nav-subject" role="tabpanel" aria-labelledby="nav-subject-tab">
                                        <label class="form-label">Enter Total Number of Subjects</label>
                                        <input type="number" id="subject" name="subject" class="form-control" required="">
                                    </div>
                                    <div class="tab-pane fade" id="nav-year" role="tabpanel" aria-labelledby="nav-year-tab" style="display:none;">
                                        <label class="form-label">Enter Number of Years</label>
                                        <input type="number" name="year" class="form-control" id="year">
                                    </div>

                                    <hr><br/>
                                    <button type="submit" class="btn btn-primary rounded-pill m-2">Proceed To Enter Records</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

				</div>
				
            </div>
            
            @endsection