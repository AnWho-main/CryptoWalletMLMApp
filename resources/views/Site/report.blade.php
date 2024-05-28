@extends('Site.master')
@section('title','Search?')
@section('sitecontent')
@php
$org = \AppHelper::instance()->orgProfile();
@endphp


<script src="{{ asset('custome/activity.js')}}"></script>
<!-- Page Content Start -->
<div class="page-content">

    <!-- Banner  -->
    <div class="dz-bnr-inr style-1 text-center">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>Search Report</h1>

                <!-- Breadcrumb Row -->
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                    </ul>
                </nav>
                <!-- Breadcrumb Row End -->
            </div>
        </div>
        <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
        <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
        <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
        <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
    </div>
    <!-- Banner End -->


    <!-- About Box style -1 start  -->
    <section class="content-inner about-sec bg-primary-light" style="background-image: url(images/background/bnr.png);">
        <div class="container">
            <div class="row about-bx2 style-1 align-items-center">

                <div class="col-xl-12 col-lg-12">
                    <aside class="side-bar sticky-top right">
                        <div class="widget">

                            <div class="search-bx">
                            <form  action="{{ route('site-report') }}" method="POST">
                                @csrf
                                    <div class="input-group">
                                        <div class="input-skew">
                                            <input name="rid" class="form-control" placeholder="Search Id.." type="text" value="{{ request()->get('rid') }}" required>
                                        </div>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary sharp radius-no"><i class="fa-solid fa-magnifying-glass scale3"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                     </div>
                     <h3 class="title" style="text-align: center;">Income Reports</h3>
                               <div class="col-xl-12">
                               @if(!empty($repo))
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row" >
                                             
                                                @foreach($repo as $key => $value)
                                                <div class="col-sm-3" >
                                                    <div class="card card-box bg-primary" >
                                                        <div class="card-header"  style="background-color: #CCEFFF; color: black;" >
                                                            <div class="chart-num-days" >
                                                                <p>
                                                                    {{$key}}
                                                                </p>
                                                                <h2 class="count-num text-black">${{$value}}</h2>
                                                            </div>
                                                            <!-- <i style="font-size:50px; color:#E6DCFE;" class="fas fa-dollar-sign"></i> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            

                                                <div class="col-sm-3">
                                                    <div class="card card-box bg-success">
                                                        <div class="card-header "  style="background-color: #CCEFFF; color: black;" >
                                                            <div class="chart-num-days">
                                                                <p>
                                                                    Main Wallet
                                                                </p>
                                                                <h2 class="count-num text-black">${{$nds->mainwallet}}</h2>
                                                            </div>
                                                            <!-- <i style="font-size:50px; color:white;" class="fas fa-credit-card"></i> -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="card card-box bg-warning">
                                                        <div class="card-header "  style="background-color: #CCEFFF; color: black;"> 
                                                            <div class="chart-num-days">
                                                                <p>
                                                                    Hold Wallet
                                                                </p>
                                                                <h2 class="count-num text-black">${{$nds->boostingwallet}}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="card card-box bg-info">
                                                        <div class="card-header "  style="background-color: #CCEFFF; color: black;">
                                                            <div class="chart-num-days">
                                                                <p>
                                                                    Total Withdrawals
                                                                </p>
                                                                <h2 class="count-num text-black">${{round($tom,2)}}</h2>
                                                            </div>
                                                            <!-- <i style="font-size:50px; color:white;" class="fas fa-bank"></i> -->
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                       
                 
                </div>
            </div>
        </div>

        <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
        <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
        <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
        <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
    </section>
    <!-- About Box style -1 end  -->

    <!--Our mission section start -->
    <section class="content-inner about-sec bg-primary-light" style="background-image: url(images/background/bnr.png);">
        <div class="container">
        
            <div class="">
             
                    <div class="col-lg-12 about-content ps-lg-5 m-b30 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="dz-bnr-inr-entry text-center">
                            <h3 class="title">Member Information</h3>
                            <div class="col-lg-12">
                                @if(!empty($memDirectRepo))
                                <div class="card">
                                    <div class="card-header">

                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table primary-table-bg-hover">
                                                <thead>


                                                    <tr class="table-info">
                                                        <td>Total Direct Member</td>
                                                        <td>{{$memDirectRepo[0]}} members</td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="table-info">

                                                        <td>Total Direct Active</td>
                                                        <td>{{$memDirectRepo[1]}} members</td>

                                                    </tr>
                                                    <tr class="table-info">

                                                        <td>Total Direct InActive</td>
                                                        <td>{{$memDirectRepo[2]}} members</td>

                                                    </tr>




                                                </tbody>
                                            </table>
                                        </div>




                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table primary-table-bg-hover">
                                                <thead>
                                                    <tr class="table-info">
                                                        <td>Total member in month</td>
                                                        <td>{{$memRepo[3]}} members</td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="table-info">

                                                        <td>Active in month </td>
                                                        <td>{{$memRepo[4]}} members</td>

                                                    </tr>
                                                    <tr class="table-info">

                                                        <td>Inactive in month</td>
                                                        <td>{{$memRepo[5]}} members</td>

                                                    </tr>




                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table primary-table-bg-hover">
                                                <thead>
                                                    <tr class="table-info">
                                                        <td>Total Team</td>
                                                        <td>{{$memRepo[0]}} members</td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="table-info">

                                                        <td>Total Team Active</td>
                                                        <td>{{$memRepo[1]}} members</td>

                                                    </tr>
                                                    <tr class="table-info">

                                                        <td>Total Team InActive</td>
                                                        <td>{{$memRepo[2]}} members</td>

                                                    </tr>




                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
            
            </div>
        </div>
        <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
        <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
        <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
        <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
    </section>
    <!-- Our mission section End -->

    <!-- Blog Grid Starts -->
    <section class="content-inner" id="management">
        <div class="container">
            <div class="dz-bnr-inr-entry text-center">
                <h1 class="text text-primary">Account Summary</h1>
                <!-- <p class="text">Awesome Team</p> -->
              
            </div>
            <div class="col-lg-12">
            @if(!empty($nds))
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table header-border" style="min-width: 500px;">
                                <thead>
                                    <tr class="table-active">
                                        <th>Name</th>
                                        <td>@if(!empty($nds->m_name)) {{$nds->m_name}} @else N/A  @endif</td>
                                        <th>Wallet Address</th>
                                        @php
                                            $yourString = $nds->userWalletAddress;
                                            $startIndex = floor(strlen($yourString) / 2) - 2;
                                            $removedCharacters = substr($yourString, $startIndex, 4);
                                        @endphp
                                        <td>0x...{{$removedCharacters}}...  <i class="fa fa-clone" aria-hidden="true"
                                        onclick="setClipboard('{{$nds->userWalletAddress}}')"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                    <tr class="table-primary">
                                        <th>Registration</th>
                                        <td>@if(!is_null($nds->cjoin)){{date('d-m-Y H:i:s',
                                    strtotime($nds->created_at));}}@else 00-00-0000 00:00:00 @endif</td>
                                        <th>Activation</th>
                                        <td>@if(!is_null($nds->activedate)){{date('d-m-Y H:i:s',
                                    $nds->activation_time);}}@else 00-00-0000 00:00:00 @endif</td>
                                    </tr>
                                    <tr class="table-warning">
                                        <th>Boosting</th>
                                        <td>@if(!empty($cbt->created_at)){{date('d-m-Y H:i:s',
                                    strtotime($cbt->created_at));}}@else 00-00-0000 00:00:00 @endif</td>
                                        <th>Current Package</th>
                                        <td>@if($nds->currentPack < 0 ) None @else Pack {{$nds->currentPack }} @endif</td>
                                    </tr>
                                    <tr class="table-danger">
                                        <th>Boosting</th>
										<td >  @if($pack[1] != 0) Boost {{$pack[1]}} @else
                					    No boosting found
                  						  @endif</td>
                                        <th>Boosting Pending</th>
                                        <td> @if($pack[3] != 0) Boost {{$pack[3]}} @else
                					    No boosting found
                  						  @endif</td>
                                    </tr>
                                    <tr class="table-info">
										<th>Boosting Received</th>
										<td  >  @if($pack[2] != 0) Boost {{$pack[2]}} @else
                					    No boosting found
                  						  @endif</td>
                                         <th>Sopnsor ID </th>
										<td>{{$nds->cintro}}</td>
									</tr>	
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
</div>
</div>

</section>
<!-- blog grid code starts from here -->


<!-- WhitePaper box -1 start  -->
<section class="content-inner about-sec " style="background-image: url(images/background/bnr.png);">
    <div class="container">
    <div class="dz-bnr-inr-entry text-center">
            <div class="col-lg-12 col-xl-12">
                <div class="table-responsive">
                    <table class="table header-border" style="min-width: 500px;">
                        <div class="">
                            <h4 class="card-title">Recent Transactions</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table primary-table-bg-hover">
                                    <thead>
                                        <tr class="table-primary">
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
                                    @if(!empty($trans))
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
                                    <tr class="table-info">
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
        </div>

    </div>
    <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
    <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
    <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
    <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
</section>
<!-- Recent transaction -1 end  -->

<section class="content-inner about-sec " style="background-image: url(images/background/bnr.png);">
    <div class="container">
    <div class="dz-bnr-inr-entry text-center">
            <div class="col-lg-12 col-xl-12">
                <div class="table-responsive">
                    <table class="table header-border" style="min-width: 500px;">
                        <div class="">
                            <h4 class="card-title">Recent withdrawals</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table primary-table-bg-hover">
                                    <thead>
                                        <tr class="table-primary">
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
                                    @if(!empty($withdraws))
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

									<tr class="table-info">
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
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>
    <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
    <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
    <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
    <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
</section>

<!-- Page Content End -->
@endsection