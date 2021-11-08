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
                    <a href="#">Company Details</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Packages</a>
                </li>
            </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">Add Package</h4>
						<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
							<i class="fa fa-plus"></i>
							Add Package
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
										New Package
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p class="small">Create a new row using this form, make sure you fill them all</p>
									<form action="{{route('package.add')}}" method="post" enctype="multipart/form-data">
                                        @csrf
										<input type="hidden" name="id" value="{{$CompanyInfo['id']}}" />
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Title</label>
													<input required id="title" type="text" class="form-control" name="title" placeholder="fill title">
												</div>
											</div>
                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Sub Title</label>
													<input required id="subtitle" type="text" class="form-control" name='subtitle' placeholder="subtitle">
												</div>
											</div>

											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label for="comment">About Package</label>
													<textarea name='aboutPackage' class="form-control" id="comment" rows="5" required></textarea>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Rating</label>
													<input required id="rating" type="text" class="form-control" name='rating' placeholder="rating">
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Duration</label>
													<input required id="Duration" type="text" class="form-control" name='Duration' placeholder="Duration">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group form-group-default">
													<label>Hot Deals</label>
													<input value="1" checked id="hotdeals" type="checkbox" class="form-control" name='hotdeals' placeholder="hotdeals">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group form-group-default">
													<label>Featured</label>
													<input value="1" checked id="featured" type="checkbox" class="form-control" name='featured' placeholder="featured">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group form-group-default">
													<label>Most Popular</label>
													<input value="1" checked id="mostpopular" type="checkbox" class="form-control" name='mostpopular' placeholder="mostpopular">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group form-group-default">
													<label>Top Deals</label>
													<input value="1" checked id="topdeals" type="checkbox" class="form-control" name='topdeals' placeholder="topdeals">
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group form-group-default">
													<label>Highlights</label>
													<input value="1" checked id="highlights" type="checkbox" class="form-control" name='highlights' placeholder="highlights">
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group form-group-default">
													<label>Trending</label>
													<input value="1" checked id="trending" type="checkbox" class="form-control" name='trending' placeholder="trending">
												</div>
											</div>

                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Cover Image</label>

                                                    <input required type="file" name="coverImage" id="logo" onchange="loadLogoPreview(this);" class="form-control-file" >
                                                    <img id="logoPreview" src="" style="width:200px;height:auto;"/>
												</div>
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

					<div class="table-responsive">
						<table id="add-row" class="display table table-striped table-hover" >
							<thead>
								<tr>
									<th>Title</th>
									<th>Subtitle</th>
									<th>About Package</th>
									<th>Whats Included</th>
									<th>Quick Dates</th>
									<!-- <th>Rating</th>
									<th>Duration</th>
									<th>Hot Deals</th>
									<th>Featured</th>
									<th>Most Popular</th>
									<th>Top Deals</th>
                                    <th>Highlights</th>
                                    <th>Trending</th> -->
                                    <th>Cover Image</th>
                                    <th>Edit</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
                                    <th>Title</th>
									<th>Subtitle</th>
									<th>About Package</th>
									<th>Whats Included</th>
									<th>Quick Dates</th>
									<!-- <th>Rating</th>
									<th>Duration</th>
									<th>Hot Deals</th>
                                    <th>Featured</th>
                                    <th>Most Popular</th>
                                    <th>Top Deals</th>
                                    <th>Highlights</th>
                                    <th>Trending</th> -->
                                    <th>Cover Image</th>
                                    <th>Edit</th>
								</tr>
							</tfoot>
							<tbody>
                            @foreach ($packages as $package) 
								<tr>
									<td>{{$package->title}}</td>
									<td>{{$package->subtitle}}</td>
									<td>{{$package->aboutPackage}}</td>
									<td><a href="/adminWhatsIncluded/{{$package->id}}">View All</a></td>
									<td><a href="/adminPackageQuickdates/{{$package->id}}">View All</a></td>
									<!-- <td>{{$package->rating}}</td>
									<td>{{$package->Duration}}</td>
									<td>{{$package->hotdeals}}</td>
									<td>{{$package->featured}}</td>
									<td>{{$package->mostpopular}}</td>
									<td>{{$package->topdeals}}</td>
									<td>{{$package->highlights}}</td>
									<td>{{$package->trending}}</td> -->
									
                                    <td>
                                        <figure class="imagecheck-figure">
									    	<img style="height:100px;" src="{{asset('images').'\\'.$package->coverImage}}" alt="thamelpark" class="imagecheck-image">
									    </figure>
                                    </td>
                                    <td>
										<div class="form-button-action">
											<button type="button" data-toggle="modal" data-target="#update{{$package->id}}" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
												<i class="fa fa-edit"></i>
											</button>
											<form action="{{route('package.destroy')}}" method="post">
												@csrf
												<input type="hidden" name="id" value="{{$package->id}}" >
												<button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
													<i class="fa fa-times"></i>
												</button>
											</form>
										</div>
									</td>
								</tr>
								<!-- Modal -->
								<div class="modal fade" id="update{{$package->id}}" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													Update Package Details
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p class="small">Update row using this form, make sure you fill them all</p>
												<form action="{{route('package.save')}}" method="post" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="id" value="{{$package->id}}" >
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Title</label>
																<input value="{{$package->title}}" required id="title" type="text" class="form-control" name="title" placeholder="fill title">
															</div>
														</div>
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Sub Title</label>
																<input value="{{$package->subtitle}}" required id="subtitle" type="text" class="form-control" name='subtitle' placeholder="subtitle">
															</div>
														</div>

														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label for="comment">About Package</label>
																<textarea name='aboutPackage' class="form-control" id="comment" rows="5" required>{{$package->aboutPackage}}</textarea>
															</div>
														</div>

														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Rating</label>
																<input value="{{$package->id}}" required id="rating" type="text" class="form-control" name='rating' placeholder="rating">
															</div>
														</div>
														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Duration</label>
																<input value="{{$package->Duration}}" required id="Duration" type="text" class="form-control" name='Duration' placeholder="Duration">
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group form-group-default">
																<label>Hot Deals</label>
																<input value="1" <?php echo ($package->hotdeals == 1) ? "checked" : "";  ?> id="hotdeals" type="checkbox" class="form-control" name='hotdeals' placeholder="hotdeals">
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group form-group-default">
																<label>Featured</label>
																<input value="1" <?php echo ($package->featured == 1) ? "checked" : "";  ?> id="featured" type="checkbox" class="form-control" name='featured' placeholder="featured">
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group form-group-default">
																<label>Most Popular</label>
																<input value="1" <?php echo ($package->mostpopular == 1) ? "checked" : "";  ?> id="mostpopular" type="checkbox" class="form-control" name='mostpopular' placeholder="mostpopular">
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group form-group-default">
																<label>Top Deals</label>
																<input value="1" <?php echo ($package->topdeals == 1) ? "checked" : "";  ?> id="topdeals" type="checkbox" class="form-control" name='topdeals' placeholder="topdeals">
															</div>
														</div>

														<div class="col-sm-4">
															<div class="form-group form-group-default">
																<label>Highlights</label>
																<input value="1" <?php echo ($package->highlights == 1) ? "checked" : "";  ?> id="highlights" type="checkbox" class="form-control" name='highlights' placeholder="highlights">
															</div>
														</div>

														<div class="col-sm-4">
															<div class="form-group form-group-default">
																<label>Trending</label>
																<input value="1" <?php echo ($package->trending == 1) ? "checked" : "";  ?> id="trending" type="checkbox" class="form-control" name='trending' placeholder="trending">
															</div>
														</div>

														<div class="col-sm-12">
															<div class="form-group form-group-default">
																<label>Cover Image</label>

																<input type="file" name="coverImage" id="logo" onchange="loadLogoPreview(this);" class="form-control-file" >
																<img id="logoPreview" src="{{asset('images').'\\'.$package->coverImage}}" style="width:200px;height:auto;"/>
															</div>
														</div>
													</div>
													<div class="modal-footer no-bd">
														<button type="submit" id="addPackage" class="btn btn-primary">Update</button>
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