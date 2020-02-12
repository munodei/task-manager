@extends('layouts.app')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left ">
      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <!-- Jumbotron -->
      <div class="well well-lg" >
        <h1>{{ $project->name }}</h1>
        <p class="lead">{{ $project->description }}</p>
       <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> -->
      </div>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px; ">
     <!-- <a href="/projects/create" class="pull-right btn btn-default btn-sm" >Add Project</a> -->
<br/>


 <div class="row">
		<div class="col-md-12 col-sm-12  col-xs-12 col-lg-12">

            <!-- Fluid width widget -->
    	    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa fa-tasks"></span> 
                        Task Groups in Project
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="media-list">

                    @foreach($tasks as $task)
                    <a href="{{ route('task-groups.show',['task_group'=>$task->id])}}">
                        <li class="media jumbotron">
                            <div class="media-left">
                                <span class="fa fa-play"></span> 
                            </div>
                            <div class="media-body">

                                <p>
                                <b> Group: </b>{{ $task->group_name }}
                                </p>
                               <b> Group Description: </b>
                                <p>
                                {{ $task->group_description }}
                                </p>
                            </div>
                        </li>
                      </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- End fluid width widget -->

		</div>
	</div>

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
              <li><a href="{{ url('/') }}/projects/{{ $project->id }}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Project</a></li>
              <li><a href="{{ route('task-groups.create') }}"><i class="fa fa-folder" aria-hidden="true"></i> Add Task Group</a></li>
              <li><a href="{{ route('projects.index') }}"><i class="fa fa-user-o" aria-hidden="true"></i> My Projects</a></li>

            <br/>

            @if($project->user_id == Auth::user()->id)

              <li>
              <i class="fa fa-power-off" aria-hidden="true"></i>
              <a
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this project?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                          "
                          >
                  Delete
              </a>

              <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}"
                method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
              </form>

              </li>
 @endif
              <!-- <li><a href="#">Add new member</a></li> -->
            </ol>
<hr/>

            <h4>Add Members To Task Group</h4>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12  col-sm-12 ">
              <form id="add-user" action="{{ route('projects.adduser') }}"  method="POST" >
                {{ csrf_field() }}
                <div class="input-group">
                  <input class="form-control" name = "project_id" id="project_id" value="{{ $project->id }}" type="hidden">
                  <input type="text" required class="form-control" id="email"  name = "email" placeholder="Email">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="addMember" >Add!</button>
                  </span>
                </div><!-- /input-group -->
                </form>
              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
<br/>


          </div>

          <!--<div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
            </ol>
          </div> -->
        </div>


    @endsection

    @section('jqueryScript')
                      <script type="text/javascript">

                            $('#addMember').on('click',function(e){
                              e.preventDefault(); //prevent the form from auto submit

                            //   $.ajaxSetup({
                            //     headers: {
                            //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            //     }
                            // });


                            var formData = {
                              'project_id' : $('#project_id').val(),
                              'email' : $('#email').val(),
                              '_token': $('input[name=_token]').val(),
                            }

                            var url = 'projects/adduser';

                            $.ajax({
                              type: 'post',
                              url: "{{ URL::route('projects.adduser') }}",
                              data : formData,
                              dataType : 'json',
                              success : function(data){

                                    var emailField = $('#email').val();

                                  $('#member-list').prepend('<li><a href="#">'+ emailField +'</a> </li>');
                                  $('#email').val('');
                              },
                              error: function(data){
                                //do something with data
                                console.log("error sending ajax request" + data);
                              }
                            });


                            });

                      </script>


@endsection
