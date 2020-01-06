<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>{{ get_option('site_title') }} | Contact Us Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/colors/blue.css">

</head>
<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
@include('includes.header')
<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Contact</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Pages</a></li>
						<li>Contact</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->


<!-- Container -->
<div class="container">
	<div class="row">

		<div class="col-xl-12">
			<div class="contact-location-info margin-bottom-50">
				<div class="contact-address">
					<ul>
						<li class="contact-address-headline">Our Office</li>
						<li>{{ get_option('address') }}</li>
						<li>Phone {{ get_option('contact_number') }}</li>
						<li><a href="#">{{ get_option('email_address')}}</a></li>
						<li>
							<div class="freelancer-socials">
								<ul>
									<li><a href="{{ get_option('facebook') }}" title="Facebook" data-tippy-placement="top"><i class="icon-brand-facebook"></i></a></li>
									<li><a href="{{ get_option('twitter') }}" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
									<li><a href="{{ get_option('instagram') }}" title="Instagram" data-tippy-placement="top"><i class="icon-brand-instagram"></i></a></li>
								
								</ul>
							</div>
						</li>
					</ul>

				</div>
				<div id="single-job-map-container">
					<div id="singleListingMap" data-latitude="-33.9986185" data-longitude="18.4661693" data-map-icon="im im-icon-Hamburger"></div>
					<a href="#" id="streetView">Street View</a>
				</div>
			</div>
		</div>

		<div class="col-xl-8 col-lg-8 offset-xl-2 offset-lg-2">

			<section id="contact" class="margin-bottom-60">
				<h3 class="headline margin-top-15 margin-bottom-35">Any questions? Feel free to contact us!</h3>

				<form method="post" name="contactform" id="contactform" autocomplete="on">
					<div class="row">
						<div class="col-md-6">
							<div class="input-with-icon-left">
								<input class="with-border" name="name" type="text" id="name" placeholder="Your Name" required="required" />
								<i class="icon-material-outline-account-circle"></i>
							</div>
						</div>

						<div class="col-md-6">
							<div class="input-with-icon-left">
								<input class="with-border" name="email" type="email" id="email" placeholder="Email Address" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
								<i class="icon-material-outline-email"></i>
							</div>
						</div>
					</div>

					<div class="input-with-icon-left">
						<input class="with-border" name="subject" type="text" id="subject" placeholder="Subject" required="required" />
						<i class="icon-material-outline-assignment"></i>
					</div>

					<div>
						<textarea class="with-border" name="comments" cols="40" rows="5" id="comments" placeholder="Message" spellcheck="true" required="required"></textarea>
					</div>

					<input type="submit" class="submit button margin-top-15" id="submit" value="Submit Message" />

				</form>
			</section>

		</div>

	</div>
</div>
<!-- Container / End -->

<!-- Footer
================================================== -->
@include('includes.footer')
<!-- Footer / End -->

</div>
<!-- Wrapper / End -->

<!-- Scripts
================================================== -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-migrate-3.0.0.min.js"></script>
<script src="js/mmenu.min.js"></script>
<script src="js/tippy.all.min.js"></script>
<script src="js/simplebar.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/snackbar.js"></script>
<script src="js/clipboard.min.js"></script>
<script src="js/counterup.min.js"></script>
<script src="js/magnific-popup.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/custom.js"></script>

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

<!-- Google API & Maps -->
<!-- Geting an API Key: https://developers.google.com/maps/documentation/javascript/get-api-key -->
<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
<script src="js/infobox.min.js"></script>
<script src="js/markerclusterer.js"></script>
<script src="js/maps.js"></script>

</body>
</html>