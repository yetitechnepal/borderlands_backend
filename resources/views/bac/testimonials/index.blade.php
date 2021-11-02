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
                    <a href="#">Testimonails</a>
                </li>
            </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">Add Testimonial</h4>
						<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
							<i class="fa fa-plus"></i>
							Add Testimonial
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
										New Testimonial
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p class="small">Create a new row using this form, make sure you fill them all</p>
                                    
									<form action="{{route('testimonial.add')}}" method="post" enctype="multipart/form-data">
                                        @csrf
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Name</label>
													<input required id="name" type="text" class="form-control" name="name" placeholder="fill name">
												</div>
											</div>
											<div class="col-md-12 pr-0">
												<div class="form-group form-group-default">
													<label>Message</label> 
													<input required id="message" type="text" class="form-control" name='message' placeholder="fill message">
												</div>
											</div>
											
                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Banner Image</label>

                                                    <input required type="file" name="image" id="logo" onchange="loadLogoPreview(this);" class="form-control-file" >
                                                    <img id="logoPreview" src="" style="width:200px;height:auto;"/>
												</div>
											</div>
										</div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" id="addBanner" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table id="add-row" class="display table table-striped table-hover" >
							<thead>
								<tr>
                                    <th>Name</th>
									<th>Message</th>
									<th>Image</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
                                    <th>Name</th>
									<th>Message</th>
									<th>Image</th>
									<th>Edit</th>
								</tr>
							</tfoot>
							<tbody>
                            @foreach ($testimonials as $testimonial) 
								<tr>
									<td>{{$testimonial->name}}</td>
									<td>{{$testimonial->message}}</td>
									
                                    <td>
                                        <figure class="imagecheck-figure">
									    	<img style="height:100px;" src="{{asset('images').'\\'.$testimonial->image}}" alt="thamelpark" class="imagecheck-image">
									    </figure>
                                    </td>
                                    <td>
										<div class="form-button-action">
											<button type="button" data-toggle="modal" data-target="#update{{$testimonial->id}}" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
												<i class="fa fa-edit"></i>
											</button>
											<form action="{{route('testimonial.destroy')}}" method="post">
												@csrf
												<input type="hidden" name="id" value="{{$testimonial->id}}" >
												<button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
													<i class="fa fa-times"></i>
												</button>
											</form>
										</div>
									</td>
								</tr>
								<div class="modal fade" id="update{{$testimonial->id}}" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													Update Testimonial
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p class="small">Update row using this form, make sure you fill them all</p>
												
												<form action="{{route('testimonial.save')}}" method="post" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="id" value="{{$testimonial->id}}" >
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Name</label>
																<input value="{{$testimonial->name}}" required id="name" type="text" class="form-control" name="name" placeholder="fill name">
															</div>
														</div>
														<div class="col-md-12 pr-0">
															<div class="form-group form-group-default">
																<label>Message</label> 
																<input value="{{$testimonial->message}}" required id="message" type="text" class="form-control" name='message' placeholder="fill message">
															</div>
														</div>
														
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Banner Image</label>

																<input type="file" name="image" id="logo" onchange="loadLogoPreview(this);" class="form-control-file" >
																<img id="logoPreview" src="{{asset('images').'\\'.$testimonial->image}}" style="width:200px;height:auto;"/>
															</div>
														</div>
													</div>
													<div class="modal-footer no-bd">
														<button type="submit" id="addBanner" class="btn btn-primary">Update</button>
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