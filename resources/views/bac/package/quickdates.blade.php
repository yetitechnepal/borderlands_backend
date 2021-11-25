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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Quick Dates</a>
                </li>
            </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<h4 class="card-title">Add Quick Dates</h4>
						<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
							<i class="fa fa-plus"></i>
							Add Quick Dates
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
										New Quick Dates
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p class="small">Create a new row using this form, make sure you fill them all</p>
									<form action="{{route('quickdates.add')}}" method="post" enctype="multipart/form-data">
                                        @csrf
										<input type="hidden" name="id" value="{{$PackageInfo['id']}}">
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Start Date</label>
													<input required id="quickdate" type="date" class="form-control" name='stdate' placeholder="quickdate">
												</div>
											</div>

                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
                                                    <label>End Date</label>
													<input required id="quickdate" type="date" class="form-control" name='enddate' placeholder="quickdate">
												</div>
											</div>

                                            <div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Rate</label>
													<input required id="rate" type="number" class="form-control" name='rate' placeholder="rate">
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

                    <div class="card-body row">
                            @foreach ($quickdates as $quickdate) 
                            <div class="card-list col-md-2">
                                <div class="item-list " style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding-right:10px" >
                                    <div class="info-user ml-3">
                                        <div class="username">Date : {{date("d-M-y", strtotime($quickdate->stdate))." to ".date("d-M-y", strtotime($quickdate->enddate))}}</div>
                                        <div class="status">Days   :<?php 
                                        $datetime1 = new DateTime($quickdate->stdate);
                                        $datetime2 = new DateTime($quickdate->enddate);
                                        $interval = $datetime1->diff($datetime2);
                                        $days = $interval->format('%a');
                                        echo $days." Days ".($days-1)." Nights";
                                        ?></div>
                                        <div class="status">Rate: {{$quickdate->rate}}\per person</div>
                                        <div class="status"></div>
                                    </div>
                                    <form action="{{route('quickdates.destroy')}}" method="post">
										@csrf
										<input type="hidden" name="id" value="{{$quickdate->id}}" >
										<button type="submit" class="btn btn-icon btn-danger btn-round btn-xs">
                                            <i class="fa fa-trash"></i>
                                        </button>
									</form>
                                    
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

@endsection