@extends('bac.index')

@section('content')

<div>
    <div class="page-header">
					
        <h4 class="page-title">Dashboard</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Bookings</a>
                </li>
            </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
				<div class="card-body">

					<div class="table-responsive">
						<table id="add-row" class="display table table-striped table-hover" >
							<thead>
								<tr>
                                    <th>Company</th>
                                    <th>Name</th>
									<th>Contact</th>
                                    <th>Package</th>
									<th>Pax</th>
									<th>Bill Amount</th>
									<th>Trans. Code</th>
									<th>Status</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Company</th>
                                    <th>Name</th>
									<th>Contact</th>
                                    <th>Package</th>
									<th>Pax</th>
									<th>Bill Amount</th>
									<th>Trans. Code</th>
									<th>Status</th>
								</tr>
							</tfoot>
							<tbody>
                            @foreach ($bookings as $booking) 
								<tr>
									<td>{{$booking->companyName}}</td>
									<td>{{$booking->name}}</td>
									<td>{{$booking->phone}}<br>{{$booking->email}}</td>
									<td>{{$booking->title}}<br>{{date('M/d/y',strtotime($booking->stdate))}} -  {{date('M/d/y',strtotime($booking->enddate))}}</td>
									<td>{{$booking->noOfGuests}}</td>
									<td>{{$booking->billedAmount}}</td>
									<td>{{$booking->transctionId}}</td>
									<td><button data-toggle="modal" data-target="#update{{$booking->id}}"> {{$booking->status}}</button></td>
								</tr>
								<!-- Modal -->
								<div class="modal fade" id="update{{$booking->id}}" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													Update Book Status
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p class="small">Update row using this form, make sure you fill them all</p>
												
												<form action="{{route('booking.save')}}" method="post" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="id" value="{{$booking->id}}" >
													<div class="row">
														<div class="form-group">
															<label for="defaultSelect">status</label>
															<select required class="form-control form-control" name="status" id="defaultSelect">
																<option <?php if($booking->status == 'pending'){ echo 'selected';} ?> value="pending"  >Pending</option>
																<option <?php if($booking->status == 'completed'){ echo 'selected';} ?> value="completed">Completed</option>
																<option <?php if($booking->status == 'cancelled'){ echo 'selected';} ?> value="cancelled">Cancelled</option>
															</select>
														</div>
													</div>
													<div class="modal-footer no-bd">
														<button type="submit" class="btn btn-primary">Update</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
                            @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<script>
    function loadLogoPreview(input, id) {
      id = id || '#logoPreview';
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $(id)
                      .attr('src', e.target.result)
                      .width('200px')
                      .height('auto');
          };

          reader.readAsDataURL(input.files[0]);
      }
    }
</script>

@endsection