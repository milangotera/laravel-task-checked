<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Task;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validation->fails()){
            session()->flash("message","Fill in the form");
            return redirect('task/new');
        }else{
            $task = new Task;
            $task->name = $request->input('name');
            $task->description = $request->input('description');
            $task->status = $request->input('status') ? 1 : 0;
            $task->id_user = Auth::user()->id;
            $saved = $task->save();
            if($saved){
                session()->flash("message","new task created");
                return redirect('home');
            }else{
                session()->flash("message","could not create");
                return redirect('task/new');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasks = Task::where('id_user', '=', Auth::user()->id)->where('id', '=', $id)->first();
        if(!$tasks){
            session()->flash("message","the task does not exist");
            return redirect('home');
        }
        return view('task.show')->with('tasks', $tasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tasks = Task::where('id_user', '=', Auth::user()->id)->where('id', '=', $id)->first();
        
        if(!$tasks){
            session()->flash("message","the task does not exist");
            return redirect('home');
        }
        
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validation->fails()){
            session()->flash("message","Fill in the form");
            return redirect('task/'.$id.'/show');
        }else{
            $tasks->name = $request->input('name');
            $tasks->description = $request->input('description');
            $tasks->status = $request->input('status') ? 1 : 0;
            $saved = $tasks->save();
            if($saved){
                session()->flash("message","new task updated");
                return redirect('home');
            }else{
                session()->flash("message","could not updated");
                return redirect('task/'.$id.'/show');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $tasks = Task::where('id_user', '=', Auth::user()->id)->where('id', '=', $id)->first();
        if(!$tasks){
            session()->flash("message","the task does not exist");
            return redirect('home');
        }
        $tasks->delete();
        session()->flash("message","task removed");
        return redirect('home');
    }
}
