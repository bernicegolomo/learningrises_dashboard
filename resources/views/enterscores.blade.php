@extends('layouts.dashboard')
@section('membercontent')

            <div class="content pt-4 px-4">
                <div class="row bg-white rounded align-items-center mx-0 mb-4 pt-3 pb-3">
                    <div class="col-md-12 text-center ">
                        <h4 class="text-secondary">Enter Student Scores</h4>
                    </div>
                </div>
                
                <div class="row bg-white rounded align-items-center mx-0 mb-4 pt-3 pb-3">
                    <div class="col-md-12 text-center">
                        <div class="mt-5">
                                <h4 class="text-center fs-18 text-dark">Mass Upload</h4>
                                <p class="text-center fs-18 text-dark">Download sample upload sheet <a href="{{ url('downloadexcel', ['class' => $classez , 'subject' => $subjectz, 'year' => $yearz]) }}" class="text-primary">here</a></p>
                                <form action="{{url('submitbulkscores') }}" method="POST"  enctype="multipart/form-data">
                                    @csrf 
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-md-6 text-center">
                                            <input type="file" name="uploaded_file" class="form-control" required="">
                                            <input type="hidden" name="type" @if($yearz == 0) value="subject" @else value="year" @endif class="form-control" required="">
                                            @if($yearz != 0)
                                            <input type="text" name="subject" placeholder="Enter Subject Title" class="form-control mt-2">
                                            <!--<p class="text-center fs-18">Download sample upload sheet <a href="{{asset('back/excel/sampleyear.xlsx')}}" class="text-primary">here</a></p>-->
                                            @else
                                            <!--<p class="text-center fs-18">Download sample upload sheet <a href="{{asset('back/excel/samplesubject.xlsx')}}" class="text-primary">here</a></p>-->
                                            @endif
                                            <div class="pt-3 pb-3 rounded align-items-center justify-content-center mx-0">
                                                <button type="submit" name="upload" class="btn btn-primary m-2">Upload Record</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div><hr>
                            
                    </div>
                </div>
                
                
                <div class="bg-white pt-3 pb-3 bg-white rounded align-items-center justify-content-center mx-0 mb-4">

                    <div class="container">
                    
                            
                        <div class="table-responsive">
                            @if($yearz == 0)
                                <form action="{{url('submitscores') }}" method="POST"  enctype="multipart/form-data">   
                                    @csrf 
                                    
                                    
                                    <table class="table text-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Student Name</th>
                                                @for ($x = 1; $x <= $subjectz; $x++)                                         
                                                    <th scope="col">                                            
                                                        <label class="form-label">Enter Subject Name</label>
                                                        <input type="text" name="subject[{{ $x }}]" Placeholder="" class="form-control" required="">
                                                    </th>
                                                @endfor
                                                
                                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 1; $i <= $classez; $i++)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td><input type="text" name="student[{{$i}}]" Placeholder="" class="form-control" required=""></td>
                                                @for ($z = 1; $z <= $subjectz; $z++)
                                                    <td><input type="text" name="score[{{$i}}][{{$z}}]" Placeholder="Enter Score"  id="txtChar"  class="form-control number-input" required=""></td>
                                                @endfor
                                            </tr>
                                            
                                            @endfor
                                            <tr>
                                                <td><input type="text" name="total" value="{{$totalz}}" class="form-control" required=""></td>
                                                <td><input type="text" name="class_size" value="{{$classez}}" class="form-control" required=""></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary rounded-pill m-2 align-items-center">Submit Scores</button>
                                    </div>
                                </form>
                            @else
                                <form action="{{url('submitscoresyear') }}" method="POST"  enctype="multipart/form-data">   
                                    @csrf 

                                    <label class="form-label mt-4 text-dark">Enter Subject <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" Placeholder="" class="form-control" required="">
                                    <table class="table mt-5 text-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Student Name</th>
                                                @for ($x = 1; $x <= $yearz; $x++)                                         
                                                    <th scope="col">                                            
                                                        <label class="form-label">Enter Year</label>
                                                        <input type="text" name="year[{{ $x }}]" Placeholder="" class="form-control" required="">
                                                    </th>
                                                @endfor
                                                
                                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 1; $i <= $classez; $i++)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td><input type="text" name="student[{{$i}}]" Placeholder="" class="form-control" required=""></td>
                                                @for ($z = 1; $z <= $yearz; $z++)
                                                    <td><input type="text" name="score[{{$i}}][{{$z}}]" Placeholder="Enter Score" id="txtChar" class="form-control number-input" required=""></td>
                                                @endfor
                                            </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="total" value="{{$totalz}}" class="form-control" required="">
                                    <input type="hidden" name="class_size" value="{{$classez}}" class="form-control" required="">
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary rounded-pill m-2 align-items-center">Submit Scores</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>                
           

				</div>
				
            @endsection