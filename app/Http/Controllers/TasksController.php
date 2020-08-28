<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function __construct()
    {
        $this->middleware('auth');
    }
    
     
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->get();

        return view('tasks.index', [
            "tasks" => $tasks,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task=new Task;
        
        return view("tasks.create",[
            "task"=>$task,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "content"=>"required",
            "status"=>"required|max:10",]);
        
        //$task=new Task;
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => $request->user()->id,
            ]);
        
        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task=Task::findOrFail($id);
        
        return view("tasks.show",[
            "task"=>$task,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task=Task::findOrFail($id);
        
        return view("tasks.edit",[
            "task"=>$task,
            ]);
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
        $request->validate([
            "content"=>"required",
            "status"=>"required|max:10",]);
        
        $task=Task::findOrFail($id);
        
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => $request->user()->id,
        ]);    
        
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }   
        return redirect("/");
    }
    

}
