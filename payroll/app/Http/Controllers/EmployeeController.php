<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Models\Appointment;
use App\Models\Employee;
// use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Position;
use App\Models\Department;
use App\Models\PaymentsHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AttendanceController;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\View\View as ViewView;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Spatie\Permission\Models\Role;

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
        $permissions = Permission::all();
        $roles = Role::get();

        // $roles = Role::with('employees')->get();

        $employees = Employee::paginate(10);


        return view('employees.index', [
            'departments' => $departments,
            'employees' => $employees,
            'permissions' => $permissions,
            'roles' => $roles,
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
    public function search(Request $request): ViewView
    {
        //
        $q = $request->input('q');
        $employees = Employee::paginate(10);
        if ($q != '') {
            $employee = Employee::where('name', 'LIKE', '%' . $q . '%')->orWhere('employee_id', 'LIKE', '%' . $q . '%')->paginate(5)->setPath('');
            $pagination = $employee->appends(array('q' => $request->input('q')));
            if (count($employee) > 0) {
                return view('employees.index', [

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
                ;
            }
            return view('employees.index', [
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
            ])->with('message', 'No Employee found');
        }
        return view('employees.index', [

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
    public function create(): ViewView
    {
        //
        $positions = Position::get();
        $departments = Department::get();
        return view('employees.create', ['positions' => $positions, 'departments' => $departments]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        //

        $employee_id = substr($request->input('year'), -2) . '0' . $request->input('department') . '0' . $request->input('position') . '0' . Employee::count();

        Employee::create([
            'name' => $request->input('lastName') . ' ' . $request->input('firstName'),
            'contact' => $request->input('contact'),
            'email' => $request->input('email'),
            'position_id' => $request->input('position'),
            'position' => Position::find($request->input('position'))->name,
            'department_id' => $request->input('department'),
            'department' => Department::find($request->input('department'))->name,
            'salary_type' => $request->input('salary'),
            'current_salary' => intval($request->input('current_salary')),
            'gender' => $request->input('gender'),
            'employee_id' => $employee_id,
            'year_joined' => $request->input('year'),
            'password' => bcrypt($request->input('lastName'))
        ]);

        return redirect()->route('employees')->with('success', 'created succesfully');



    }
    public function assignRole(Request $request)
    {
        $employee = Employee::find($request->input('employee'));
        $role = Role::find($request->input('role')); // Find the role with ID 4.

        if (!$role) {
            // The role does not exist. Handle this situation.
            return back()->with('error', 'The role does not exist.');
        }
        // $role = $request->input('role');

        if (!RoleController::assignRole($employee->id, $role->id)) {
            return back()->with('failure', 'employee already has role');
        } else {
            RoleController::assignRole($employee->id, $role->id);
        }



        return back()->with('success', 'Role assigned successfully.');
    }
    /**
     * Employee Login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): RedirectResponse
    {


        $attendance = new AttendanceController;

        $credentials = $request->validate([
            'employee_id' => 'required',
            'password' => 'required',
        ]);
        $employee = Employee::where('employee_id', $credentials['employee_id'])->first();
        if ($employee) {
            $last_name = explode(' ', $employee->name);

            $permissions = $employee->getAllPermissions()->pluck('name');

            if ($employee && $credentials['password'] === strtolower($last_name[0])) {

                $attendance->store($employee->employee_id);
                session(['user' => $employee, 'logged_in' => true, 'check_in_time' => Carbon::now()->format('H:i:sa'), 'roles' => $employee->roles, 'permissions' => $permissions->all()]);
                //   Auth::login($employee)
                ;


                return redirect(route('employee.dashboard', ['id' => $employee ? $employee->employee_id : '']));
            } else {
                return back()->withErrors([
                    'credentials' => 'Employee ID or Password Incoreect',
                ]);
            }

          
            // Change the redirect URL as per your requirement
        }
         return back()->withErrors([
                'credentials' => 'Invalid login credentials.',
            ]);
    }
    /**
     * Display Employee login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm(): ViewView
    {
        return view('employee.login');
    }

    /**
     * Logout employee.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse;
     */
    public function logout(Request $request)
    {
        $employee_id = $request->query('id');
        $attendance = new AttendanceController;

        $attendance->update($employee_id);
        Auth::logout();
        session([ 'logged_in' => false]);
        return redirect()->route('employee.loginForm');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Employee $employee, Request $request): ViewView
    {
        $employee_id = $request->query('id');
        $employee = Employee::where('employee_id', $employee_id)->first();

        $check_in_time = Carbon::createFromFormat('H:i:s', Attendance::where('employee_id', $employee->employee_id)->whereDate('date', date('Y-m-d'))->first()->check_in_time, );

        function getEmployeeEvents()
        {
            $events = [];

            $appointments = Appointment::with(['client', 'employee'])->get();
            foreach ($appointments as $appointment) {
                $events[] = [
                    'title' => $appointment->client->name . ' (' . $appointment->employee->name . ')',
                    'start' => $appointment->start_time,
                    'end' => $appointment->finish_time,
                ];
            }

            return $events;
        }
        ;
        //
        return view('employee.dashboard', ['employee' => $employee, 'events' => getEmployeeEvents(), 'check_in_time' => $check_in_time]);
    }

    public function calender()
    {
        $events = [];

        $appointments = Appointment::with(['client', 'employee'])->get();
        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->client->name . ' (' . $appointment->employee->name . ')',
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
                'allDay' => true,
                'description' => $appointment->comments
            ];
        }
        return view('employee.calender', ['events' => $events]);
    }

    public function exportEmployeesToExcel()
    {
        return FacadesExcel::download(new EmployeesExport, 'employees.xlsx');
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