<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>{{get_option('site_name')}} | Site Pages</title>
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
						<li class="active"><a href="{{ route('pages') }}"><i class="icon-material-outline-description"></i> Pages</a></li>	
						<li><a href="{{ route('parent_categories') }}"><i class="icon-line-awesome-folder-open-o"></i> Categories</a></li>	
							<li><a href="#"><i class="icon-material-outline-settings"></i> Settings</a>
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
						<li><a href="{{route('pages')}}">Pages</a></li>
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
							<h3><i class="icon-material-outline-account-circle"></i> Pages</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

                                <div class="col-xl-12">
                                    <a href="{{ route('create_new_page') }}"><button class="button ripple-effect big margin-top-30" type="submit" form="add-page">Create New Page</button></a>
                                </div>

							</div>

							<br>
							<br>

                            <div class="container">
                                     <div class="row">
                                                    <div class="col-auto">
                                                            
                                                        </div>
                                                        <div class="col-xl-10 col-md-10">
                                                    @if($pages->count())
                                                        <table class="basic-table">

                                                            <tbody>
                                                                <tr>
                                                                    <th>@lang('app.title')</th>
																	<th>@lang('app.page_url')</th>
                                                                    <th>@lang('app.created_at')</th>
                                                                    <th>@lang('app.actions')</th>
                                                                </tr>

                                                                @foreach($pages as $page)
                                                                            <tr>
                                                                                <td>{!! $page->title !!}</td>
																				<td><a href="{{ route('single_page',['slug'=>$page->slug]) }}" target="_blank">{{ route('single_page',['slug'=>$page->slug]) }}</a></td>
                                                                                <td>{!! $page->created_at_datetime() !!}</td>
                                                                                <td>
                                                                                    <?php
                                                                                    $button = '';
                                                                                    $button .= '<a href="'.route('edit_page',$page->slug).'" ><i style="color:green;" class="icon-feather-edit-2"></i> </a><a href="javascript:;" data-slug="'.$page->slug.'"><i style="color:red;" class="icon-material-outline-delete"></i> </a>';
                                                                                    echo $button;

                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                 @endforeach


                                                            </tbody>
                                                            
                                                        </table>

                                                            {!! $pages->links() !!}


                                                        @endif
                                                            <br>
                                                            <br>
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
$('#snackbar-user-status label').click(function() {
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

<script>
        $(document).ready(function() {
            $('body').on('click', '.btn-danger', function (e) {
                if (!confirm("<?php echo trans('app.are_you_sure') ?>")) {
                    e.preventDefault();
                    return false;
                }

                var selector = $(this);
                var slug = $(this).data('slug');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('delete_page') }}',
                    data: {slug: slug, _token: '{{ csrf_token() }}'},
                    success: function (data) {
                        if (data.success == 1) {
                            selector.closest('tr').hide('slow');
                            var options = {closeButton: true};
                            toastr.success(data.msg, '<?php echo trans('app.success') ?>', options)
                        }
                    }
                });
            });
        });
    </script>

    <script>
        var options = {closeButton : true};
        @if(session('success'))
            toastr.success('{{ session('success') }}', '<?php echo trans('app.success') ?>', options);
        @endif
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
			labels: ["January", "February", "March", "April", "May", "June"],
			// Information about the dataset
	   		datasets: [{
				label: "Views",
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
					scaleLabel: {
						display: false
					},
					gridLines: {
						 borderDash: [6, 10],
						 color: "#d8d8d8",
						 lineWidth: 1,
	            	},
				}],
				xAxes: [{
					scaleLabel: { display: false },
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
