@extends('layouts.app')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white; ">
    <h1>Edit Task </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="POST" action="{{ route('task-update',['task'=>$task]) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="company-content">Select Project</label>

                                  <select name="project_id" class="form-control" readonly >
                                  @foreach($projects as $project)
                                    <option @if($task->project_id == $project->projectID) selected @endif value="{{$project->projectID}}"> {{$project->projectName}} </option>
                                  @endforeach
                                  </select>

                            </div>


                            <div class="form-group">
                                <label for="company-content">Select Task Groups</label>

                                <select name="group_id" class="form-control" readonly>
                                @foreach($task_groups[0] as $group)
                                        <option @if($task->group_task == $group->id) selected @endif  value="{{$group->id}}"> {{$group->group_name}} </option>
                                      @endforeach
                                </select>

                            </div>



                            <div class="form-group">
                                <label for="project-name">Task Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"
                                          id="project-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $task->name }}"
                                           />
                            </div>



                            <div class="form-group">
                                <label for="project-content">Description</label>

                                <textarea placeholder="Enter description"
                                          style="resize: vertical"
                                          id="project-content"
                                          name="description"
                                          rows="5" spellcheck="false"
                                          class="form-control autosize-target text-left">{{ $task->task_description }}</textarea>

                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>


      </div>
</div>


<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
          <!--<div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div> -->
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="{{ url('/') }}/projects"><i class="fa fa-user-o" aria-hidden="true"></i> My projects</a></li>
              <li><a href="{{ url('/') }}/projects"><i class="fa fa-folder" aria-hidden="true"></i> Add Project Task Group</a></li>
            </ol>
          </div>

          <!--<div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
            </ol>
          </div> -->
        </div>


    @endsection
