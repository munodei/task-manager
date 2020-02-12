
 <div class="row">
		<div class="col-md-12 col-sm-12  col-xs-12 col-lg-12">

            <!-- Fluid width widget -->
    	    <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa fa-tasks"></span> 
                        Tasks in Group
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="media-list">

                    @foreach($tasks as $task)
                      <a href="{{ route('tasks.show',['task'=>$task])}}">
                        <li class="media">
                            <div class="media-left">
                                <span class="fa fa-play"></span> 
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <small>


                               <br>
                                        Task Status <span class="badge badge-secondary">{{ $task->status }}</span>
                                    </small>
                                </h4>
                                <p>
                                {{ $task->name }}
                                </p>
                               <b> Task Description: </b>
                                <p>
                                {{ $task->task_description }}
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
