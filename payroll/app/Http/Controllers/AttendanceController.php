<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;
use PhpParser\Node\Stmt\If_;

class AttendanceController extends Controller
{
    private $employee_id;
    /**
     * Class constructor.
     */
    public function __construct(string $employee_id = null)
    {
        $this->employee_id = $employee_id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function store($employee_id)
    { //



        $now = Carbon::createFromFormat('H:i:s', Carbon::now()->format('H:i:s'));
        $recordExists = Attendance::where('employee_id', $employee_id)->whereDate('date', date('Y-m-d'))->exists();


        if (!$recordExists) {
            Attendance::create([
                'check_in_time' => $now,
                'date' => date('Y-m-d'),
                'employee_id' => $employee_id

            ]);
        }
        // $time2 = Carbon::createFromFormat('H:i:s', '23:45:00');
        // dd($now->diffInHours($time2))
        // ;
        // dd($now);

        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update($employee_id)
    {
        //
        $now = Carbon::createFromFormat('H:i:s', Carbon::now()->format('H:i:s'));
        $record = Attendance::where('employee_id', $employee_id)->whereDate('date', date('Y-m-d'))->first();
     
        $check_in_time = $record->check_in_time;


        if ($record) {
            Attendance::where('employee_id', $employee_id)->whereDate('date', date('Y-m-d'))->update([
                'check_out_time' => $now,
                'total_hours' => $now->diffInHours($check_in_time)
            ]);


        }
        return response(200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
