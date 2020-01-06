@extends('layouts.theme')

@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Log In</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="{{url('/')}}">Home</a></li>
            	<li><a href="{{route('home')}}">Account</a></li>
						<li>{{ __('Login') }}</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
		@include('includes.messages')
	<div class="row">
		<div class="col-xl-5 offset-xl-3">


			<div class="login-register-page">
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>We're glad to see you again!</h3>
					<span>Don't have an account? <a href="{{url('/')}}/register">Sign Up!</a></span>
				</div>

				<!-- Form -->
				<form method="post" id="login-form" name="login-form" action="{{ route('login') }}" >
					{!! csrf_field() !!}
					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="email" id="email" value="{{ old('email') }}" placeholder="Email Address" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="password" id="password" placeholder="Password" required/>
					</div>
          @if (Route::has('password.request'))
					<a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
          @endif
          &nbsp;  &nbsp;
      <div class="checkbox">
				<input type="checkbox" name="remember"  id="chekcbox2" {{ old('remember') ? 'checked' : '' }}>
				<label for="chekcbox2"><span class="checkbox-icon"></span> {{ __('Remember Me') }}</label>
			</div>



				</form>

				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">Log In <i class="icon-material-outline-arrow-right-alt"></i></button>

				@if(get_option('enable_social_login') == 1)	
				<!-- Social Login -->
				<div class="social-login-separator"><span>or</span></div>
				<div class="social-login-buttons">
					@if(get_option('enable_facebook_login') == 1)
					<button class="facebook-login ripple-effect" onclick="event.preventDefault();window.location.href ='{{ route('facebook_redirect') }}';">
						<i class="icon-brand-facebook-f"></i> Log In via Facebook</button>
					@endif
					@if(get_option('enable_twitter_login') == 1)
					<button class="google-login ripple-effect" onclick="event.preventDefault();window.location.href ='{{ route('twitter_redirect') }}';"><i class="icon-brand-google-plus-g"></i> Log In via Google+</button>
					@endif
				</div>
				@endif
			</div>

		</div>
	</div>
</div>


<!-- Spacer -->
<div class="margin-top-70"></div>
<!-- Spacer / End-->
@endsection
