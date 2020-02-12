@extends('layouts.app')

@section('content')

<div class="col-md-10 col-lg-10 col-md-offset-1  col-lg-offset-1">
    <div class="panel panel-primary ">
    <div class="panel-heading">Tasks <a  class="pull-right btn btn-primary btn-sm" href="{{ url('/') }}/tasks/create">
    <i class="fa fa-plus-square" aria-hidden="true"></i>  Create new</a> </div>
    <div class="panel-body">


    <ul class="list-group">
    @foreach($grouped_tasks as $key=>$tasks)
        <li class="list-group-item">
         <h1>{{ $key }}</h1>
         @foreach($tasks as $task)
          <a href="{{ route('tasks.show',[$task->taskID])}}" > <i class="fa fa-play" aria-hidden="true"></i>  {{ $task->name }}</a><span class="badge badge-primary">{{ $task->status }}</span><br>
        @endforeach
        </li>
    @endforeach
    </ul>


    </div>
    </div>
</div>

@endsection
