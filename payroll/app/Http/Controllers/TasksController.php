<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TasksController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {

        $employee = Employee::where('employee_id', $request->query('id'))->first();




        $tasks = Task::where('assignee_id', $employee->id)->with(['assigner'])->get();
        $assigned_tasks = Task::where('assigner_id', $employee->id)->with(['assignee'])->get();

        return view('employee.tasks.index', ['tasks' => $tasks, 'given_tasks' => $assigned_tasks, 'employee' => $employee]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $employees = Employee::get();
        return view('employee.tasks.create', ['employees' => $employees]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //


        $task = Task::create([
            'title' => $request->input('title'),
            'due_date' => $request->input('due_date'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'assignee_id' => $request->input('assignee_id'),
            'assigner_id' => $request->input('assigner_id')

        ]);

        if ($request->hasFile('attachment')) {
            $files = $request->file('attachments');

            foreach ($files as $file) {
                $path = $file->store('task_attachments', 'public');

            }
            TaskAttachment::create([
                'task_id' => $task->id,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
            ]);




        }


        return redirect()->route('employee.tasks', ['id' => session('user')->employee_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        //

        $task = Task::where('id', $id)->with('files')->first();
      
        if (session('user')->id !== $task->assignee->id and session('user')->id !== $task->assigner->id) {
            abort(403, 'Unauthorized action.');
        }
        return view('employee.tasks.view', ['task' => $task]);
    }
}