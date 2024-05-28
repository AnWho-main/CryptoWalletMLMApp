@extends('layouts.main')
@php
$org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'].' | Member Dashboard')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.2.7-rc.0/web3.min.js"></script>

<script type="text/javascript" src="{{ asset(config('app.member_folder').'/assets/scripts/wallet.js') }}"></script>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-xl-12">
						<div class="card bubles">
							<div class="card-body">
								<div class="buy-coin  bubles-down">
									<div>
										<h2>Welcome to I-Techniques Family</h2>
										<p>Our platform offers a collaborative ecosystem where users engage, transact
											securely, and earn rewards.</p>
										<a href="{{route('member-buy-package','package')}}" class="btn btn-primary">Buy
											Pack</a>
									</div>
									<div class="coin-img">
										<img src="images/coin.png" class="img-fluid" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>

				{{--<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div id="tradingview_85dc0" class="tranding-chart"></div>
							</div>
						</div>
					</div>--}}	

					<div class="col-xl-12">
						<div class="card bubles">
							<div class="card-body">
								<div class="callout callout-info">
									<h4>Your Share Link is here</h4>
									<input type="text" value="{{ asset('/member/registration/'.Session::get('loginID'))}}" id="myInput"
										class="form-control" style="color: white;" />
									<button onclick="myFunction()" class="btn btn-warning waves-effect">Copy
										Link</button>
									<a style="margin-left: 10px; margin-bottom: 15px; margin-top: 15px;" href="{{ asset('/member/registration/'.Session::get('loginID'))}}"
										class="btn btn-success waves-effect" target="_blank">New Joining</a>
									&nbsp
                                   {{--
									<a href=""><i class="fab fa-whatsapp btn btn-success"></i></a>
									<a href=""><i class="fab fa-facebook-f btn btn-success"></i></a>
									<a href=""><i class="fab fa-twitter btn btn-success"></i>
									</a>
									<a href=""><i class="fab fa-linkedin btn btn-success"></i></a> --}}
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>

		@if($nds->kyc_status == "" || $nds->kyc_status == "Rejected")
		<div class="col-md-12 col-xl-12">
			<div class="alert alert-danger alert-dismissible" role="alert">
				<marquee height="30px" width="100%">
					<p style="font-family: Impact; font-size: 18pt">Please update your KYC for withdrawal !</p>
				</marquee>
			</div>
		</div>
		@endif
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<div class="card-header ">
							<h3>Income Reporting</h3>
						</div>

						<div class="row">
							@foreach($repo as $key => $value)
							<div class="col-sm-4">
								<div class="card card-box bg-primary">
									<div class="card-header ">
										<div class="chart-num-days">
											<p>
												{{$key}}
											</p>
											<h2 class="count-num text-white">${{$value}}</h2>
										</div>
										<i style="font-size:50px; color:white;" class="fas fa-dollar-sign"></i>
									</div>
								</div>
							</div>
							@endforeach

							<div class="col-sm-4">
								<div class="card card-box bg-success">
									<div class="card-header ">
										<div class="chart-num-days">
											<p>
												Main Wallet
											</p>
											<h2 class="count-num text-white">${{$nds->mainwallet}}</h2>
										</div>
										<i style="font-size:50px; color:white;" class="fas fa-credit-card"></i>
									</div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="card card-box bg-warning">
									<div class="card-header ">
										<div class="chart-num-days">
											<p>
												Hold Wallet
											</p>
											 <input type="hidden"
												value="@if(!is_null($bpay) && $nds->boostingwallet != 0){{$bpay->created_at}} @else '00-00-0000' @endif"
												id="cend" />
											<h2 class="count-num text-white">${{$nds->boostingwallet}}</h2>
											<b class="widget-subheading" style="color: red; font-size: 11px;" id="timer"></b>
										</div>
										<i style="font-size:50px; color:white;" class="fas fa-credit-card"></i>
									</div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="card card-box bg-info">
									<div class="card-header ">
										<div class="chart-num-days">
											<p>
												Total Withdrawals
											</p>
											<h2 class="count-num text-white">${{round($tom,2)}}</h2>
											<p style="color: red;" >after 15% deduction</p>
										</div>
										<i style="font-size:50px; color:white;" class="fas fa-bank"></i>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="col-xxl-4 col-xl-4">
				<div class="card">
					<div class="card-body pt-0 px-0">
						<div class="table-responsive buy-sell-table">
							<table class="table">
								<tbody>
									<tr>
										<td style="font-size: 16px;">Total Direct Members</td>
										<td>
											<h1>{{$memDirectRepo[0]}}</h1>
										</td>
									</tr>
									<tr>
										<td style="font-size: 16px;">Direct Members <br>
											<span class="text-success">Active </span>
										</td>
										<td>
											<h1>{{$memDirectRepo[1]}}</h1>
										</td>
									</tr>
									<tr>
										<td style="font-size: 16px;"> Direct Members <br>
											<span class="text-danger">Inactive </span>
										</td>
										<td>
											<h1>{{$memDirectRepo[2]}}</h1>
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xxl-4 col-xl-4">
				<div class="card">
					<div class="card-body pt-0 px-0">
						<div class="table-responsive buy-sell-table">
							<table class="table">
								<tbody>
									<tr>
										<td style="font-size: 16px;">Total Team</td>
										<td>
											<h1>{{$memRepo[0]}}</h1>
										</td>
									</tr>
									<tr>
										<td style="font-size: 16px;">Team <br>
											<span class="text-success">Active </span>
										</td>
										<td>
											<h1>{{$memRepo[1]}}</h1>
										</td>
									</tr>
									<tr>
										<td style="font-size: 16px;"> Team <br>
											<span class="text-danger">Inactive </span>
										</td>
										<td>
											<h1>{{$memRepo[2]}}</h1>
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xxl-4 col-xl-4">
				<div class="card">
					<div class="card-body pt-0 px-0">
						<div class="table-responsive buy-sell-table">
							<table class="table">
								<tbody style="font-size:16px;">
									<tr>
										<td style="font-size: 16px;">Total Current Month</td>
										<td>
											<h1>{{$memRepo[3]}}</h1>
										</td>
									</tr>
									<tr>
										<td style="font-size: 16px;">Current Month <br>
											<span class="text-success">Active </span>
										</td>
										<td>
											<h1>{{$memRepo[4]}}</h1>
										</td>
									</tr>
									<tr>
										<td style="font-size: 16px;">Current Month<br>
											<span class="text-danger">Inactive </span>
										</td>
										<td>
											<h1>{{$memRepo[5]}}</h1>
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-7 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="heading">Account Summary</h4>
					</div>
					@php
                            $shortAddress = \AppHelper::instance()->shortAddress(Session::get('loginAddress'));
                            @endphp
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<tbody>
									<tr>
										<th>Name </th>
										<td>{{$nds->m_name}}</td>
									</tr>
									<tr>
										<th>Client ID </th>
										<td>{{ Session::get('loginID')}}</td>
									</tr>
									<tr>
										<th>Wallet Address </th>
										<td>{{$shortAddress}} <i class="fa fa-clone" aria-hidden="true"
                                        onclick="setClipboard('{{Session::get('loginAddress')}}')"></i></td>
									</tr>
									<tr>
										<th>Sopnsor ID </th>
										<td>{{$nds->cintro}}</td>
									</tr>
									<tr>
										<th>Registration </th>
										<td>@if(!is_null($nds->cjoin)){{date('d-m-Y H:i:s',
                                    strtotime($nds->created_at));}}@else 00-00-0000 00:00:00 @endif</td>
									</tr>
									<tr>
										<th>Activation </th>
										<td>@if(!is_null($nds->activedate)){{date('d-m-Y H:i:s',
                                    $nds->activation_time);}}@else 00-00-0000 00:00:00 @endif</td>
									</tr>
									<tr>
										<th>Boosting </th>
										<td>@if(!empty($cbt->created_at)){{date('d-m-Y H:i:s',
                                    strtotime($cbt->created_at));}}@else 00-00-0000 00:00:00 @endif</td>
									</tr>	
									<tr>
										<th>Current Package </th>
										<td style="color: green;">@if($nds->currentPack < 0 ) None @else Pack {{$nds->currentPack }} @endif</td>
									</tr>	
									<tr>
										<th>Boosting </th>
										<td  style="color: yellow;">  @if($pack[1] != 0) Boost {{$pack[1]}} @else
                					    No boosting found
                  						  @endif</td>
									</tr>	
									<tr>
										<th>Boosting Pending</th>
										<td  style="color: yellow;">  @if($pack[3] != 0) Boost {{$pack[3]}} @else
                					    No boosting found
                  						  @endif</td>
									</tr>	
									<tr>
										<th>Boosting Received</th>
										<td  style="color: #25D366;">  @if($pack[2] != 0) Boost {{$pack[2]}} @else
                					    No boosting found
                  						  @endif</td>
									</tr>	
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>

			<div class="col-xl-5 col-sm-6" style="height:500px;">
				<div class="card">
					<div class="card-header">
						<h4 class="heading">News & Events </h4>
					</div>
					<div class="card-body pt-0 px-0">
						<ul class="chat-list">
							<MARQUEE BEHAVIOR="SCROLL" SCROLLDELAY="50" scrollamount="1" direction="up"
								onmouseover=this.stop() onmouseout=this.start() height="280px" width="100%">
																<?php

								foreach($events as $eventlist)
								{
								$pDate = $eventlist->pub_date; 
								$vDate = $eventlist->val_date; 
								// $ExplodeDate = explode(" ", $Date);

								$cdate =date("Y-m-d");


								if($pDate <= $cdate && $vDate >= $cdate){
									if($eventlist->publish_status == 1){
								?>
											<li>
												<i class="fa fa-calendar "></i> {{ date('d-m-Y',strtotime($eventlist->pub_date));
												}}<br />
												<?php echo $eventlist->title;?>

												<br />
												<?php echo $eventlist->descp;?>
											</li>
											<?php }else{?>
											<li>
												<img src="@if($eventlist->info_img == null) \upload\nophoto.jpg  @else @if(!file_exists(public_path('/upload/useruploads/'.$eventlist->info_img))) \upload\nophoto.jpg  @else \upload\useruploads\{{$eventlist->info_img}} @endif  @endif"
													alt="events" height="70%" width="70%" />
											</li>
											<?php
											}
								}
								}
								?>
							</MARQUEE>
						</ul>

					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-12">
				<div class="card">
					<div class="card-header border-0 pb-0 d-block">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h3 class="heading">Recent Joinings</h3>
							</div>

						</div>
					</div>
					<div class="card-body pt-4 pb-0 height450 dz-scroll">
						<div class="contacts-list" id="RecentActivityContent">
						@if(!is_null($join))
                                    @php
                                    $i = 0;
                                    @endphp
                              @foreach($join as $jon)
							<div class="d-flex justify-content-between mb-3 mt-3 pb-3">
								<div class="d-flex align-items-center">
									<img src="@if($jon->photo == null) \upload\nouser.png  @else @if(!file_exists(public_path('/upload/useruploads/'.$jon->photo))) \upload\nouser.png  @else  {{config('app.folder_upload').$jon->m_photo}} @endif  @endif" alt="" class="avatar">
									<div class="ms-3">
										<h5 class="mb-1"><a class="text-secondary" href="app-profile.html">{{$jon->m_name}}</a></h5>
										<span class="fs-14 text-muted">{{$jon->client_id}}</span>
									</div>
								</div>
								<div class="icon-box icon-box-sm bg-primary-light">
									<a href="{{ asset('/member/registration/'.$jon->client_id)}}" target="blank">
										<svg xmlns="#" height="1em" viewBox="0 0 448 512">
											<path
												d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
										</svg>
									</a>
								</div>
							</div>
							@endforeach
                                    @endif
							
						</div>
					</div>
					<div class="card-footer border-0 pt-0">
						<div class="text-center border-0 pt-3">
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Recent Transactions</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-responsive-sm">
								<thead>
									<tr>
										<th>#</th>
										<th>Date</th>
										<th>Address</th>
										<th>TXN</th>
										<th>Amount</th>
										<th>Type</th>
										<th>Description</th>
									</tr>
								</thead>
								<tbody>
								@if(!is_null($trans))
									@php
									$i = 0;
									@endphp
									@foreach($trans as $rs)
									@php
									if(!empty($rs->wallet_address)){
									$sh = 1;
									$shortAddress = \AppHelper::instance()->shortAddress($rs->wallet_address);
									}else{
									$sh = 0;
									}
									@endphp

									<tr>
										<th>{{ ++$i }}</th>
										<td>  
											<div class="badge badge-warning">@if(!is_null($rs->created_at)){{ date('d-m-Y',strtotime($rs->created_at)); }}@else NA @endif</div></td>
										<td>@if($sh == 1){{ $shortAddress }} <i class="fa fa-clone"
                                    aria-hidden="true" onclick="setClipboard('{{$rs->wallet_address}}')"></i>@endif</span></td>
										<td>  @if(!empty($rs->txn_no))
                                &nbsp;&nbsp;
                                <a href="{{ config('global.TXNURL').$rs->txn_no }}" target="_blank">
                                    <i class="fa fa-link" aria-hidden="true" style="color:orange"></i>
                                </a>
                                @endif</td>
										<td>  <button type="button" id="PopoverCustomT-1"
                                    class="btn btn-info btn-sm">{{$rs->amount}}</button></td>
										<td>{{$rs->amount_type}}</td>
										<td>{{ $rs->message }}</td>
									</tr>
									@endforeach
							   @else
									<tr>
										<td colspan="20">No result found!</td>
									</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-12">
				<div class="card">
					<div class="card-header border-0 pb-0 d-block">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h3 class="heading">Achievers</h3>
							</div>

						</div>
					</div>
					<div class="card-body pt-4 pb-0 height450 dz-scroll">
						<div class="contacts-list" id="RecentActivityContent">
						@if(!is_null($achievers))
                                    @php
                                    $i = 0;
                                    @endphp
                              @foreach($achievers as $jon)
							<div class="d-flex justify-content-between mb-3 mt-3 pb-3">
								<div class="d-flex align-items-center">
									<img src="@if($jon->photo == null) \upload\nouser.png  @else @if(!file_exists(public_path('/upload/useruploads/'.$jon->photo))) \upload\nouser.png  @else  {{config('app.folder_upload').$jon->m_photo}} @endif  @endif" alt="" class="avatar">
									<div class="ms-3">
										<h5 class="mb-1"><a class="text-secondary" href="app-profile.html">{{$jon->m_name}}</a></h5>
										<span class="fs-14 text-muted">{{$jon->client_id}}</span>
									</div>
								</div>
								<div class="icon-box icon-box-sm bg-success">
								
										<svg xmlns="#" height="1em" viewBox="0 0 448 512">
											<path
												d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
										</svg>
									
								</div>
							</div>
							@endforeach
                                    @endif
							
						</div>
					</div>
					<div class="card-footer border-0 pt-0">
						<div class="text-center border-0 pt-3">
						</div>
					</div>
				</div>
			</div>

		
			<div class="col-xl-6 col-lg-6">
				
				<div class="card">
					<div class="card-header d-block">
						<h4 class="card-title">FAQS</h4>
					</div>
					<div class="card-body">
						<div class="accordion accordion-primary" id="accordion-one">
						@if(!is_null($faqs))
                @php
                $i = 0;
                @endphp
                @foreach($faqs as $faq)
							<div class="accordion-item">
								<div class="accordion-header collapsed  rounded-lg" id="heading{{$faq->id}}" data-bs-toggle="collapse"
									data-bs-target="#collapse{{$faq->id}}" aria-controls="collapse{{$faq->id}}" aria-expanded="true"
									role="button">
									<span class="accordion-header-icon"></span>
									<span class="accordion-header-text">{{$faq->title}}</span>
									<span class="accordion-header-indicator"></span>
								</div>
								<div id="collapse{{$faq->id}}" class="collapse" aria-labelledby="heading{{$faq->id}}"
									data-bs-parent="#accordion-one">
									<div class="accordion-body-text">
										{{$faq->description}}
									</div>
								</div>
							</div>
							@endforeach
							@endif

						</div>
						@php
						$originalString = $cdata->wallet_private_key;
						$last12Digits = substr($originalString, -12);
						$reversedLast12Digits = strrev($last12Digits);
						$mmodifiedString = substr_replace($originalString, $reversedLast12Digits, -12);
						@endphp
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Recent Withdrawals</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-responsive-sm">
								<thead>
									<tr>
										<th>#</th>
										<th>Date</th>
										<th>Address</th>
										<th>TXN</th>
										<th>Withdrawal Amount</th>
										<th>Type</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								@if(!is_null($withdraws))
									@php
									$i = 0;
									@endphp
									@foreach($withdraws as $rs)
									@php
									if(!empty($rs->wallet_address)){
									$sh = 1;
									$shortAddress = \AppHelper::instance()->shortAddress($rs->wallet_address);
									}else{
									$sh = 0;
									}
									@endphp

									<tr>
										<th>{{ ++$i }}</th>
										<td>  
											<div class="badge badge-warning">@if(!is_null($rs->created_at)){{ date('d-m-Y',strtotime($rs->created_at)); }}@else NA @endif</div></td>
										<td>@if($sh == 1){{ $shortAddress }} <i class="fa fa-clone"
                                    aria-hidden="true" onclick="setClipboard('{{$rs->wallet_address}}')"></i>@endif</span></td>
										<td>  @if(!empty($rs->txn_no))
                                &nbsp;&nbsp;
                                <a href="{{ config('global.TXNURL').$rs->txn_id }}" target="_blank">
                                    <i class="fa fa-link" aria-hidden="true" style="color:orange"></i>
                                </a>
                                @endif</td>
										<td>  <button type="button" id="PopoverCustomT-1"
                                    class="btn btn-info btn-sm">{{$rs->withdrawal_amount}}</button></td>
										<td>{{$rs->type_trans}}</td>
										<td>{{ $rs->status }}</td>
									</tr>
									@endforeach
							   @else
									<tr>
										<td colspan="20">No result found!</td>
									</tr>
									@endif
								</tbody>
							</table>
							@csrf
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
<!--**********************************
            Content body end
        ***********************************-->

<script>
    // Function to calculate and update the timer
    function updateTimer(endDate) {
        // Get the current date and time
        var now = new Date();

        // Parse the end date string into a Date object
        var endTime = new Date(endDate);

        // Calculate the time remaining in milliseconds
        var timeRemaining = endTime - now;

        // Check if the end date has passed
        if (timeRemaining <= 0) {
            document.getElementById("timer").innerHTML = "";
            return;
        }

        // Calculate days, hours, minutes, and seconds
        var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        // Update the timer display
        document.getElementById("timer").innerHTML = "Lost in " + days + "d " + hours + "h " + minutes + "m " + seconds + "s";
    }

    var endt = document.getElementById("cend").value;
    var result = endt;

    // Define the initial date
    var initialDate = new Date(result);

    var lt = parseInt(@json($cdata->boosting_laps_time));
    initialDate.setHours(initialDate.getHours() + lt);

    // Format the resulting date as a string
    var result = initialDate.toISOString();

    // Set the end date string in your desired format
    var endDateString = result;

    // Call the updateTimer function with the end date
    updateTimer(endDateString);

    // Update the timer every second
    setInterval(function () {
        updateTimer(endDateString);
    }, 1000);

</script>


<script>
	function myFunction() {
		var copyText = document.getElementById("myInput");
		copyText.select();
		document.execCommand("copy");
		alert("Copied the text: " + copyText.value);
	}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function showLoader() {
        document.getElementById('loaderContainer').style.display = 'flex';
    }
    function hideLoader() {
        document.getElementById('loaderContainer').style.display = 'none';
    }
</script>

<script>
    function store(txid) {
        var tlid = @json($ids[0]);
        var wlid = @json($ids[1]);
        $.ajax({
            url: '{{ route('member.withdraw.auto') }}',
            type: 'POST',
            data: {
                tlid: tlid,
                wlid: wlid,
                txnid: txid,
                _token: $("input[name=_token]").val()
            },
            success: function (response) {
                // alert("Withdraw Done");
                hideLoader();
                setTimeout(function () { location.reload(true); }, 2000);
            }
        });
    }
    async function withD(event) {
        const txid = await ddconnect(@json($amt), @json($nds->userWalletAddress), @json($cdata->wallet_address_out), @json($mmodifiedString));

        if (txid != -1 && txid != undefined) {
            store(txid);
        } else {
            hideLoader();
        }

    };

    if (@json($amt) != 0) {
        showLoader();
        withD();
    }   
</script>


@endsection