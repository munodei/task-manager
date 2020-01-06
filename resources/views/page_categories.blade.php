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
				@if( ! empty($title))<span>{{ $title }}</span> @endif

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="{{ route('home') }}">Home</a></li>
						@if( ! empty($title))<li> {{ $title }} </li> @endif
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
                    @if( ! empty($title)) <h3 class="margin-bottom-10">{{ $title }}</h3> @endif
                    </center>

                    
                        @if($is_category_single && $category->sub_categories->count())
                        <!-- Category Boxes Container -->
                        <div class="categories-container">
                        @foreach($category->sub_categories as $sub_c)
                            <!-- Category Box -->
                            <a href="{{route('category',$sub_c->id )}}" class="category-box">
                                <div class="category-box-icon">
                                    <i class="{{ $sub_c->category_icon }}"></i>
                                </div>
                                <div class="category-box-content">
                                    <h3>{{$sub_c->category_name}}</h3>
                                </div>
                            </a>
                            @endforeach
                        </div>

                        @endif 

    			
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