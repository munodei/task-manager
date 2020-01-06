<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>{{ get_option('site_title') }} | {{ $title }}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{ url('/') }}/css/style.css">
<link rel="stylesheet" href="{{ url('/') }}/css/colors/blue.css">

</head>
<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
@include('includes.header')
<div class="clearfix"></div>
<!-- Header Container / End -->



<!-- Content
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>{{ get_option('site_name') }}</h2>
				<span>{{ $page->title }}</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="{{ route('home') }}">Home</a></li>
						<li>{{ $page->title }}</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- Post Content -->
<div class="container">
	<div class="row">
		
		<!-- Inner Content -->
		<div class="col-xl-12 col-lg-12">
			<!-- Blog Post -->
			<div class="blog-post single-post">

				<!-- Blog Post Thumbnail -->


				<!-- Blog Post Content -->
				<div class="blog-post-content">
					<center>
                    <h3 class="margin-bottom-10">{{ $page->title }}</h3>
                    </center>



                    {!! safe_output($page->post_content) !!}

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Interesting? <strong>Share It!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="{{ route('single_page',['slug'=>$page->slug]) }}" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="{{ route('single_page',['slug'=>$page->slug]) }}" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="{{ route('single_page',['slug'=>$page->slug]) }}" data-button-color="#dd4b39" title="Share on Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
								<li><a href="{{ route('single_page',['slug'=>$page->slug]) }}" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Blog Post Content / End -->
		

		</div>
		<!-- Inner Content / End -->

</div>
</div>
<!-- Spacer -->
<div class="padding-top-40"></div>
<!-- Spacer -->



<!-- Footer
================================================== -->
@include('includes.footer')
<!-- Footer / End -->

</div>
<!-- Wrapper / End -->

<!-- Scripts
================================================== -->
<script src="{{ url('/') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{ url('/') }}/js/jquery-migrate-3.0.0.min.js"></script>
<script src="{{ url('/') }}/js/mmenu.min.js"></script>
<script src="{{ url('/') }}/js/tippy.all.min.js"></script>
<script src="{{ url('/') }}/js/simplebar.min.js"></script>
<script src="{{ url('/') }}/js/bootstrap-slider.min.js"></script>
<script src="{{ url('/') }}/js/bootstrap-select.min.js"></script>
<script src="{{ url('/') }}/js/snackbar.js"></script>
<script src="{{ url('/') }}/js/clipboard.min.js"></script>
<script src="{{ url('/') }}/js/counterup.min.js"></script>
<script src="{{ url('/') }}/js/magnific-popup.min.js"></script>
<script src="{{ url('/') }}/js/slick.min.js"></script>
<script src="{{ url('/') }}/js/custom.js"></script>

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

</body>
</html>