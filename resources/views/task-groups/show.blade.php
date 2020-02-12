@extends('layouts.app')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left ">
      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <!-- Jumbotron -->
      <div class="well well-lg" >
        <h1>{{ $task_group->group_name }}</h1>
        <p class="lead">{{ $task_group->group_description }}</p>
       <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> -->
      </div>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px; ">
     <!-- <a href="/projects/create" class="pull-right btn btn-default btn-sm" >Add Project</a> -->
<br/>

@include('partials.tasks')
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
              <li><a href="{{ route('task-groups.edit',[$task_group->id ]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Task Group</a></li>
              @if($task_group->user_id == Auth::user()->id)

                <li>
                <i class="fa fa-power-off" aria-hidden="true"></i>
                <a  href="#"
                    onclick="
                    var result = confirm('Are you sure you wish to delete this Task Group?');
                        if( result ){
                                event.preventDefault();
                                document.getElementById('delete-form').submit();
                        }
                            "
                            >
                    Delete
                </a>

                <form id="delete-form" action="{{ route('task-groups.destroy',[$task_group->id]) }}"
                  method="POST" style="display: none;">
                          <input type="hidden" name="_method" value="delete">
                          {{ csrf_field() }}
                </form>

                </li>
                @endif
              <li><a href="{{ route('add-task-to-group',['project_id'=>$task_group->project_id,'group_id'=>$task_group->id]) }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Task To Group</a></li>

              <li><a href="{{ route('create-task-group',[$task_group->project_id]) }}"><i class="fa fa-folder" aria-hidden="true"></i> Add Task Group</a></li>
              <li><a href="{{ route('project-task-groups',['project_id'=>$project->id]) }}"><i class="fa fa-list" aria-hidden="true"></i> Tasks in '{{ $project->name }}' Project</a></li>
              <li><a href="{{ route('projects.index') }}"><i class="fa fa-user-o" aria-hidden="true"></i> My Projects</a></li>


            </ol>
<hr/>
            <h4>Add Members To Task Group</h4>
              <p><a href="" role="button" data-toggle="modal" data-target="#AddMembers" class="btn btn-primary"> Add Members »</a></p>

            <br/>
                        <h4>Group Members</h4>
                        <ol class="list-unstyled" id="member-list">
                        @foreach($task_group->users as $user)
                          <li><a href="#"> {{$user->email}} </a> {{$user->role}}</li>
                        @endforeach
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

    @section('jqueryScript')
    <div class="modal fade" id="AddMembers" tabindex="-1" role="dialog" aria-labelledby="exampleAddMembers" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Member To Task Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="add-user" action=""  method="POST" >
          {{ csrf_field() }}

          <input class="form-control" name = "task_group" id="task_group" value="{{$task_group->id}}" type="hidden">

              <div class="form-group row">
                <label for="inputPassword" class="col-md-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="user_email" id="user_email" class="form-control" id="inputPassword">
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword" class="col-md-2 col-form-label">Role</label>
                <div class="col-sm-10">

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="role1" value="Owner">
                    <label class="form-check-label" for="role1">Owner</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="role2" value="Editor">
                    <label class="form-check-label" for="role2">Editor</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="role3" value="Contributor">
                    <label class="form-check-label" for="role3">Contributor</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="role4" value="Viewer">
                    <label class="form-check-label" for="role4">Viewer</label>
                  </div>

                </div>

              </div>

          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addMemberButton">Add Member</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="UserDoeNotExists" tabindex="-1" role="dialog" aria-labelledby="UserDoeNotExistsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UserDoeNotExistsLabel">User Doesn't Exists!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          User with this Email Doesn't exist on our System. Click the Link Below or Try Retyping Email Address.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

                      <script type="text/javascript">

                      $('#addMemberButton').on('click',function(e){
                        e.preventDefault();

                      var roles = document.getElementsByName('role');

                      for (var i = 0, length = roles.length; i < length; i++) {
                        if (roles[i].checked) {
                          // do whatever you want with the checked radio
                          var role = roles[i].value;

                          // only one radio can be logically checked, don't check the rest
                          break;
                        }
                      }

                      var formData = {
                        'task_group' : $('#task_group').val(),
                        'user_email' : $('#user_email').val(),
                        'role': role,
                        '_token': $('input[name=_token]').val(),
                      }

                      var url = 'tasks/adduser';

                      $.ajax({
                        type: 'post',
                        url: "{{ route('task-group.adduser') }}",
                        data : formData,
                        dataType : 'JSON',
                        success : function(user_email){

                              var emailField = $('#user_email').val();

                            $('#member-list').prepend('<li><a href="#">'+ emailField +'</a> ('+ role +') </li>');
                            $('#user_email').val('');
                           $('#AddMembers').modal('hide');
                        },
                        error: function(data){
                        //  $('#ErrorAddMembers').toast('show');
                        $('#AddMembers').modal('hide');
                        $('#UserDoeNotExists').modal('show');
                          console.log("error sending ajax request" + JSON.stringify(data));

                        }
                      });


                      });

                            $('#addMember').on('click',function(e){
                              e.preventDefault(); //prevent the form from auto submit


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
                              dataType : 'JSON',
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
