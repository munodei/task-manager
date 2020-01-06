<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>{{get_option('site_name')}} | Theme Settings</title>
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
						<li><a href="{{route('theme-settings')}}">Theme Settings</a></li>
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
							<h3><i class="icon-line-awesome-paint-brush"></i> Theme Settings</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">
                            <form action="{{route('save_settings')}}" class="form-horizontal" method="post" enctype="multipart/form-data" id="login-general-settings" name="login-general-settings">
                             {!! csrf_field() !!}

                            <div class="row">
                                <div class="col-xl-12 {{ $errors->has('variable_info')? 'has-error':'' }}">
                                    <h5>@lang('app.variable_info')</h5>
                                    <div class="submit-field">
									<pre>[year], [copyright_sign], [site_name]</pre>	
                                    </div>
                                </div>					

								<div class="col-xl-12 {{ $errors->has('additional_css')? 'has-error':'' }}">
                                    <h5>@lang('app.additional_css')</h5>
                                    <div class="submit-field">
									<textarea class="with-border" name="additional_css" >{{ get_option('additional_css') }}</textarea>
                                    </div>
									<p class="text-info">@lang('app.additional_css_help_text')</p>
                                </div>

								<div class="col-xl-12 {{ $errors->has('additional_js')? 'has-error':'' }}">
                                    <h5>@lang('app.additional_js')</h5>
                                    <div class="submit-field">
									<textarea class="with-border" name="additional_js" >{{  get_option('additional_js') }}</textarea>
                                    </div>
									<p class="text-info">@lang('app.additional_js_help_text')</p>
                                </div>


                                <div class="col-xl-12 {{ $errors->has('footer_company_name')? 'has-error':'' }}" >
                                    <h5>@lang('app.footer_company_name')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" value="{{ old('footer_company_name')? old('footer_company_name') : get_option('footer_company_name') }}" name="footer_company_name" placeholder="@lang('app.footer_company_name')">
                                        {!! $errors->has('paypal_receiver_email')? '<p class="help-block">'.$errors->first('paypal_receiver_email').'</p>':'' !!}
                                    </div>
                                </div>

								<div class="col-xl-12 {{ $errors->has('footer_copyright_text')? 'has-error':'' }}" >
                                    <h5>@lang('app.footer_copyright_text')</h5>
                                    <div class="submit-field">
                                        <input type="text" class="with-border" value="{{ old('footer_copyright_text')? old('footer_copyright_text') : get_option('footer_copyright_text') }}" name="footer_copyright_text" placeholder="@lang('app.footer_copyright_text')">
                                        {!! $errors->has('footer_copyright_text')? '<p class="help-block">'.$errors->first('footer_copyright_text').'</p>':'' !!}
                                    </div>
                                </div>

							

<div class="col-xl-12">
					<button class="button ripple-effect big margin-top-30" type="submit" form="login-general-settings">Save Changes</button>
				</div>

</form>
<br>
<br>


									</div>
								</div>
							</div>
							<br>
<br>
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
