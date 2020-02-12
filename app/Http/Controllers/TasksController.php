<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskUser;
use App\GroupTask;
use App\GroupTasksUser;
use App\TaskNote;
use App\Project;
use App\User;
use App\ProjectUser;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TasksController extends Controller
{

    public function index(Request $request)
    {


        $id            = $request->user()->id;
        $task_groups   = array();
        $tasks         = array();
        $grouped_tasks = array();

        $projects = ProjectUser::join('projects','projects.id','project_user.project_id')->where('projects.user_id',$id)->orwhere('project_user.user_id',$id)->select('projects.id as projectID','projects.name as projectName')->distinct()->get();

        foreach ($projects as $project) {
          $task_groups[] = GroupTask::where('project_id',$project->projectID)->get();
          $tasks[] = Task::leftjoin('group_tasks','tasks.group_task','=','group_tasks.id')->select('tasks.id as taskID','tasks.*','group_tasks.id as groupTaskID','group_tasks.*')->where([['tasks.project_id',$project->projectID],['group_tasks.project_id',$project->projectID]])->distinct()->get();
        }

        if(isset($tasks[0][0]->group_name)){

        foreach($tasks[0] as $task){
          $grouped_tasks[$task->group_name][] = $task;
        }
      }

        return view('tasks.index',compact('projects','tasks','grouped_tasks','task_groups'));



  }

    public function addTaskToGroup($project_id,$group_id){

      return view('tasks.add-to-group',compact('project_id','group_id'));

    }
    public function create(Request $request)
    {
      $id            = $request->user()->id;
      $task_groups   = array();


      $projects = ProjectUser::join('projects','projects.id','project_user.project_id')->where('projects.user_id',$id)->orwhere('project_user.user_id',$id)->select('projects.id as projectID','projects.name as projectName')->get();

      if(!isset($projects[0]->projectID)){
        return redirect()->route('project.create')->with('error','Create Project First!');
      }

      foreach ($projects as $project) {
        $task_groups[] = GroupTask::where('project_id',$project->projectID)->get();
      }

      return view('tasks.create',compact('task_groups','projects'));
    }


    public function store(Request $request)
    {

      $rules = [
                  'name'=>'required',
                  'description'=>'required',

                ];
      $msgs = [
        'name.required'=>'The Task name is Required!',
        'description'=>'The Task Description is Required!'
       ];

      $request->validate($rules,$msgs);

      extract($_POST);

      if(GroupTasksUser::where([['role','Owner'],['user_id',Auth::user()->id]])->orwhere([['role','Editor'],['user_id',Auth::user()->id]])->exists() || GroupTask::where([['id',$id],['user_id',Auth::user()->id]])->exists() )  {

      if(!isset($group_id)){

        $group_task  =  GroupTask::create(['project_id',$project_id,'group_name',$group_task_name,'created_at',date('Y-m-d h:i:s'),'updated_at',date('Y-m-d h:i:s')]);

      }

      $task = new Task;
      $task->name = $name;
      $task->status = 'Task Created';
      $task->group_task = $group_id ?? $group_task->id;
      $task->project_id = $project_id;
      $task->user_id  = $request->user()->id;
      $task->task_description = $description;

      $task->save();

      return redirect()->route('tasks.index')->with('success','You have created a Task!');

    }

     return redirect()->route('tasks.index')->with('error','Unfortunately you do not have rights to Add Tasks To this Group!');

    }


    public function show(Task $task)
    {
        if(Task::where([['id',$task->id],['user_id',$task->user_id]])->exists() || TaskUser::where([['id',$task->id],['user_id',$task->user_id]])->exists()){

          $comments = Comment::where('task_id',$task->id)->get();
          $task_groups = GroupTask::where('project_id',$task->project_id)->get();
          return view('tasks.show',compact('task','comments','task_groups'));

        }

        return redirect()->back()->with('error','Error Occured!');

    }

    public function edit(Request $request,Task $task)
    {

      if(Task::where([['id',$task->id],['user_id',$task->user_id]])->exists() || TaskUser::where([['id',$task->id],['user_id',$task->user_id]])->exists()){

      $id            = $request->user()->id;
      $task_groups   = array();
      $projects      = ProjectUser::join('projects','projects.id','project_user.project_id')->where('projects.user_id',$id)->orwhere('project_user.user_id',$id)->select('projects.id as projectID','projects.name as projectName')->get();

      if(!isset($projects[0]->projectID)){
        return redirect()->route('project.create')->with('error','Create Project First!');
      }

      foreach ($projects as $project) {
        $task_groups[] = GroupTask::where('project_id',$project->projectID)->get();
      }
      return view('tasks.edit',compact('task','task_groups','projects'));

    }
      return redirect()->back()->with('error','Error Occured!');

    }

    public function update(Request $request, Task $task)
    {
      $rules = [
                  'name'=>'required',
                  'description'=>'required',
                ];
      $msgs = [
        'name.required'=>'The Task name is Required!',
        'description'=>'The Task Description is Required!'
       ];

      $request->validate($rules,$msgs);

      extract($_POST);

      if(Task::where([['id',$task->id],['user_id',$task->user_id]])->exists() || TaskUser::where([['id',$task->id],['user_id',$task->user_id],['role','Owner']])->orwhere([['id',$task->id],['user_id',$task->user_id],['role','Editor']])->exists() ){

          $task->name = $name;
          $task->status = 'Task Created';
          $task->group_task = $group_id;
          $task->project_id = $project_id;
          $task->user_id  = $request->user()->id;
          $task->task_description = $description;

          $task->save();

      return redirect()->back()->with('success','You have updated a Task!');
    }

    return redirect()->back()->with('error','Unfortunately you cannot update this Task!');

    }


    public function destroy(Task $task)
    {
      if(Task::where([['id',$task->id],['user_id',$task->user_id]])->exists() || TaskUser::where([['id',$task->id],['user_id',$task->user_id],['role','Owner']])->exists()){

        TaskUser::where('task_id',$task->id)->delete();
        Comment::where('task_id',$task->id)->delete();
        Task::where('id',$task->id)->delete();
        return redirect()->route('tasks.index')->with('success','You have deleted a Task!');

      }

      return redirect()->route('tasks.index')->with('error','Unfortunately you cannot delete this Task!');
    }

    public function addUser(Request $request){


      $task = Task::find(intval($request->input('task_id')));

      if(Auth::user()->id == $task->user_id){

      $user = User::where('email', $request->input('user_email'))->first(); //single records

      //check if user is already added to the project
      if($user){
      $tasktUser = TaskUser::where([['task_id',$task->id],['role',$request->input('role')],['user_id',$user->id]])
                                ->first();
      }
         if(isset($tasktUser)){
             //if user already exists, exit
             return response()->json(['error' ,  $request->input('user_email').' is already a member of this project']);
         }

      if($user && $task){
             $task->users()->attach($user->id,['role' => $request->input('role'),'created_at'=>date('Y-m-d h:i:s'),'updated_at'=>date('Y-m-d h:i:s')]);
                  return response()->json(['success' ,  $request->input('user_email').' was added to the project successfully']);

                 }

      }

      return redirect()->route('tasks.show', ['task'=> $task->id])
      ->with('errors' ,  'Error adding user to task');

    }
}
