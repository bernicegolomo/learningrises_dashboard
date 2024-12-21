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
                                                        <h4 class="text-center" style="font-weight:600; font-size:25px">Search Records</h4>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="j-wrapper j-wrapper-640">
                                                            <form action="" method="post" class="j-pro" id="j-pro" novalidate>
                                                                <div class="j-content">

                                                                    <div class="j-unit">
                                                                    <label class="j-label">Your Phone Number</label>
                                                                    <div class="j-input">
                                                                        <label class="j-icon-right"><i class="icofont icofont-phone"></i></label>
                                                                        <input type="text" id="phone" name="phone">
                                                                    </div>
                                                                    </div>

                                                                    <div class="j-response"></div>

                                                                </div>

                                                                <div class="j-footer">
                                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xl-12 col-md-12">
                                        <div class="card">
                                            <div class="card-block">
                                                <div class="row align-items-center">
                                                    <div class="col-12">
                                                        <h4 class="text-center" style="font-weight:600; font-size:25px">View My Records</h4>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Phone Number</th>
                                                                        <th>Title</th>
                                                                        <th>Type</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>07031555119</td>
                                                                        <td>2022/2023 Maths Score (SS1)</td>
                                                                        <td>Class</td>
                                                                        <td>October 27th, 2022</td>
                                                                        <td>
                                                                            <div class="btn-group dropdown-split-inverse">
                                                                                <button type="button" class="btn btn-success"><i class="icofont icofont-exchange"></i>Action</button>
                                                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    <span class="sr-only">Toggle primary</span>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item waves-effect waves-light" href="#">View Record</a>
                                                                                    <a class="dropdown-item waves-effect waves-light" href="#">Edit Record</a>
                                                                                    <div class="dropdown-divider"></div>
                                                                                        <a class="dropdown-item waves-effect waves-light" href="#">Delete Record</a>
                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>07031555119</td>
                                                                        <td>2021/2022 Subject Scores (Ebuka Precious)</td>
                                                                        <td>Student</td>
                                                                        <td>January 3rd, 2022</td>
                                                                        <td>
                                                                            <div class="btn-group dropdown-split-inverse">
                                                                                <button type="button" class="btn btn-success"><i class="icofont icofont-exchange"></i>Action</button>
                                                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    <span class="sr-only">Toggle primary</span>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item waves-effect waves-light" href="#">View Record</a>
                                                                                    <a class="dropdown-item waves-effect waves-light" href="#">Edit Record</a>
                                                                                    <div class="dropdown-divider"></div>
                                                                                        <a class="dropdown-item waves-effect waves-light" href="#">Delete Record</a>
                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
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



