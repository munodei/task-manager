<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Favo</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{url('/')}}/css/style.css">
<link rel="stylesheet" href="{{url('/')}}/css/colors/blue.css">

</head>
<body>

<!-- Wrapper -->
<div id="wrapper">

@include('includes.header')

<div class="clearfix"></div>
<!-- Header Container / End -->

@yield('content')


<!-- Footer
================================================== -->
@include('includes.footer')
<!-- Footer / End -->

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

</body>
</html>
