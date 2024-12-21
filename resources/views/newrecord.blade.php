@extends('layouts.dashboard')
@section('membercontent')


              <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="page-body">
                                <div class="row">

                                    <div class="col-xl-12 col-md-12">
                                        <div class="card">
                                            <div class="card-block">
                                                <div class="row align-items-center">
                                                    <div class="col-12">
                                                        <h4 class="text-center" style="font-weight:600; font-size:25px">New Report</h4>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="wrapper wrapper-640">
                                                            <form action="#" method="post" class="j-forms" id="j-forms" novalidate>

                                                                <div class="content">
                                                                    <div class="divider-text gap-top-20 gap-bottom-45">
                                                                        <span>Record Details</span>
                                                                    </div>

                                                                    <div class="clone-widget">
                                                                        <div class="unit widget toclone">
                                                                            <div class="input">
                                                                                <select name="type" id="type" required="">
                                                                                    <option value="" selected="">Select Record Type</option>
                                                                                    <option value="class">Class Scores (Multiple Students with single subject)</option>
                                                                                    <option value="student">Student Scores (One Student with multiple Subjects) </option>
                                                                                </select>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="clone-widget">
                                                                        <div class="unit widget toclone">
                                                                            <div class="input">
                                                                                <input type="text" name="title" placeholder="Enter Record Title"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="clone-widget">
                                                                        <div class="unit widget toclone">
                                                                            <div class="input">
                                                                                <input type="text" name="phone" placeholder="Enter Phone Number"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <div class="divider-text gap-top-45 gap-bottom-45">
                                                                        <span>Enter Scores</span>
                                                                    </div>

                                                                    <div id="students" style="display:none;">
                                                                        <div class="clone-widget">
                                                                            <div class="unit widget toclone">
                                                                                <div class="input">
                                                                                    <input type="text" name="name" placeholder="Student's Full Name"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="clone-link">
                                                                            <div class="toclone">
                                                                                <button class=" clone btn btn-primary m-b-15">add new student score</button>
                                                                                <button class=" delete  btn btn-danger m-b-15">delete student score</button>
                                                                                <div class="j-row">
                                                                                    <div class="span6 unit">
                                                                                        <div class="input">
                                                                                            <input type="text" name="subject[]" placeholder="Subject">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span6 unit">
                                                                                        <div class="input">
                                                                                            <input type="text" name="score[]" placeholder="Score">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>


                                                                    <div id="class" style="display:none">
                                                                        <div class="clone-widget">
                                                                            <div class="unit widget toclone">
                                                                                <div class="input">
                                                                                    <input type="text" name="subject" placeholder="Subject"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="clone-link">
                                                                            <div class="toclone">
                                                                                <button class=" clone btn btn-primary m-b-15">add new class score</button>
                                                                                <button class=" delete  btn btn-danger m-b-15">delete class score</button>
                                                                                <div class="j-row">
                                                                                    <div class="span6 unit">
                                                                                        <div class="input">
                                                                                            <input type="text" name="student[]" placeholder="Student's Full Name">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span6 unit">
                                                                                        <div class="input">
                                                                                            <input type="text" name="scores[]" placeholder="Score">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="footer">
                                                                    <button type="submit" class="btn btn-primary m-b-0">Save & Continue</button> 
                                                                    <button type="submit" class="btn btn-success m-b-0" style="margin-right:10px;">Save & Generate Report</button>
                                                                </div>

                                                            </form>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>

                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @endsection



