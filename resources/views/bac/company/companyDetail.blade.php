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
            </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">Company Details</h4>
                        <a href="/adminPackages/{{$CompanyInfo['id']}}" class="btn btn-secondary btn-round ml-auto" style="margin-right:10px;" >
							<i class="fa fa-list"></i>
							View Packages
                        </a>
						<button class="btn btn-secondary btn-round " data-toggle="modal" data-target="#addRowModal" style="margin-right:5px">
							<i class="fa fa-plus"></i>
							Add Services
						</button>
                        <form action="{{route('company.destroy')}}" method="post">
							@csrf
							<input type="hidden" name="id" value="{{$CompanyInfo['id']}}" >
							<button type="submit" class="btn  btn-danger btn-round">
                            Delete this company <i class="fa fa-trash"></i>
                            </button>
						</form>
					</div>
				</div>
				<div class="card-body">
					<!-- Modal -->
					<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header no-bd">
									<h5 class="modal-title">
										New Service
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p class="small">Create a new row using this form, make sure you fill them all</p>
                                    
									<form action="{{route('service.add')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$CompanyInfo['id']}}" >
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Title</label>
													<input required id="title" type="text" class="form-control" name="title" placeholder="fill title">
												</div>
											</div>
											
                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Image</label>
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

					<div class="row">
                        <div class="col-md-7">
                            <form action="{{route('company.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" id="id" name="id" value="{{$CompanyInfo['id']}}">
                                <div class="card card-post card-round">
                                    <img class="card-img-top" src="{{asset('images').'\\'.$CompanyInfo['bannerImage']}}" style="height:200px;object-fit: cover;" alt="Card image cap">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="avatar"style="margin-top: auto; margin-bottom: auto;">
                                                <img src="{{asset('images').'\\'.$CompanyInfo['bannerImage']}}" alt="..." class="avatar-img rounded-circle">
                                            </div>
                                            <div class="info-post ml-2">
                                                    <div class="form-group form-floating-label" style="padding:0px!important;">
                                                        <input id="companyName" name="companyName" type="text" class="form-control input-border-bottom" required value="{{$CompanyInfo['companyName']}}" placeholder="Company Name">
                                                    </div>
                                                    <div class="form-group form-floating-label" style="padding:0px!important;">
                                                        <input id="companyAddress" name="companyAddress" type="text" class="form-control input-border-bottom" required value="{{$CompanyInfo['companyAddress']}}" placeholder="Address">
                                                    </div>
                                                    <div class="form-group form-floating-label" style="padding:0px!important;">
                                                        Change Cover Image
                                                        <input id="image" name="bannerImage" type="file" class="form-control input-border-bottom">
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="separator-solid"></div>
                                        <div class="form-group">
                                            <textarea name="companyAbout" class="form-control" id="comment" rows="5">{{$CompanyInfo['companyAbout']}}</textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon3">Phone 1</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="companyPhone1" name="companyPhone1" value="{{$CompanyInfo['companyPhone1']}}" aria-describedby="basic-addon3">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon3">Phone 2</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="companyPhone2" name="companyPhone2" value="{{$CompanyInfo['companyPhone2']}}" aria-describedby="basic-addon3">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon3">Email</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="companyEmail" name="companyEmail" value="{{$CompanyInfo['companyEmail']}}" aria-describedby="basic-addon3">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon3">Star Count</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="companyStar" name="companyStar" value="{{$CompanyInfo['companyStar']}}" aria-describedby="basic-addon3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon3"><i class="flaticon-facebook"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="facebookURL" name="facebookURL" value="{{$CompanyInfo['facebookURL']}}" aria-describedby="basic-addon3">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon3"><i class="flaticon-instagram"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="instaURL" name="instaURL" value="{{$CompanyInfo['instaURL']}}" aria-describedby="basic-addon3">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon3"><i class="flaticon-internet"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="websiteURL" name="websiteURL" value="{{$CompanyInfo['websiteURL']}}" aria-describedby="basic-addon3">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save</button>

                                    </div>
                                </div>
                            </form>
						</div>
                        <div class="col-md-5">
                        <div class="card card-round">
								<div class="card-body">
									<div class="card-title fw-mediumbold">Company Services</div>
									<div class="card-list">
                                    @foreach ($services as $service) 
										<div class="item-list">
											<div class="avatar">
												<img src="{{asset('images').'\\'.$service->image}}" alt="..." class="avatar-img">
											</div>
											<div class="info-user ml-3">
												<div class="username">{{$service->title}}</div>
											</div>
                                            <form action="{{route('service.destroy')}}" method="post">
                                                @csrf
												<input type="hidden" name="id" value="{{$service->id}}" >
                                                <button type="submit" class="btn btn-icon btn-danger btn-round btn-xs">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
										</div>
                                    @endforeach
									</div>
								</div>
							</div>
                        </div>
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