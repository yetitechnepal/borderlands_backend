<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Admin - Borderlands</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('/bac/img/icon.ico')}}" type="image/x-icon"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
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

    <style>
        .fc-title{
            color:white!important;
        }

        .fc-time{
            display:none!important;
        }
    </style>
</head>
<body>
<div class="wrapper sidebar_minimize">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="../index.html" class="logo">
					<img src="{{ asset('/bac/img/logo.ico')}}" style="height:50px" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">			
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<H2 style="color:white;">Borderlands</H2>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{ asset('/bac/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="/logout">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ asset('/bac/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									Borderlands Admin
									<span class="user-level">Administrator</span>
								</span>
							</a>
							<div class="clearfix"></div>

						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Common</p>
								<span class="caret"></span>
							</a>
							<div class="" id="dashboard">
								<ul class="nav nav-collapse">
									<li>
										<a href="/adminDashboard">
											<span class="sub-item">Dashboard</span>
										</a>
									</li>
									<li>
										<a href="/adminBanner">
											<span class="sub-item">Banners</span>
										</a>
									</li>
									<li>
										<a href="/adminTestimonial">
											<span class="sub-item">Testimonials</span>
										</a>
									</li>
									<li>
										<a href="/adminCompany">
											<span class="sub-item">Companies</span>
										</a>
									</li>
									
									<li>
										<a href="/adminVideo">
											<span class="sub-item">Videos</span>
										</a>
									</li>
                                    <li>
										<a href="/fullcalendareventmaster">
											<span class="sub-item">Events</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
                <div class="page-inner">
					<div class="">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<h4 class="card-title">Add a Event</h4>
									<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
										<i class="fa fa-plus"></i>
										Add a Event
									</button>
								</div>
							</div>
							<div class="card-body">

								<!-- Modal -->
								<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													New Event
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p class="small">Create a new row using this form, make sure you fill them all</p>
												<form action="{{route('event.add')}}" method="post" enctype="multipart/form-data">
													@csrf
													<div class="">
															<div class="form-group form-group-default">
																<label>Title</label>
																<input required id="title" type="text" class="form-control" name='title' placeholder="title">
															</div>
															<div class="form-group form-group-default">
																<label>Select Start Date</label>
																<input required id="start" type="date" class="form-control" name='start'>
															</div>

														

															<div class="form-group form-group-default">
																<label>Select End Date</label>
																<input required id="end" type="date" class="form-control" name='end'>
															</div>
													</div>
												
													<div class="modal-footer no-bd">
														<button type="submit" id="addPackage" class="btn btn-primary">Add</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>

								<div class="response alert alert-success mt-2" style="display: none;"></div>
								<div id='calendar'></div>  
							</div>
						</div>
                    </div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					
					<div class="copyright ml-auto">
						2020, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.theyetitech.com">Yeti Tech</a>
					</div>				
				</div>
			</footer>
		</div>
		
	</div>
	<!--   Core JS Files   -->
	<!-- <script src="{{ asset('/bac/js/core/jquery.3.2.1.min.js')}}"></script> -->
	<script src="{{ asset('/bac/js/core/popper.min.js')}}"></script>
	<script src="{{ asset('/bac/js/core/bootstrap.min.js')}}"></script>
	<!-- jQuery UI -->
	<script src="{{ asset('/bac/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{ asset('/bac/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
	<script src="{{ asset('/bac/js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('/bac/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
	<!-- Atlantis JS -->
	<script src="{{ asset('/bac/js/atlantis.min.js')}}"></script>
	<!-- Datatables -->
<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
    <script>
    $(document).ready(function () {
        var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            events: SITEURL + "/fullcalendareventmaster",
            displayEventTime: true,
            editable: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Event Title:');
 
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
 
                    $.ajax({
                        url: SITEURL + "/fullcalendareventmaster/create",
                        data: 'title=' + title + '&start=' + start + '&end=' + end,
                        type: "POST",
                        success: function (data) {
                            displayMessage("Added Successfully");
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('refetchEvents' );
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                    true
                            );
                }
                calendar.fullCalendar('unselect');
            },
             
            eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + '/fullcalendareventmaster/update',
                            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                            type: "POST",
                            success: function (response) {
                                displayMessage("Updated Successfully");
                            }
                        });
                    },
            eventClick: function (event) {
				if(event.type==="Quick Date"){
					alert("Cannot delete Quick Date from here!");
				}else{
					var deleteMsg = confirm("Do you really want to delete?");
					if (deleteMsg) {
						$.ajax({
							type: "POST",
							url: SITEURL + '/fullcalendareventmaster/delete',
							data: "&id=" + event.id,
							success: function (response) {
								if(parseInt(response) > 0) {
									$('#calendar').fullCalendar('removeEvents', event.id);
									displayMessage("Deleted Successfully");
								}
							}
						});
					}
				}
                
            }
        });
    });
 
    function displayMessage(message) {
        $(".response").css('display','block');
        $(".response").html(""+message+"");
        setInterval(function() { $(".response").fadeOut(); }, 4000);
    }
</script>
</body>

</html>