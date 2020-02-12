<?php

namespace App\Http\Controllers;

use App\GroupTask;
use App\GroupTasksUser;
use App\TaskUser;
use App\Project;
use App\Task;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskGroupsController extends Controller
{

    public function index($project_id)
    {
        $project    = Project::find($project_id);
        $tasks      = GroupTask::where('project_id',$project_id)->get();
        
        return view('task-groups.project-task-groups',compact('tasks','project'));
    }

    public function create($project_id)
    {
        return view('task-groups.create',compact('project_id'));
    }


    public function store(Request $request)
    {
        $rules = ['name'=>'required','description'=>'required'];
        $msgs  = ['name.required'=>'The name of the Task Group is Required!','description.required'=>'The name of the Task Group is Required!'];

        $request->validate($rules,$msgs);

        extract($_POST);

        $task_group = GroupTask::create(['project_id'=>$project_id, 'group_name'=>$name, 'group_description'=>$description, 'created_at'=>date('Y-m-d h:i:s'), 'updated_at'=>date('Y-m-d h:i:s')]);

        $project = Project::find(intval($project_id));

        return redirect()->route('projects.show',['project'=>$project])->with('success','You have successfully added a Task Group in your Project');
    }

    public function show($id)
    {
        if(GroupTasksUser::where([['group_task_id',$id],['role','Owner'],['user_id',Auth::user()->id]])->where([['group_task_id',$id],['role','Contributer'],['user_id',Auth::user()->id]])->where([['group_task_id',$id],['role','Editor'],['user_id',Auth::user()->id]])->where([['group_task_id',$id],['role','Viewer'],['user_id',Auth::user()->id]])->exists() || GroupTask::where([['id',$id],['user_id',Auth::user()->id]])->exists() )  {

          $tasks      = Task::where('group_task',$id)->get();
          $task_group = GroupTask::find($id);
          $project    = Project::find($task_group->project_id);

          return view('task-groups.show',compact('tasks','task_group','project'));

      }

      return redirect()->route('projects.index')->with('error','Unfortunately you do not have access to this Task Group');

    }


    public function edit($id)
    {
    if(GroupTasksUser::where([['group_task_id',$id],['role','Owner'],['user_id',Auth::user()->id]])->orwhere([['group_task_id',$id],['role','Editor'],['user_id',Auth::user()->id]])->exists() || GroupTask::where([['id',$id],['user_id',Auth::user()->id]])->exists() )  {
        $task_group = GroupTask::find($id);
        return view('task-groups.edit',compact('task_group'));

      }
      return redirect()->back()->with('error','Task Group Access Denied!');
    }

    public function update(Request $request, $id)
    {
      $rules = ['name'=>'required','description'=>'required'];
      $msgs  = ['name.required'=>'The name of the Task Group is Required!','description.required'=>'The name of the Task Group is Required!'];

      $request->validate($rules,$msgs);

      extract($_POST);

       if(GroupTasksUser::where([['group_task_id',$id],['role','Owner'],['user_id',Auth::user()->id]])->orwhere([['group_task_id',$id],['role','Editor'],['user_id',Auth::user()->id]])->exists() || GroupTask::where([['id',$id],['user_id',Auth::user()->id]])->exists() )  {

          $task_group = GroupTask::find($id);

          $task_group->project_id        = $project_id;
          $task_group->group_name        = $name;
          $task_group->group_description = $description;
          $task_group->updated_at        = date('Y-m-d h:i:s');

          $task_group->save();

          return redirect()->back()->with('success','You have successfully updated your Task Group!');

       }

    }

    public function addUser(Request $request){


      $group_task = GroupTask::find(intval($request->input('task_group')));

      if(Auth::user()->id == $group_task->user_id){

      $user = User::where('email', $request->input('user_email'))->first(); //single records

      //check if user is already added to the project
      if($user){

        $taskGroupUser = GroupTasksUser::where([['group_task_id',$group_task->id],['role',$request->input('role')],['user_id',$user->id]])->first();

      }

      if(isset($taskGroupUser)){
             //if user already exists, exit
             return response()->json(['success' ,  $request->input('user_email').' is already a member of this group task']);

      }


      if($user && $group_task){

          $group_task->users()->attach($user->id,['role' => $request->input('role'),'created_at'=>date('Y-m-d h:i:s'),'updated_at'=>date('Y-m-d h:i:s')]);
          return response()->json(['success' ,  $request->input('user_email').' was added to the group task successfully']);

      }

      }

      //return redirect()->route('task-groups.show', [$group_task->id])->with('error' ,  'Error adding user to group task');
    }

    public function destroy($id)
    {

        if(GroupTasksUser::where([['group_task_id',$id],['role','Owner'],['user_id',Auth::user()->id]])->exists() || GroupTask::where([['id',$id],['user_id',Auth::user()->id]])->exists() )  {

          //Deleting Tasks and Task Members
          $tasks = Task::where('group_task',$id)->first();
          TaskUser::where('task_id',$tasks->id)->delete();
          Task::where('group_task',$id)->delete();

          //Deleting Tasks and Task Members
          GroupTasksUser::where('group_task_id',$id)->delete();
          GroupTask::where('id',$id)->delete();

          return redirect()->route('projects.index')->with('error','You have successfully deleted your Task Group!');
        }

        return redirect()->back()->with('error','Unfortunately you do not have the rights to do that!');

    }


}
