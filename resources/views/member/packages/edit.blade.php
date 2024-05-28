@extends('layouts.main')
@php
$org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'].' | Buy '.$type)
@section('content')
<!-- web3 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.2.7-rc.0/web3.min.js"></script>

<div class="app-main__inner">
<!-- js suite -->
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css"/>

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
    $(document).ready(function() {
        $('#myForm').submit(async function(event) {
        event.preventDefault(); 

        const rsid = document.getElementById("sid").value;
        if(rsid == 1){
          alert("Boosting not allowed on CompanyID");
          return;
        }
        
        const pack = document.getElementById("pack").value;
        const uadr = document.getElementById("uadr").value;
        const adr = document.getElementById("wadr").value;
        const tokenBal = document.getElementById("token").value;
        const coinBal = document.getElementById("coin").value;
        const tobal = document.getElementById("token").value;
        const type = document.getElementById("pag").value;
        const aAddress = document.getElementById("aadr").value;
        const cost = pack.split('-'); 
        const pcost = cost[1];
        const pname = cost[0];
        
        if(pack == "" || uadr=="" || adr== ""){
            alert("All fields are required!!");
        }else{
            if(coinBal > 0.001){

                if(parseFloat(pcost) > parseFloat(tokenBal)){
                    alert("Insufficient token balance to make transaction");
                }else{
                    const el = document.getElementById("submit");
                    el.style.display= "none";

                    const ele = document.getElementById("load");
                    ele.style.display= "block";
                    showLoader(); 
                  

                    // alert(pcost);
                    // alert(uadr);
                    // alert(aAddress);

                    let txid = await trans3(pcost,uadr,aAddress);
                
                    var txnid = txid;
                    
                    if(txnid != -1){
                
                        if(type == "package"){
                            $.ajax({
                            url: '{{ route('member.pack.buy') }}', 
                            type: 'POST',
                            data: {
                            uadr: uadr,
                            pack: pack,
                            txnid: txnid,
                            _token: $("input[name=_token]").val()
                            },
                            success:function(response){
                            // alert("Trans Done");
                            hideLoader();
                                const el = document.getElementById("submit");
                                el.style.display= "block";
                                const ele = document.getElementById("load");
                                ele.style.display= "none";
                                jSuites.notification({
                                name: 'Congratulations...',
                                message: 'Package purchase successfully! Reloading Page!!',
                                })
                                    
                                setTimeout(function () {location.reload(true); }, 5000);      
                                }
                            });
                        }
            
                        if(type == "boosting"){
                
                            $.ajax({
                                url: '{{ route('member.boost.buy') }}', 
                                type: 'POST',
                                data: {
                                    uadr: uadr,
                                    pack: pack,
                                    txnid: txnid,
                                    _token: $("input[name=_token]").val()
                                },
                                success:function(response){
                                // alert("Trans Done");
                                    hideLoader();
                                    const el = document.getElementById("submit");
                                    el.style.display= "block";
                        
                                    const ele = document.getElementById("load");
                                    ele.style.display= "none";
                                    
                                    jSuites.notification({
                                        name: 'Congratulations...',
                                        message: 'Boosting done successfully! Reloading Page!!',
                                    })
                                    setTimeout(function () {location.reload(true); }, 5000);      
                                }
                            });
                        }
                
                    }
                }
            }else{
                alert("Insufficient BNB balance to make transaction");
            }
        }
     });  
 });

</script>


<div class="content-body">
    <div class="container-fluid">
        <div class="row">

        <div class="col-xl-12 col-lg-12">
						<div class="card profile-card card-bx m-b30">
							<div class="card-header">
								<h6 class="title">Buy {{$type}}</h6>
                                <button class="btn btn-primary" style="float: right;" onClick="re();">Reset</button>
							</div>
							<form class="profile-form" id="myForm" method="post" enctype="multipart/form-data">
                                    @csrf
                               
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12 m-b30">
											<label class="form-label">Packages</label>
                                            <input name="aadr" id="aadr"
                                    placeholder="aadr" type="hidden" value="{{$aAddress->wallet_address_in}}" class="form-control" readonly="">
                                <input name="txnid" id="txnid"
                                    placeholder="user address" type="hidden" value="" class="form-control" readonly="">
                                    <input name="sid" id="sid"
                                    placeholder="user sid" type="hidden" value="{{ Session::get('userID')}}" class="form-control" readonly="">
                                    <select class="form-control" id="pack" name="pack" required>
                                    <option value="">Select here</option>
                                    @foreach($upd as $pd)
                                    @if($pd->fk_cid == 1 && $type == "package")
                                    @if($pack->current_package+1 == $pd->prod_id)
                                    <option value="{{$pd->prod_id}}-{{$pd->cost}}" >{{$pd->product_name}} - {{$pd->cost}}USDT</option>
                                    @else
                                    <option value="{{$pd->prod_id}}-{{$pd->cost}}" disabled>{{$pd->product_name}} - {{$pd->cost}}USDT</option>
                                    @endif
                                    @endif
                                    @if($pd->fk_cid == 2 && $type == "boosting")
                                    
                                    @if($boost < $boostLimit && $pack->current_package >= 1)
                              
                                    <option value="{{$pd->prod_id}}-{{$pd->cost}}">{{$pd->product_name}} - {{$pd->cost}}USDT</option>
                               
                                    @else
                                    <option value="{{$pd->prod_id}}-{{$pd->cost}}" disabled>{{$pd->product_name}} - {{$pd->cost}}USDT</option>
                                    @endif
                                     
                                    @endif
                                    @endforeach
                                   </select>

										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">User Address</label>
                                            <input name="uadr" id="uadr"
                                    placeholder="user address" type="text" value="{{ Session::get('loginAddress')}}" class="form-control" readonly="">
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Wallet Address</label>
                                            <input name="wadr" id="wadr"
                                    placeholder="wallet address" type="text" class="form-control" readonly="">
                                    <p id="mmsg" style="color: red; display: none;">Wallet address is not matched with user address</p>
										</div>

                                        <div class="col-sm-12 m-b30">
											<label class="form-label">Company Address</label>
                                            <input name="inadr" id="inadr" value="{{$aAddress->wallet_address_in}}"
                                    placeholder="company wallet address" type="text" class="form-control" readonly="">
                                   
										</div>

                                        <h5>Balance</h5>
										<div class="col-sm-6 m-b30">
											<label class="form-label">BNB &nbsp
                                            <span><img src="{{ asset(config('app.member_folder').'/images/pack/bnbcoin.png') }}" alt="coin" height="8%" width="8%"/></span></label>
                                            <input name="pag" id="pag"
                                            placeholder="page type" type="hidden" class="form-control" value="{{$type}}" readonly="">
                                            <input name="coin" id="coin"
                                            placeholder="coin balance" type="text" class="form-control" readonly="">
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">USDT(BEP20) &nbsp
                                            <span><img src="{{ asset(config('app.member_folder').'/images/pack/usdttoken.png') }}" alt="token" height="8%" width="8%"/></span></label>
                                            <input name="token" id="token" value="" 
                                            placeholder="token balance" type="text" class="form-control" readonly="">
										</div>
										
									</div>
								</div>
								<div class="card-footer">
                                <input id="submit"  class="mt-2 btn btn-primary" type="submit" value="Buy">
                            <img src="{{ asset(config('app.member_folder').'/images/pack/loader.gif') }}" id="load" style="display: none;" name="load" height="8%" width="8%" alt="loading...." />
								</div>
							</form>
						</div>
					</div>

        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset(config('app.member_folder').'/assets/scripts/wallet.js') }}"></script>

<script>
 document.addEventListener("DOMContentLoaded", function(event) {
  pconnect();
});
</script>

@endsection