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
                    <a href="#">Banner</a>
                </li>
            </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">Add Banner</h4>
						<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
							<i class="fa fa-plus"></i>
							Add Banner
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
										New Banner
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p class="small">Create a new row using this form, make sure you fill them all</p>
									<form action="{{route('banner.add')}}" method="post" enctype="multipart/form-data">
                                        @csrf
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Title</label>
													<input required id="title1" type="text" class="form-control" name="title" placeholder="fill title 1">
												</div>
											</div>
                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Subtitle</label>
													<input required id="subtitle" type="text" class="form-control" name='subTitle' placeholder="subtitle">
												</div>
											</div>
                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Description</label>
													<input required id="subtitle" type="text" class="form-control" name='desc' placeholder="subtitle">
												</div>
											</div>
                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Banner Image</label>

                                                    <input required type="file" name="bannerImage" id="logo" onchange="loadLogoPreview(this);" class="form-control-file" >
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
									<th>Title</th>
									<th>Subtitle</th>
									<th>desc</th>
									<th>Banner Image</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
                                    <th>Title</th>
									<th>Subtitle</th>
									<th>desc</th>
									<th>Banner Image</th>
									<th>Edit</th>
								</tr>
							</tfoot>
							<tbody>
                            @foreach ($banners as $banner) 
								<tr>
									<td>{{$banner->title}}</td>
									<td>{{$banner->subTitle}}</td>
									<td>{{$banner->desc}}</td>
									
                                    <td>
                                        <figure class="imagecheck-figure">
									    	<img style="height:100px;object-fit:cover;" src="{{asset('images').'\\'.$banner->bannerImage}}" alt="thamelpark" class="imagecheck-image">
									    </figure>
                                    </td>
                                    <td>
										<div class="form-button-action">
											<button type="button" data-toggle="modal" data-target="#update{{$banner->id}}" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
												<i class="fa fa-edit"></i>
											</button>
											<form action="{{route('banner.destroy')}}" method="post">
												@csrf
												<input type="hidden" name="id" value="{{$banner->id}}" >
												<button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
													<i class="fa fa-times"></i>
												</button>
											</form>
										</div>
									</td>
								</tr>
								<!-- Modal -->
								<div class="modal fade" id="update{{$banner->id}}" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													Update Banner
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p class="small">Update row using this form, make sure you fill them all</p>
												<form action="{{route('banner.save')}}" method="post" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="id" value="{{$banner->id}}" >
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Title</label>
																<input value="{{$banner->title}}" required id="title" type="text" class="form-control" name="title" placeholder="fill title">
															</div>
														</div>
														<div class="col-md-6 pr-0">
															<div class="form-group form-group-default">
																<label>Sub Title</label>
																<input value="{{$banner->subTitle}}" required id="subTitle" type="text" class="form-control" name='subTitle' placeholder="fill subTitle">
															</div>
														</div>
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Description</label>
																<input value="{{$banner->desc}}" required id="subtitle" type="text" class="form-control" name='desc' placeholder="desc">
															</div>
														</div>
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Banner Image</label>

																<input type="file" name="bannerImage" id="logo" onchange="loadLogoPreview(this);" class="form-control-file" >
																<img  id="logoPreview" src="{{asset('images').'\\'.$banner->bannerImage}}" style="width:200px;height:auto;"/>
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