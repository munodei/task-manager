@if(count($errors) > 0)
  @foreach ($errors->all() as $messages)
    <div class="notification error closeable">
      {{$messages}}
      <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    </div>
  @endforeach
@endif

@if(session('success'))
  <div class="notification success closeable">
    {{session('success')}}
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
  </div>
@endif


@if(session('error'))
  <div class="notification error closeable">
    {{session('error')}}
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
  </div>
@endif
