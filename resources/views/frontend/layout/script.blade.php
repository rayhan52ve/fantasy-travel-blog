    	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{asset('assets/frontend/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/frontend/js/popper.js')}}"></script>
	<script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/frontend/js/stellar.js')}}"></script>
	<script src="{{asset('assets/frontend/vendors/lightbox/simpleLightbox.min.js')}}"></script>
	<script src="{{asset('assets/frontend/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{asset('assets/frontend/vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{asset('assets/frontend/vendors/isotope/isotope-min.js')}}"></script>
	<script src="{{asset('assets/frontend/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets/frontend/vendors/jquery-ui/jquery-ui.js')}}"></script>
	<script src="{{asset('assets/frontend/js/jquery.ajaxchimp.min.js')}}"></script>
	<script src="{{asset('assets/frontend/js/mail-script.js')}}"></script>
	<script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
	<script src="{{asset('assets/frontend/js/theme.js')}}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
				$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		    });
	</script>
	@yield('js')