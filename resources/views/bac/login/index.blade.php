<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Eco-Adventure Center</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('/bac/img/icon.ico')}}" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="{{ asset('/bac/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{ asset('/bac/css/fonts.min.css')}}"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('/bac/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('/bac/css/atlantis.min.css')}}">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('/bac/css/demo.css')}}">
</head>
<body>
	<div class="wrapper sidebar_minimize">
		
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					
					<div class="row">
						<div class="col-md-offset-4 col-lg-3 " style="float: none;margin: 0 auto;">
							<div class="card">
								<form action="{{route('login.check')}}" method="post" >
									@if(Session::get('fail'))
										<div class="alert alert-danger">
											{{Session::get('fail')}}
										</div>
									@endif
									@csrf
									<div class="card-body">
										<div class="row">
											<div class="col-md-12 col-lg-12">
												<div class="form-group">
													<label for="email2">Email Address</label>
													<input name="email" type="email" class="form-control" id="email2" placeholder="Enter Email">
													<span class="text-danger">@error('email'){{$message}} @enderror</span>
													<small id="emailHelp2" class="form-text text-muted">Never share your email with anyone else.</small>
												</div>
												<div class="form-group">
													<label for="password">Password</label>
													<input name="password" type="password" class="form-control" id="password" placeholder="Password">
													<span class="text-danger">@error('password'){{$message}} @enderror</span>
												</div>
												
											</div>
										</div>
									</div>
									<div class="card-action">
										<button type="submit" class="btn btn-success">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!--   Core JS Files   -->
	<script src="{{ asset('/bac/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{ asset('/bac/js/core/popper.min.js')}}"></script>
	<script src="{{ asset('/bac/js/core/bootstrap.min.js')}}"></script>
	<!-- jQuery UI -->
	<script src="{{ asset('/bac/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{ asset('/bac/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
	
	<!-- jQuery Scrollbar -->
	<script src="{{ asset('/bac/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
	<!-- Atlantis JS -->
	<script src="{{ asset('/bac/js/atlantis.min.js')}}"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{ asset('/bac/js/setting-demo2.js')}}"></script>
</body>
</html>