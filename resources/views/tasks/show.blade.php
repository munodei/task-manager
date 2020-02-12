@extends('layouts.app')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left ">
      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <!-- Jumbotron -->
      <div class="well well-lg" >
        <h1>{{ $task->name }}</h1>
        <p class="lead">{{ $task->description }}</p>
       <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> -->
      </div>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px; ">
     <!-- <a href="/projects/create" class="pull-right btn btn-default btn-sm" >Add Project</a> -->
<br/>
<span id="message"></span>
<div id="showComments"></div>


<div class="row container-fluid">

<form method="post" id="commentForm">
                            {{ csrf_field() }}


                            <input type="hidden" name="commentable_type" value="App\Task">
                            <input type="hidden" name="commentable_id" value="{{$task->id}}">
                            <input type="hidden" name="parent_id" id="commentId" value="-1" />
                            <input type="hidden" name="task_id" id="task_id" value="{{$task->id}}" />
                            <div class="form-group">
                                <label for="comment-content">Comment</label>
                                <textarea placeholder="Enter comment"
                                          style="resize: vertical"
                                          id="comment-content"
                                          name="body"
                                          rows="3" spellcheck="false"
                                          class="form-control autosize-target text-left">


                                          </textarea>
                            </div>


                            <div class="form-group">
                                <label for="comment-content">Proof of work done (Url/Photos)</label>
                                <textarea placeholder="Enter url or screenshots"
                                          style="resize: vertical"
                                          id="comment-content"
                                          name="url"
                                          rows="2" spellcheck="false"
                                          class="form-control autosize-target text-left">


                                          </textarea>
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>



                        </div>



      </div>
</div>


<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="{{ route('tasks.edit',['task'=>$task]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Task</a></li>
              <li><a href="{{ route('add-task-to-group',['project_id'=>$task->project_id,'group_id'=>$task->group_task]) }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Task To Group</a></li>
              @if($task->user_id == Auth::user()->id)

                <li>
                <i class="fa fa-power-off" aria-hidden="true"></i>
                <a  href="#"
                    onclick="
                    var result = confirm('Are you sure you wish to delete this task?');
                        if( result ){
                                event.preventDefault();
                                document.getElementById('delete-form').submit();
                        }
                            "
                            >
                    Delete
                </a>

                <form id="delete-form" action="{{ route('tasks.destroy',[$task->id]) }}"
                  method="POST" style="display: none;">
                          <input type="hidden" name="_method" value="delete">
                          {{ csrf_field() }}
                </form>

                </li>
                @endif
              <li><a href="{{ route('projects.index') }}"><i class="fa fa-user-o" aria-hidden="true"></i> My projects</a></li>

            <br/>

            <h4>Project Task Groups</h4>
            <ol class="list-unstyled">
              @foreach($task_groups as $task_group)

                <li><a href="{{ route('task-groups.show',['task_group'=>$task_group->id])}}"><i class="fa fa-play" aria-hidden="true"></i> View Tasks in '{{ $task_group->group_name }}'</a></li>

              @endforeach
            <br/>

            </ol>
<hr/>

            <h4>Add members</h4>
            <p><a href="" role="button" data-toggle="modal" data-target="#AddMembers" class="btn btn-primary"> Add Members »</a></p>

            <br/>
            <h4>Team Members</h4>
            <ol class="list-unstyled" id="member-list">
            @foreach($task->users as $user)
              <li><a href="#"> {{$user->email}} </a> {{$user->role}}</li>
            @endforeach
            </ol>

          </div>
        </div>


    @endsection

    @section('jqueryScript')
    <div class="modal fade" id="AddMembers" tabindex="-1" role="dialog" aria-labelledby="exampleAddMembers" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Member To Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="add-user" action="{{ route('projects.adduser') }}"  method="POST" >
          {{ csrf_field() }}

          <input class="form-control" name = "task_id" id="task_id" value="{{$task->id}}" type="hidden">

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

                      $(document).ready(function(){
	showComments();

	$('#commentForm').on('submit', function(event){
		event.preventDefault();

		// var sentimentAnalyzer = new SentimentAnalyzer($("#comment").val());
		// var sent= sentimentAnalyzer.computeSentiment();
		// sent=sent.charAt(0).toUpperCase() + sent.slice(1);
		var formData = $(this).serialize();
    alert(formData);

		$.ajax({
			url: "{{ route('add-task-comment') }}",
			method: "POST",
			data: formData,
			dataType: "JSON",
			success:function(response) {
				if(!response.error) {
					$('#commentForm')[0].reset();
					$('#commentId').val('-1');
					$('#message').html(response.message);
					showComments();
				} else if(response.error){
					$('#message').html(response.message);
				}
			}
		})
	});
	$(document).on('click', '.reply', function(){
		var commentId = $(this).attr("id");
		$('#commentId').val(commentId);
		$('#comment-content').focus();
	});
});
// function to show comments
function showComments()	{
	$.ajax({
		url:"{{ route('show_comments',['id'=>$task->id]) }}",
		method:"GET",
		success:function(response) {
			$('.showComments').html(response);
		}
	})
}


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
                              'task_id' : $('#task_id').val(),
                              'user_email' : $('#user_email').val(),
                              'role': role,
                              '_token': $('input[name=_token]').val(),
                            }

                            var url = 'tasks/adduser';

                            $.ajax({
                              type: 'post',
                              url: "{{ route('task.adduser') }}",
                              data : formData,
                              dataType : 'json',
                              success : function(user_email){

                                    var emailField = $('#user_email').val();

                                  $('#member-list').prepend('<li><a href="#">'+ emailField +'</a> ('+ role +') </li>');
                                  $('#user_email').val('');
                                 $('#AddMembers').modal('hide');
                              },
                              error: function(data){
                                $('#AddMembers').modal('hide');
                                $('#UserDoeNotExists').modal('show');
                                console.log("error sending ajax request" + JSON.stringify(data));
                              
                              }
                            });


                            });

                      </script>


@endsection
