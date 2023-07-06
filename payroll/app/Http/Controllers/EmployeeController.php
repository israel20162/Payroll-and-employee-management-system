<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View as ViewView;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): ViewView
    {
        $departments = Department::all();
        $employees = Employee::paginate(10);


        return view('employees', [
            'departments' => $departments,
            'employees' => $employees,
            'headings' => array(
                'name',
                'contact',
                'employee id',
                'department',
                'position',
                'current salary',
                'actions'

                // 'employment type',
                // 'email', 'salary type',
                // 'year joined',
            )
        ]);

        // $comments = Position::find(1)->employees()->where('id',1)->first();
// return $comments;
//         // $comment = Employee::find(1);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request):ViewView
    {
        //
        $q = $request->input('q');
        $employees = Employee::paginate(10);
        if ($q != '') {
            $employee = Employee::where('name', 'LIKE', '%' . $q . '%')->orWhere('employee_id', 'LIKE', '%' . $q . '%')->paginate(5)->setPath('');
            $pagination = $employee->appends(array('q' => $request->input('q')));
            if (count($employee) > 0){
                return view('employees', [

                    'employees' => $employee,
                    'headings' => array(
                        'name',
                        'contact',
                        'employee id',
                        'department',
                        'position',
                        'current salary',
                        'actions'

                        // 'employment type',
                        // 'email', 'salary type',
                        // 'year joined',
                    )
                ])
            ;}
            return view('employees',['headings' => array(
                        'name',
                        'contact',
                        'employee id',
                        'department',
                        'position',
                        'current salary',
                        'actions'

                        // 'employment type',
                        // 'email', 'salary type',
                        // 'year joined',
                    )])->with('message','No Employee found');
        }
        return view('employees', [

            'employees' => $employees,
            'headings' => array(
                'name',
                'contact',
                'employee id',
                'department',
                'position',
                'current salary',
                'actions'

                // 'employment type',
                // 'email', 'salary type',
                // 'year joined',
            )
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee)
    {
        //
    }
}
