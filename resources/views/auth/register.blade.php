@extends('layouts.theme')

@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Register</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="{{url('/')}}">Home</a></li>
            <li><a href="{{route('home')}}">Account</a></li>
						<li>Register</li>
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
					<h3 style="font-size: 26px;">Let's create your account!</h3>
					<span>Already have an account? <a href="{{url('/')}}/login">Log In!</a></span>
				</div>
				<!-- Form -->
				<form method="POST" name="login-form" id="login-form" action="{{ route('register') }}">
				<!-- Account Type -->
				<div class="account-type">
					<div>
						<input type="radio" name="user_type" id="freelancer-radio" class="account-type-radio" value="individual" checked/>
						<label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Individual</label>
					</div>

					<div>
						<input type="radio" name="user_type" id="employer-radio" class="account-type-radio" value="company"/>
						<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Company</label>
					</div>
				</div>


					{!! csrf_field() !!}
        <div class="input-with-icon-left">
          <i class="icon-feather-user"></i>
          <input type="text" class="input-text with-border"  id="emailaddress-register" placeholder="Username" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
        </div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" id="emailaddress-register" placeholder="Email Address" name="email" value="{{ old('email') }}" autocomplete="email" required/>
					</div>

					<div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="password" autocomplete="new-password" id="password-register" placeholder="Password" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="password_confirmation" autocomplete="new-password" id="password-repeat-register" placeholder="Repeat Password" required/>
					</div>


				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">{{ __('Register') }} <i class="icon-material-outline-arrow-right-alt"></i></button>
</form>
				@if(get_option('enable_social_login') == 1)	
				<!-- Social Login -->
				<div class="social-login-separator"><span>or</span></div>
				<div class="social-login-buttons">
					@if(get_option('enable_facebook_login') == 1)
					<button class="facebook-login ripple-effect" onclick="event.preventDefault();window.location.href ='{{ route('facebook_redirect') }}';">
						<i class="icon-brand-facebook-f"></i> Register In via Facebook</button>
					@endif
					@if(get_option('enable_twitter_login') == 1)
					<button class="google-login ripple-effect" onclick="event.preventDefault();window.location.href ='{{ route('twitter_redirect') }}';"><i class="icon-brand-google-plus-g"></i> Register In via Google+</button>
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
