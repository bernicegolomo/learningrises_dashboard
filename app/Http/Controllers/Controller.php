<?php

namespace App\Http\Controllers;
//namespace App\Http\Exports\fileExport;

use App\Exports\fileExport;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Imports\fileImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\scores;
use App\Models\EntryData;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() 
    {        

        return view('home');
    }

    public function dashboard($id)
    { 
        if(!isset($id) || $id == null){
            return view('home')->with('error', 'Access Denied.');
        }
        //$studentTotal = [];
        //$studentscores = scores::where('scores_id', $id)->groupBy("student")->get();
        $data = EntryData::where('scores_id', $id)->first();
        if($data && !empty($data)){
            $subjects = scores::where('entry_id', $data->id)->groupBy("subject")->get();
            
            //get class size
            $classsize = $data->class_size; //scores::where("scores_id",$id)->groupBy("student")->count();
            
            $score_id = $id;

            

            // Fetch scores grouped by subject and calculate averages
            $averageScores = scores::select('subject', \DB::raw('AVG(score) as average_score'))
                                    ->where('entry_id', $data->id)
                                    ->groupBy('subject')
                                    ->get();

                                    //dd($averageScores);
            $subjectScores = $this->getSubjectScores($data);
            //dd($subjectScores); 
            return view('dashboard', compact('data', 'classsize', 'subjects', 'score_id', 'averageScores', 'subjectScores'));
        }

        return redirect()->back()->with('error', 'Invalid Entry ID');
        
    }

    public function getScoreDistributionData($dataId)
    {
        $data = EntryData::find($dataId);
        $total = $data->total;

        // Calculate ranges dynamically based on the total
        $rangeStep = max(10, floor($total / 5)); // Ensure at least 5 ranges, with a minimum step of 10
        $ranges = [];
        $start = 0;

        while ($start < $total) {
            $end = min($start + $rangeStep, $total);
            $ranges["$start-$end"] = [$start, $end];
            $start = $end + 1;
        }

        $subjects = scores::where('entry_id', $data->id)->groupBy('subject')->get();

        $distributionData = [];
        foreach ($subjects as $subject) {
            $subjectScores = scores::where('entry_id', $data->id)
                ->where('subject', $subject->subject)
                ->get('score');

            // Initialize counts for each range
            $counts = array_fill_keys(array_keys($ranges), 0);

            // Count the number of scores in each range
            foreach ($subjectScores as $score) {
                foreach ($ranges as $rangeName => $range) {
                    if ($score->score >= $range[0] && $score->score <= $range[1]) {
                        $counts[$rangeName]++;
                        break;
                    }
                }
            }

            $distributionData[$subject->subject] = $counts;
        }

        return response()->json($distributionData);
    }

    public function getSubjectScores($data)
    {
        $scores = scores::where('entry_id', $data->id)->get();
        $total = $data->total;  // Maximum possible range

        $subjectScores = $scores->groupBy('subject')->map(function ($subjectScores) use ($total) {
            $highestScores = $subjectScores->sortByDesc('score')->take(3);
            $lowestScores = $subjectScores->sortBy('score')->take(3);

            $scoresArray = $subjectScores->pluck('score')->map(function($score) {
                return (int)$score;
            })->toArray();

            $mean = array_sum($scoresArray) / count($scoresArray);
            sort($scoresArray);
            $middle = floor(count($scoresArray) / 2);
            $median = (count($scoresArray) % 2 == 0) ? ($scoresArray[$middle - 1] + $scoresArray[$middle]) / 2 : $scoresArray[$middle];
            $values = array_count_values($scoresArray);
            $mode = array_search(max($values), $values);
            $variance = array_reduce($scoresArray, function($carry, $item) use ($mean) {
                $carry += pow($item - $mean, 2);
                return $carry;
            }, 0) / count($scoresArray);
            $stdDev = sqrt($variance);

            // Calculate range
            $range = $subjectScores->max('score') - $subjectScores->min('score');

            return [
                'highest' => $highestScores->pluck('score', 'student')->toArray(),
                'lowest' => $lowestScores->pluck('score', 'student')->toArray(),
                'mean' => $mean,
                'median' => $median,
                'mode' => $mode,
                'stdDev' => $stdDev,
                'range' => $range,  // Include the range in the data
                'total' => $total   // Pass total for gauge chart maximum value
            ];
        });

        return $subjectScores;
    }


    public function reports(Request $request){

        $input = $request->all();
        if($input){
            $data = EntryData::select('entry_data.*', 'scores.*')
                        ->join('scores', 'scores.entry_id', '=', 'entry_data.id')
                        ->where('entry_data.scores_id', $request->id)->first();
						
            if($data && (!empty($data) || count($data) > 0)){
                if($data->year == null){
                    return redirect("/dashboard/$request->id");
                }elseif($data->year != null){
                    return redirect("/dashboardyear/$request->id");
                }
            }else{
                return redirect()->back()->with('error', 'Invalid Entry ID');
            }
            
        }else{
            return view('report');
        }
        
    }
    
    
   public function getYearlyScores($data)
{
    $scores = scores::where('entry_id', $data->id)->get();
    $total = $data->total;  // Maximum possible range

    $yearlyScores = $scores->groupBy('year')->map(function ($yearScores) use ($total) {
        // Sort scores to get highest and lowest
        $highestScores = $yearScores->sortByDesc('score')->take(3);
        $lowestScores = $yearScores->sortBy('score')->take(3);

        // Convert scores to integer array for calculations
        $scoresArray = $yearScores->pluck('score')->map(function($score) {
            return (int)$score;
        })->toArray();

        // Calculate mean
        $mean = array_sum($scoresArray) / count($scoresArray);

        // Calculate median
        sort($scoresArray);
        $middle = floor(count($scoresArray) / 2);
        $median = (count($scoresArray) % 2 == 0) ? ($scoresArray[$middle - 1] + $scoresArray[$middle]) / 2 : $scoresArray[$middle];

        // Calculate mode (handle multiple modes)
        $values = array_count_values($scoresArray);
        $maxCount = max($values);
        $modes = array_keys(array_filter($values, function($count) use ($maxCount) {
            return $count === $maxCount;
        }));

        // Calculate standard deviation
        $variance = array_reduce($scoresArray, function($carry, $item) use ($mean) {
            $carry += pow($item - $mean, 2);
            return $carry;
        }, 0) / count($scoresArray);
        $stdDev = sqrt($variance);

        // Calculate range
        $range = $yearScores->max('score') - $yearScores->min('score');

        return [
            'highest' => $highestScores->pluck('score', 'student')->toArray(),
            'lowest' => $lowestScores->pluck('score', 'student')->toArray(),
            'mean' => $mean,
            'median' => $median,
            'modes' => $modes,  // Update: Include all modes in the data
            'stdDev' => $stdDev,
            'range' => $range,  
            'total' => $total   
        ];
    });

    return $yearlyScores;
}


    public function getScoreDistributionByYear($dataId)
    {
        $data = EntryData::find($dataId);
        $total = $data->total;

        // Calculate ranges dynamically based on the total
        $rangeStep = max(10, floor($total / 5)); // Ensure at least 5 ranges, with a minimum step of 10
        $ranges = [];
        $start = 0;

        while ($start < $total) {
            $end = min($start + $rangeStep, $total);
            $ranges["$start-$end"] = [$start, $end];
            $start = $end + 1;
        }

        $scores = scores::where('entry_id', $dataId)->get();

        $distributionData = [];
        foreach ($scores->groupBy('year') as $year => $yearScores) {
            // Initialize counts for each range
            $counts = array_fill_keys(array_keys($ranges), 0);

            // Count the number of scores in each range
            foreach ($yearScores as $score) {
                foreach ($ranges as $rangeName => $range) {
                    if ($score->score >= $range[0] && $score->score <= $range[1]) {
                        $counts[$rangeName]++;
                        break;
                    }
                }
            }

            $distributionData[$year] = $counts;
        }

        return response()->json($distributionData);
    }



    function isEven($number){
        if($number % 2 == 0){
           return true; 
        }
        else{
            return false;
        }
    }

    public function dashboardyear($id)
    {        
        if(!isset($id) || $id == null){
            return view('home')->with('error', 'Access Denied.');
        }
        
        $data = EntryData::where('scores_id', $id)->first();
        if($data && !empty($data)){
            $years = scores::where('entry_id', $id)->groupBy("year")->get();
            $students = scores::where('entry_id',$id)->groupBy('student')->get();
            $subjectScores = $this->getYearlyScores($data);

            $score_id = $id;
            
            //echo "<pre>"; print_r($deviation); echo "</pre>"; die();
            
            return view('dashboardyear', compact('years', 'score_id', 'students','data', 'subjectScores'));
        }

        return redirect()->back()->with('error', 'Invalid Entry ID');
    }

    public function records()
    {        

        return view('records');
    }

    public function newrecord()
    {        

        return view('newrecord');
    }

    public function startassessment(Request $request){ 
        $request->validate([
            'class'     => ['required', 'numeric', 'max:255'],
            'subject'   => ['required', 'numeric'],
            'year'      => ['nullable', 'numeric'],
            'total'     => ['required', 'numeric'],
        ]);

        if(isset($request->year)){
            $yearz = $request->year;
        }else{
            $yearz = 0;
        }

//die();
        $classez    = $request->class;
        $subjectz   = $request->subject;
        $totalz     = $request->total;

        return view('enterscores', compact('classez', 'subjectz', 'yearz', 'totalz'));

    }



    public function downloadexcel($class,$subject,$year){
        $header = []; $data1 = []; $data2 = [];
        

        if($year == 0){
            $header[] = "STUDENT NAME";
            $data1["Student Name"] = "John Deo";
            for ($x = 1; $x <= $subject; $x++) {                                        
                $header[] = "MATHEMATICS";   
                $data2["Subject Score$x"] = "50";             
            }
            //print_r($data2); die();            
        }else{
            $header[] = "STUDENT NAME";
            $data1["Student Name"] = "John Deo";
            for ($x = 1; $x <= $year; $x++){                                        
                $header[] = "YEAR $x";   
                $data2["Subject Score$x"] = "50";                                    
            }
        }
        
        $data[] = array_merge($data1, $data2);

          
        return Excel::download(new fileExport($data,$header), 'sample.xlsx');       


        //return view('enterscores', compact('class', 'subject', 'year'));
    }

    public function RandomString($length, $charset='123456789'){
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }

    public function submitbulkscores(Request $request){

        if($request->hasFile('uploaded_file')){
            $the_file = $request->file('uploaded_file');


            try{
                $spreadsheet = IOFactory::load($the_file->getRealPath());
                $sheet = $spreadsheet->getActiveSheet();
                

                $user = "07031555119";
                $scoreid = $this->RandomString(6);
                $date = date("Y-m-d");
                $spreadsheet = IOFactory::load($the_file);
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sub = [];

                if(isset($_POST['subject']) && !empty($_POST['subject'])){
                    $subject = strtoupper($_POST['subject']);
                    foreach($sheetData as $x=>$score){ 
                        if($x != 1 && !empty($score) && isset($score["A"])){ 
                            foreach($sheetData[1] as $y=>$year){
                                //$student = $subject["A"];                            
                                if($y != "A"){ 
                                    //dd($score["A"]);
                                    //dd($score["A"]); die();
                                    //dd($score[$y]);
                                    $student = strtoupper($score["A"]);
                                    $years = $year;
                                    $studscore = $score[$y];

                                    scores::create([
                                        'user_phone'    => $user,
                                        'scores_id'     => $scoreid,
                                        'student'       => $student,
                                        'subject'       => $subject,
                                        'year'          => $years,
                                        'score'         => $studscore,
                                        'date'          => $date
                                    ]);
                                }
                            }
                        }
                        
                    }
                }else{
                    foreach($sheetData as $x=>$score){ 
                        if($x != 1 && !empty($score) && isset($score["A"])){ 
                            foreach($sheetData[1] as $y=>$subject){
                                //$student = $subject["A"];                            
                                if($y != "A"){ 
                                    //dd($score["A"]);
                                    //dd($score["A"]); die();
                                    //dd($score[$y]);
                                    $student = strtoupper($score["A"]);
                                    $subject = strtoupper($subject);
                                    $studscore = $score[$y];

                                    scores::create([
                                        'user_phone'    => $user,
                                        'scores_id'     => $scoreid,
                                        'student'       => $student,
                                        'subject'       => $subject,
                                        'score'         => $studscore,
                                        'date'          => $date
                                    ]);
                                }
                            }
                        }
                        
                    }
                }
                                
            } catch (Exception $e) {
                $error_code = $e->errorInfo[1];
                return redirect('index')->with('error', 'There was error in uploading your data.');
            }
            if(isset($_POST['subject']) && !empty($_POST['subject'])){
                return \Redirect::route('dashboardyear', $scoreid)->with('success', 'Great! Data has been successfully uploaded.');
            }else{
                return \Redirect::route('dashboard', $scoreid)->with('success', 'Great! Data has been successfully uploaded.');
            }
            
        }
    
    }

    
    public function submitscores(Request $request){
        // Validate the request data
        $validatedData = $request->validate([
            'student.*.*'   => 'required|string|min:0|max:100',
            'score.*.*'     => 'required|numeric|min:0|max:100',
            'subject.*.*'   => 'required|string|min:0|max:100',
            'total'         => ['required', 'integer'],
            'class_size'    => ['required', 'integer'],
        ]);

        
        if($validatedData){

            $user = "07031555119";
            $scoreid = $this->RandomString(6);

            //save into Entry table
            $saveE = EntryData::create([
                'user_phone'  => $user,
                'scores_id'   => $scoreid,
                'total'       => $request->total,
                'class_size'  => $request->class_size,
            ]);

            foreach($request->subject as $key=>$subject){
                foreach($request->student as $skey=>$student){
                    $student = strtoupper($student);
                    $subject = strtoupper($subject);
                    $score = $request->score[$skey][$key];

                    $save = scores::create([
                                'entry_id'    => $saveE->id,
                                'student'     => $student,
                                'subject'     => $subject,
                                'score'       => $score,
                            ]);
                
                }
            }

            if($save){
                return \Redirect::route('dashboard', $scoreid)->with('success', 'Great! Data has been successfully uploaded.');
            }
        }
        
        
        return redirect()->back()->with('error', 'Invalid Entry ID');
    }


    public function submitscoresyear(Request $request){  
        // Validate the request data
        $validatedData = $request->validate([
            'student.*' => 'required|string|min:0|max:100',
            'score.*.*' => 'required|numeric|min:0|max:100',
            'subject'   => 'required|string|min:0|max:100',
            'year.*'    => ['required'],
            'total'     => ['required', 'integer'],
            'class_size'=> ['required', 'integer'],
        ]);

        
        if($validatedData){

            $user = "07031555119";
            $scoreid = $this->RandomString(6);

            //save into Entry table
            $saveE = EntryData::create([
                'user_phone'  => $user,
                'scores_id'   => $scoreid,
                'class_size'  => $request->class_size,
                'total'       => $request->total
            ]);
            

            $user = "07031555119";
            $scoreid = $this->RandomString(6);
            $date = date("Y-m-d");
            $subject = strtoupper($request->subject);
            foreach($request->year as $key=>$year){
                foreach($request->student as $skey=>$student){
                    $student = strtoupper($student);
                    $years = $year;
                    $score = $request->score[$skey][$key];
        
                    $save = scores::create([
                            'entry_id'    => $saveE->id,
                            'student'     => $student,
                            'subject'     => $subject,
                            'year'        => $years,
                            'score'       => $score,
                        ]);
                }
            }


            if($save){
                return \Redirect::route('dashboardyear', $scoreid)->with('success', 'Great! Data has been successfully uploaded.');
            }
        }

        return redirect()->back()->with('error', 'Error in validating input.');
    }


    public function getClassSizeByYear($entryId)
    {
        $classSizeByYear = DB::table('scores')
                        ->select('year', DB::raw('count(*) as class_size'))
                        ->where('entry_id', $entryId)
                        ->groupBy('year')
                        ->orderBy('year') // Optional: order by year if needed
                        ->get();

        return response()->json($classSizeByYear);
    }

    public function getAverageScoreByYear($id)
    {
        $scores = DB::table('scores')
            ->where('entry_id', $id)
            ->select('year', DB::raw('GROUP_CONCAT(score) as scores'))
            ->groupBy('year')
            ->get();

        $scores->transform(function($item) {
            $item->scores = explode(',', $item->scores);
            return $item;
        });

        return response()->json($scores);
    }


}


