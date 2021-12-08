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
                    <a href="#">Videos</a>
                </li>
            </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">Add Video</h4>
						<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
							<i class="fa fa-plus"></i>
							Add Video
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
										New Video
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p class="small">Create a new row using this form, make sure you fill them all</p>
                                    
									<form action="{{route('video.add')}}" method="post" enctype="multipart/form-data">
                                        @csrf
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>title</label>
													<input required id="title" type="text" value="title" class="form-control" name="title" placeholder="fill title">
												</div>
											</div>
											
                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>link</label>
													<input required id="link" type="text" class="form-control" name="link" placeholder="fill link">
												</div>
											</div>

											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Thumbnail Image</label>

                                                    <input required type="file" name="thumbnail" id="logo" onchange="loadLogoPreview(this);" class="form-control-file" >
                                                    <img id="logoPreview" src="" style="width:200px;height:auto;"/>
												</div>
											</div>

										</div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" id="addvideo" class="btn btn-primary">Add</button>
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
                                    <th>Title</th>
									<th>Link</th>
									<th>Thumbnail Image</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
                                    <th>Title</th>
									<th>Link</th>
									<th>Thumbnail Image</th>
									<th>Edit</th>
								</tr>
							</tfoot>
							<tbody>
                            @foreach ($videos as $video) 
								<tr>
									<td>{{$video->title}}</td>
									<td><a href="{{$video->link}}" target="_blank">{{$video->link}}</a></td>
									<td>
                                        <figure class="imagecheck-figure">
									    	<img style="height:100px;object-fit:cover;" src="{{asset('images').'\\'.$video->thumbnail}}" alt="thamelpark" class="imagecheck-image">
									    </figure>
                                    </td>
                                    <td>
										<div class="form-button-action">
											<button type="button" data-toggle="modal" data-target="#update{{$video->id}}" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
												<i class="fa fa-edit"></i>
											</button>
											<form action="{{route('video.destroy')}}" method="post">
												@csrf
												<input type="hidden" name="id" value="{{$video->id}}" >
												<button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
													<i class="fa fa-times"></i>
												</button>
											</form>
										</div>
									</td>
									
								</tr>
								<div class="modal fade" id="update{{$video->id}}" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													Update Link
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p class="small">Update row using this form, make sure you fill them all</p>
												
												<form action="{{route('video.save')}}" method="post" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="id" value="{{$video->id}}" >
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>title</label>
																<input value="{{$video->title}}" required id="title" type="text" class="form-control" name="title" placeholder="fill title">
															</div>
														</div>
														<div class="col-md-12 pr-0">
															<div class="form-group form-group-default">
																<label>Link</label> 
																<input value="{{$video->link}}" required id="link" type="text" class="form-control" name='link' placeholder="fill link">
															</div>
														</div>
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Thumbnail Image</label>

																<input type="file" name="thumbnail" id="logo" onchange="loadLogoPreview(this);" class="form-control-file" >
																<img  id="logoPreview" src="{{asset('images').'\\'.$video->thumbnail}}" style="width:200px;height:auto;"/>
															</div>
														</div>
													</div>
													<div class="modal-footer no-bd">
														<button type="submit" id="addvideo" class="btn btn-primary">Update</button>
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