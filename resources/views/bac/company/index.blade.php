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
                    <a href="#">Companies</a>
                </li>
            </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">Add Company</h4>
						<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
							<i class="fa fa-plus"></i>
							Add Company
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
										New Company
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p class="small">Create a new row using this form, make sure you fill them all</p>
                                    
									<form action="{{route('company.add')}}" method="post" enctype="multipart/form-data">
                                        @csrf
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Company Name</label>
													<input required id="companyName" type="text" class="form-control" name="companyName" placeholder="fill companyName">
												</div>
											</div>
                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>About</label>
													<textarea required class="form-control" id="companyAbout" rows="6" name="companyAbout" spellcheck="false" data-gramm="false"></textarea>
												</div>
											</div>
											<div class="col-md-12 pr-0">
												<div class="form-group form-group-default">
													<label>Address</label> 
													<input required id="companyAddress" type="text" class="form-control" name='companyAddress' placeholder="fill companyAddress">
												</div>
											</div>

                                            <div class="col-md-12 pr-0">
												<div class="form-group form-group-default">
													<label>Phone 1</label> 
													<input required id="companyPhone1" type="text" class="form-control" name='companyPhone1' placeholder="fill companyPhone1">
												</div>
											</div>

                                            <div class="col-md-12 pr-0">
												<div class="form-group form-group-default">
													<label>Phone 2</label> 
													<input required id="companyPhone2" type="text" class="form-control" name='companyPhone2' placeholder="fill companyPhone2">
												</div>
											</div>

                                            <div class="col-md-12 pr-0">
												<div class="form-group form-group-default">
													<label>Email</label> 
													<input required id="companyEmail" type="text" class="form-control" name='companyEmail' placeholder="fill companyEmail">
												</div>
											</div>

											<div class="col-md-12 pr-0">
												<div class="form-group form-group-default">
													<label>Star Count</label> 
													<input required id="companyStar" type="text" class="form-control" name='companyStar' placeholder="fill Star Count">
												</div>
											</div>

                                            <div class="col-md-12 pr-0">
												<div class="form-group form-group-default">
													<label>Web Url</label> 
													<input required id="websiteURL" type="text" class="form-control" name='websiteURL' placeholder="fill websiteURL">
												</div>
											</div>

                                            <div class="col-md-12 pr-0">
												<div class="form-group form-group-default">
													<label>Facebook</label> 
													<input required id="facebookURL" type="text" class="form-control" name='facebookURL' placeholder="fill facebookURL">
												</div>
											</div>

                                            <div class="col-md-12 pr-0">
												<div class="form-group form-group-default">
													<label>Instagram</label> 
													<input required id="instaURL" type="text" class="form-control" name='instaURL' placeholder="fill instaURL">
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

					<div class="row">
					@foreach ($companies as $company) 
						<div class="col-md-4">
							<a href="/adminCompanyDetail/{{$company->id}}">
								<div class="card card-secondary" >
									<div class="card-body bubble-shadow">
										<h1>{{$company->companyName}}</h1>
										<h5 class="op-8">{{$company->companyAddress}}</h5>
										<div class="pull-right">
											<h3 class="fw-bold op-8">{{$company->companyStar}} Stars</h3>
										</div>
									</div>
								</div>
							</a>
						</div>
					@endforeach
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