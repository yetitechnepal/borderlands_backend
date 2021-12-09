@extends('bac.index')

@section('content')

<div>
    <script>
        function runReport(stdate,enddate,status,company){
            if (stdate.length == 0 || enddate.length == 0) {
                alert('please select date range');
            }else{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // document.getElementById("txtHint").innerHTML = this.responseText;
                    var jsonResponse = JSON.parse(this.responseText);
                    const items = [];
                    items.push(jsonResponse.data.orderList);
                    
                    var resp = "";
                    var totalBill = 0;
                    var totalCount = 0;

                    console.log(items[0].length);

                    for (var i=0; i < items[0].length; i++) {
                        totalCount = totalCount + 1;
                        totalBill = totalBill + items[0][i].billedAmount; 
                        resp = resp + "<tr> <td>"+(i+1)+"</td> <td>"+items[0][i].companyName+"</td> <td>"+items[0][i].name+"</td> <td>"+items[0][i].phone+"</td> <td>"+items[0][i].title+"<br>"+items[0][i].stdate+"<br>"+items[0][i].enddate+"</td> <td>"+items[0][i].billedAmount+"</td> <td>"+items[0][i].transctionId+"</td> <td>"+items[0][i].status+"</td> </tr>";
                    }

                    resp = resp + "<tr> <td></td> <td>Count</td> <td>"+totalCount+"</td> <td></td> <td>Total Billed</td> <td>"+totalBill+"</td> <td></td> <td></td> </tr>";

                    document.getElementById("res").innerHTML = resp;

                }
                };
                // var mydate = new Date('2014-04-03');
                xmlhttp.open("GET", "/getOrderList/" + stdate + "/" + enddate + "/" + status + "/" + company, true);
                xmlhttp.send();
            }
        }
    </script>
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
                    <a href="/report">Report</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Order Report</a>
                </li>
            </ul>
    </div>

    <div class="card" >
		<!-- <form action=""> -->
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Start Date</span>
                            </div>
                            <input type="date" class="form-control" id="companyStar" name="stdate" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">End Date</span>
                            </div>
                            <input type="date" class="form-control" id="companyStar" name="enddate" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Status</span>
                            </div>
                            <select class="form-control form-control" name="status">
								<option value="completed">completed</option>
								<option value="cancelled">cancelled</option>
								<option value="pending">pending</option>
							</select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Company</span>
                            </div>
                            <select class="form-control form-control" name="company">
                            @foreach ($companies as $company) 
							    <option value="{{$company->id}}"  >{{$company->companyName}}</option>
                            @endforeach
							</select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary" style="margin:10px;" 
                        onclick="
                                    runReport(document.getElementsByName('stdate')[0].value,
                                    document.getElementsByName('enddate')[0].value,
                                    document.getElementsByName('status')[0].value,
                                    document.getElementsByName('company')[0].value,

                                )">Run</button>
                </div>
            </div>
        <!-- </form> -->
	</div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
				<div class="card-body">
                    <table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Company</th>
								<th scope="col">Client Name</th>
								<th scope="col">Contact</th>
								<th scope="col">Package</th>
								<th scope="col">Bill Amount</th>
								<th scope="col">Code</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody id="res">
							
						</tbody>
					</table>
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