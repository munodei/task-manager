<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>{{get_option('site_name')}} | General Settings</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{url('/')}}/css/style.css">
<link rel="stylesheet" href="{{url('/')}}/css/colors/blue.css">

</head>
<body class="gray" style="zoom:90%;">

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
@include('includes.header')
<div class="clearfix"></div>
<!-- Header Container / End -->


<!-- Dashboard Container -->
<div class="dashboard-container">

	<!-- Dashboard Sidebar
	================================================== -->
	<div class="dashboard-sidebar">
		<div class="dashboard-sidebar-inner" data-simplebar>
			<div class="dashboard-nav-container">

				<!-- Responsive Navigation Trigger -->
				<a href="#" class="dashboard-responsive-nav-trigger">
					<span class="hamburger hamburger--collapse" >
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title">Dashboard Navigation</span>
				</a>

				<!-- Navigation -->
				<div class="dashboard-nav">
					<div class="dashboard-nav-inner">

						<ul data-submenu-title="Start">
							<li><a href="{{ route('home') }}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="dashboard-messages.html"><i class="icon-material-outline-question-answer"></i> Messages <span class="nav-tag">2</span></a></li>
							<li><a href="dashboard-bookmarks.html"><i class="icon-material-outline-star-border"></i> Bookmarks</a></li>
							<li><a href="dashboard-reviews.html"><i class="icon-material-outline-rate-review"></i> Reviews</a></li>
						</ul>

						<ul data-submenu-title="Organize and Manage">
							<li><a href="#"><i class="icon-material-outline-business-center"></i> Jobs</a>
								<ul>
									<li><a href="dashboard-manage-jobs.html">Manage Jobs <span class="nav-tag">3</span></a></li>
									<li><a href="dashboard-manage-candidates.html">Manage Candidates</a></li>
									<li><a href="dashboard-post-a-job.html">Post a Job</a></li>
								</ul>
							</li>
							<li><a href="#"><i class="icon-material-outline-assignment"></i> Tasks</a>
								<ul>
									<li><a href="dashboard-manage-tasks.html">Manage Tasks <span class="nav-tag">2</span></a></li>
									<li><a href="dashboard-manage-bidders.html">Manage Bidders</a></li>
									<li><a href="dashboard-my-active-bids.html">My Active Bids <span class="nav-tag">4</span></a></li>
									<li><a href="dashboard-post-a-task.html">Post a Task</a></li>
								</ul>
							</li>
						</ul>

						<ul data-submenu-title="Account">
						<li><a href="{{ route('pages') }}"><i class="icon-material-outline-description"></i> Pages</a></li>	
						<li><a href="{{ route('parent_categories') }}"><i class="icon-line-awesome-folder-open-o"></i> Categories</a></li>	
							<li class="active"><a href="#"><i class="icon-material-outline-settings"></i> Settings</a>
								<ul>
									<li><a href="{{ route('settings') }}">Account Settings</a></li>
									<li><a href="{{ route('general-settings') }}">General Settings</a></li>
									<li><a href="{{ route('payment-settings') }}">Payment Settings</a></li>
									<li><a href="{{ route('theme-settings') }}">Theme Settings</a></li>
									<li><a href="{{ route('social-url-settings') }}">Social Settings</a></li>
								</ul>
							</li>
							
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
													 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {!! csrf_field() !!}
                                    </form>
							</li>

						</ul>

					</div>
				</div>
				<!-- Navigation / End -->

			</div>
		</div>
	</div>
	<!-- Dashboard Sidebar / End -->


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >

			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Settings</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="{{url('/')}}">Home</a></li>
						<li><a href="{{route('home')}}">Dashboard</a></li>
						<li><a href="{{route('general-settings')}}">General Settings</a></li>
					</ul>
				</nav>
			</div>

@include('includes.messages')
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-settings"></i> My General Settings</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">
                            <form action="{{route('save_settings')}}" class="form-horizontal" method="post" enctype="multipart/form-data" id="login-general-settings" name="login-general-settings">
                             {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-xl-6 {{ $errors->has('site_name')? 'has-error':'' }}">
                                    <h5>@lang('app.site_name')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" id="site_name" value="{{ old('site_name')? old('site_name') : get_option('site_name') }}" name="site_name" placeholder="@lang('app.site_name')">
                                        {!! $errors->has('site_name')? '<p class="help-block">'.$errors->first('site_name').'</p>':'' !!}
                                    </div>
                                </div>

                                <div class="col-xl-6 {{ $errors->has('site_title')? 'has-error':'' }}">
                                    <h5>@lang('app.site_title')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" id="site_title" value="{{ old('site_title')? old('site_title') : get_option('site_title') }}" name="site_title" placeholder="@lang('app.site_title')">
                                        {!! $errors->has('site_title')? '<p class="help-block">'.$errors->first('site_title').'</p>':'' !!}
                                    </div>
                                </div>

                                <div class="col-xl-6 {{ $errors->has('email_address')? 'has-error':'' }}">
                                    <h5>@lang('app.email_address')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" id="email_address" value="{{ old('email_address')? old('email_address') : get_option('email_address') }}" name="email_address" placeholder="@lang('app.email_address')">
                                        {!! $errors->has('email_address')? '<p class="help-block">'.$errors->first('email_address').'</p>':'' !!}
                                        <p class="text-info"> @lang('app.email_address_help_text')</p>
                                    </div>
                                </div>

								<div class="col-xl-6 {{ $errors->has('contact_number')? 'has-error':'' }}">
                                    <h5>@lang('app.contact_number')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" id="contact_number" value="{{ old('contact_number')? old('contact_number') : get_option('contact_number') }}" name="contact_number" placeholder="@lang('app.contact_number')">
                                        {!! $errors->has('contact_number')? '<p class="help-block">'.$errors->first('contact_number').'</p>':'' !!}
                                        <p class="text-info"> @lang('app.contact_number_text')</p>
                                    </div>
                                </div>

								<div class="col-xl-6 {{ $errors->has('address')? 'has-error':'' }}">
                                    <h5>@lang('app.address')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" id="address" value="{{ old('address')? old('address') : get_option('address') }}" name="address" placeholder="@lang('app.address')">
                                        {!! $errors->has('address')? '<p class="help-block">'.$errors->first('address').'</p>':'' !!}
                                        <p class="text-info"> @lang('app.address_text')</p>
                                    </div>
                                </div>

								<div class="col-xl-6 {{ $errors->has('facebook_page')? 'has-error':'' }}">
                                    <h5>@lang('app.facebook_page')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" id="facebook" value="{{ old('facebook_page')? old('facebook_page') : get_option('facebook') }}" name="facebook" placeholder="">
                                        {!! $errors->has('facebook_page')? '<p class="help-block">'.$errors->first('facebook_page').'</p>':'' !!}
                                       
                                    </div>
                                </div>

								<div class="col-xl-6 {{ $errors->has('instagram_page')? 'has-error':'' }}">
                                    <h5>@lang('app.instagram_page')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" id="instagram" value="{{ old('instagram_page')? old('instagram_page') : get_option('instagram') }}" name="instagram" placeholder="">
                                        {!! $errors->has('instagram_page')? '<p class="help-block">'.$errors->first('instagram_page').'</p>':'' !!}
                                    </div>
                                </div>

								<div class="col-xl-6 {{ $errors->has('twitter_page')? 'has-error':'' }}">
                                    <h5>@lang('app.twitter_page')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" id="twitter" value="{{ old('twitter_page')? old('twitter_page') : get_option('twitter') }}" name="twitter" placeholder="">
                                        {!! $errors->has('twitter_page')? '<p class="help-block">'.$errors->first('twitter_page').'</p>':'' !!}
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <h5>
                                        @lang('app.default_timezone')
                                    </h5>
                                    <div class="submit-field {{ $errors->has('default_timezone')? 'has-error':'' }}">
                                        <select class="selectpicker form-control with-border" name="default_timezone" id="default_timezone">
                                            @php $saved_timezone = get_option('default_timezone'); @endphp
                                            @foreach(timezone_identifiers_list() as $key=>$value)
                                                <option value="{{ $value }}" {{ $saved_timezone == $value? 'selected':'' }}>{{ $value }}</option>
                                            @endforeach

                                        </select>


                                        {!! $errors->has('default_timezone')? '<p class="help-block">'.$errors->first('default_timezone').'</p>':'' !!}
                                        <p class="text-info">@lang('app.default_timezone_help_text')</p>
                                    </div>
                                </div>



<div class="col-xl-6 {{ $errors->has('date_format')? 'has-error':'' }}">
    <h5>@lang('app.date_format')</h5>
    <div class="submit-field">
    @php $saved_date_format = get_option('date_format'); @endphp
    <div class="radio">
			<input id="radio-1" value="F j, Y" name="date_format" type="radio" {{ $saved_date_format == 'F j, Y'? 'checked':'' }}>
			<label for="radio-1"><span class="radio-label"></span> {{ date('F j, Y') }}&nbsp;(F j, Y)</label>
	</div>
    <div class="radio">
			<input id="radio-2" value="Y-m-d" name="date_format" type="radio" {{ $saved_date_format == 'Y-m-d'? 'checked':'' }}>
			<label for="radio-2"><span class="radio-label"></span> {{ date('Y-m-d') }}&nbsp;(Y-m-d)</label>
	</div>
    <div class="radio">
			<input id="radio-3" value="m/d/Y" name="date_format" type="radio" {{ $saved_date_format == 'm/d/Y'? 'checked':'' }}>
			<label for="radio-3"><span class="radio-label"></span> {{ date('m/d/Y') }}&nbsp;(m/d/Y)</label>
	</div>
    <div class="radio">
			<input id="radio-4" value="d/m/Y" name="date_format" type="radio" {{ $saved_date_format == 'd/m/Y'? 'checked':'' }}>
			<label for="radio-4"><span class="radio-label"></span> {{ date('d/m/Y') }}&nbsp;(d/m/Y)</label>
	</div>
    <div class="radio">
			<input id="radio-5" value="custom" name="date_format" type="radio" {{ $saved_date_format == 'd/m/Y'? 'checked':'' }}>
			<label for="radio-5"><span class="radio-label"></span> Custom</label>
	</div>

    <fieldset>

        <input type="text" value="{{ get_option('date_format_custom') }}" id="date_format_custom" name="date_format_custom" />
        <span>example: {{ date(get_option('date_format_custom')) }}</span>
    </fieldset>

        <p class="text-info"> @lang('app.date_format_help_text')</p>
    </div>
</div>



<div class="col-xl-6 {{ $errors->has('time_format')? 'has-error':'' }}">
    <h5>@lang('app.time_format')</h5>
    <div class="submit-field">
    <div class="radio">
			<input id="radio-1" value="g:i a" name="time_format" type="radio" {{ get_option('time_format') == 'g:i a'? 'checked':'' }}>
			<label for="radio-1"><span class="radio-label"></span> {{ date('g:i a') }}&nbsp;(g:i a)</label>
	</div>
    <div class="radio">
			<input id="radio-2" value="g:i A" name="time_format" type="radio" {{ get_option('time_format') == 'g:i A'? 'checked':'' }}>
			<label for="radio-2"><span class="radio-label"></span> {{ date('g:i A') }}&nbsp;(g:i A)</label>
	</div>
    <div class="radio">
			<input id="radio-3" value="H:i" name="time_format" type="radio" {{ get_option('time_format') == 'H:i'? 'checked':'' }}>
			<label for="radio-3"><span class="radio-label"></span> {{ date('H:i') }}&nbsp;(H:i)</label>
	</div>
    <div class="radio">
			<input id="radio-4" value="custom" name="time_format" type="radio" {{ get_option('time_format') == 'custom'? 'checked':'' }}>
			<label for="radio-4"><span class="radio-label"></span> Custom:</label>
	</div>
        <fieldset>
            <input type="text" value="{{ get_option('time_format_custom') }}" id="time_format_custom" name="time_format_custom" />
            <span>example: {{ date(get_option('time_format_custom')) }}</span>
        </fieldset>
        <p><a href="http://php.net/manual/en/function.date.php" target="_blank">@lang('app.date_time_read_more')</a> </p>
    </div>
</div>

<div class="col-xl-6 {{ $errors->has('currency_sign')? 'has-error':'' }}">
    <h5>@lang('app.currency_sign')</h5>
    <div class="submit-field">
        <?php $current_currency = get_option('currency_sign'); ?>
        <select name="currency_sign" class="selectpicker form-control with-border">
            @foreach(themeqx_classifieds_currencies() as $code => $name)
                <option value="{{ $code }}"  {{ $current_currency == $code? 'selected':'' }}> {{ $code }} </option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-xl-6 {{ $errors->has('currency_position')? 'has-error':'' }}">
    <h5>@lang('app.currency_position')</h5>
    <div class="submit-field">
        <?php $currency_position = get_option('currency_position'); ?>
        <select name="currency_position" class="selectpicker form-control with-border">
            <option value="left" @if($currency_position == 'left') selected="selected" @endif >@lang('app.left')</option>
            <option value="right" @if($currency_position == 'right') selected="selected" @endif >@lang('app.right')</option>
        </select>
    </div>
</div>

<div class="col-xl-4 {{ $errors->has('logo_settings')? 'has-error':'' }}">
    <h5>@lang('app.logo_settings')</h5>
    <div class="submit-field">
    <div class="radio">
			<input id="radio-1" value="show_site_name" name="logo_settings" type="radio" {{ get_option('logo_settings') == 'show_site_name'? 'checked':'' }}>
			<label for="radio-1"><span class="radio-label"></span> @lang('app.show_site_name')</label>
	</div>
    <div class="radio">
			<input id="radio-2" value="show_image" name="logo_settings" type="radio" {{ get_option('logo_settings') == 'show_image'? 'checked':'' }}>
			<label for="radio-2"><span class="radio-label"></span> @lang('app.show_image')</label>
	</div>
    </div>
</div>


<div class="col-xl-4 {{ $errors->has('verification_email_after_registration')? 'has-error':'' }}">
    <h5>@lang('app.verification_email_after_registration')</h5>
    <div class="submit-field">
    <div class="radio">
			<input id="radio-1" value="1" name="verification_email_after_registration" type="radio" {{ get_option('logo_settings') == 'show_site_name'? 'checked':'' }}>
			<label for="radio-1"><span class="radio-label"></span> @lang('app.yes')</label>
	</div>
    <div class="radio">
			<input id="radio-2" value="0" name="verification_email_after_registration" type="radio" {{ get_option('logo_settings') == 'show_image'? 'checked':'' }}>
			<label for="radio-2"><span class="radio-label"></span> @lang('app.no')</label>
	</div>
    </div>
</div>


<div class="col-xl-4 {{ $errors->has('enable_google_maps')? 'has-error':'' }}">
    <h5">@lang('app.enable_google_maps')</h5>
    <div class="submit-field">
    <div class="radio">
			<input id="radio-1" value="1" name="enable_google_maps" type="radio" {{ get_option('enable_google_maps') == '1'? 'checked':'' }}>
			<label for="radio-1"><span class="radio-label"></span> @lang('app.yes')</label>
	</div>
    <div class="radio">
			<input id="radio-2" value="0" name="enable_google_maps" type="radio" {{ get_option('enable_google_maps') == '0'? 'checked':'' }}>
			<label for="radio-2"><span class="radio-label"></span> @lang('app.yes')</label>
	</div>
    </div>
</div>

<div class="col-xl-6 {{ $errors->has('google_map_api_key')? 'has-error':'' }}">
    <h5>@lang('app.google_map_api_key')</h5>
    <div class="submit-field">
        <input type="text" class="with-border" id="google_map_api_key" value="{{ old('google_map_api_key')? old('google_map_api_key') : get_option('google_map_api_key') }}" name="google_map_api_key" placeholder="@lang('app.google_map_api_key')">
        <p class="help-block"> @lang('app.google_map_api_key_get_info') <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">https://developers.google.com/maps/documentation/javascript/get-api-key</a> </p>
        {!! $errors->has('google_map_api_key')? '<p class="help-block">'.$errors->first('google_map_api_key').'</p>':'' !!}
    </div>
</div>





<div class="col-xl-6">
    <h5>@lang('app.google_map_embedded_code') for @lang('app.contact_us_page') </h5>
    <div class="submit-field">
        <textarea name="google_map_embedded_code" class="with-border">{{ get_option('google_map_embedded_code') }}</textarea>
        <a href="https://support.google.com/maps/answer/144361" target="_blank">@lang('app.google_map_embedded_code_help_text')</a>
    </div>
</div>




<div class="col-xl-6 {{ $errors->has('enable_comments')? 'has-error':'' }}">
    <h5>@lang('app.enable_disable') @lang('app.comments') </h5>
    <div class="submit-field">
    <div class="checkbox">
				<input type="checkbox" id="chekenable_commentscbox1" name="enable_comments" {{ get_option('enable_comments') == 1 ? 'checked="checked"': '' }}>
				<label for="enable_comments"><span class="checkbox-icon"></span>  @lang('app.enable_comments')</label>
			</div>
    </div>
</div>

<div class="col-xl-6 {{ $errors->has('enable_fb_comments')? 'has-error':'' }}">
    <h5>@lang('app.enable_disable') </h5>
    <div class="submit-field">
    <div class="checkbox">
				<input type="checkbox" id="enable_fb_comments" name="enable_fb_comments" {{ get_option('enable_fb_comments') == 1 ? 'checked="checked"': '' }}>
				<label for="enable_fb_comments"><span class="checkbox-icon"></span>  @lang('app.enable_fb_comments')</label>
			</div>
    </div>
    </div>
</div>

<div class="col-xl-12">
					<button class="button ripple-effect big margin-top-30" type="submit" form="login-general-settings">Save Changes</button>
				</div>

</form>



									</div>
								</div>
							</div>

						</div>
					</div>
				</div>




			</div>
			<!-- Row / End -->

			<!-- Footer -->
			<div class="dashboard-footer-spacer"></div>
			<div class="small-footer margin-top-15">
				<div class="small-footer-copyrights">
					© 2018 <strong>Hireo</strong>. All Rights Reserved.
				</div>
				<ul class="footer-social-links">
					<li>
						<a href="#" title="Facebook" data-tippy-placement="top">
							<i class="icon-brand-facebook-f"></i>
						</a>
					</li>
					<li>
						<a href="#" title="Twitter" data-tippy-placement="top">
							<i class="icon-brand-twitter"></i>
						</a>
					</li>
					<li>
						<a href="#" title="Google Plus" data-tippy-placement="top">
							<i class="icon-brand-google-plus-g"></i>
						</a>
					</li>
					<li>
						<a href="#" title="LinkedIn" data-tippy-placement="top">
							<i class="icon-brand-linkedin-in"></i>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<!-- Footer / End -->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script src="{{url('/')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{url('/')}}/js/jquery-migrate-3.0.0.min.js"></script>
<script src="{{url('/')}}/js/mmenu.min.js"></script>
<script src="{{url('/')}}/js/tippy.all.min.js"></script>
<script src="{{url('/')}}/js/simplebar.min.js"></script>
<script src="{{url('/')}}/js/bootstrap-slider.min.js"></script>
<script src="{{url('/')}}/js/bootstrap-select.min.js"></script>
<script src="{{url('/')}}/js/snackbar.js"></script>
<script src="{{url('/')}}/js/clipboard.min.js"></script>
<script src="{{url('/')}}/js/counterup.min.js"></script>
<script src="{{url('/')}}/js/magnific-popup.min.js"></script>
<script src="{{url('/')}}/js/slick.min.js"></script>
<script src="{{url('/')}}/js/custom.js"></script>

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
// Snackbar for user status switcher
$('#snackbar-user-status h5').click(function() {
	Snackbar.show({
		text: 'Your status has been changed!',
		pos: 'bottom-center',
		showAction: false,
		actionText: "Dismiss",
		duration: 3000,
		textColor: '#fff',
		backgroundColor: '#383838'
	});
});
</script>

<!-- Chart.js // documentation: http://www.chartjs.org/docs/latest/ -->
<script src="{{url('/')}}/js/chart.min.js"></script>
<script>
	Chart.defaults.global.defaultFontFamily = "Nunito";
	Chart.defaults.global.defaultFontColor = '#888';
	Chart.defaults.global.defaultFontSize = '14';

	var ctx = document.getElementById('chart').getContext('2d');

	var chart = new Chart(ctx, {
		type: 'line',

		// The data for our dataset
		data: {
			h5s: ["January", "February", "March", "April", "May", "June"],
			// Information about the dataset
	   		datasets: [{
				h5: "Views",
				backgroundColor: 'rgba(42,65,232,0.08)',
				borderColor: '#2a41e8',
				borderWidth: "3",
				data: [196,132,215,362,210,252],
				pointRadius: 5,
				pointHoverRadius:5,
				pointHitRadius: 10,
				pointBackgroundColor: "#fff",
				pointHoverBackgroundColor: "#fff",
				pointBorderWidth: "2",
			}]
		},

		// Configuration options
		options: {

		    layout: {
		      padding: 10,
		  	},

			legend: { display: false },
			title:  { display: false },

			scales: {
				yAxes: [{
					scaleh5: {
						display: false
					},
					gridLines: {
						 borderDash: [6, 10],
						 color: "#d8d8d8",
						 lineWidth: 1,
	            	},
				}],
				xAxes: [{
					scaleh5: { display: false },
					gridLines:  { display: false },
				}],
			},

		    tooltips: {
		      backgroundColor: '#333',
		      titleFontSize: 13,
		      titleFontColor: '#fff',
		      bodyFontColor: '#fff',
		      bodyFontSize: 13,
		      displayColors: false,
		      xPadding: 10,
		      yPadding: 10,
		      intersect: false
		    }
		},


});

</script>


<!-- Google Autocomplete -->
<script>
	function initAutocomplete() {
		 var options = {
		  types: ['(cities)'],
		  // componentRestrictions: {country: "us"}
		 };

		 var input = document.getElementById('autocomplete-input');
		 var autocomplete = new google.maps.places.Autocomplete(input, options);

		if ($('.submit-field')[0]) {
		    setTimeout(function(){
		        $(".pac-container").prependTo("#autocomplete-container");
		    }, 300);
		}
	}
</script>



</body>
</html>
