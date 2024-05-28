<!DOCTYPE html>
@php
$org = \AppHelper::instance()->orgProfile();     
@endphp
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CryptoZone : Crypto Trading Admin Bootstrap 5 Template">
    <meta property="og:title" content="CryptoZone  :Crypto Trading Admin Bootstrap 5 Template">
    <meta property="og:description" content="CryptoZone  :Crypto Trading Admin  Admin Bootstrap 5 Template">
    <meta property="og:image" content="https://cryptozone.dexignzone.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>{{$org['organization_name']}} | Member Panel Registration</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="@if($org['favicon'] == null) \upload\nophoto.jpg  @else @if(!file_exists(public_path('/upload/logo/'.$org['favicon']))) \upload\nophoto.jpg  @else \upload\logo\{{$org['favicon']}} @endif  @endif">
    <link href="{{ asset(config('app.member_folder').'/css/style.css')}}" rel="stylesheet">

      <!-- web3 -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.2.7-rc.0/web3.min.js"></script>
   
   <script type="text/javascript" src="{{ asset(config('app.member_folder').'/assets/scripts/wallet.js') }}"></script>
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="text-center mb-3">
                        <a href="/  "><img src="@if($org['logo'] == null) \upload\nophoto.jpg  @else @if(!file_exists(public_path('/upload/logo/'.$org['logo']))) \upload\nophoto.jpg  @else \upload\logo\{{$org['logo']}} @endif  @endif" alt="itechniques" height="60%"
                                width="60%"></a>
                    </div>
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                <div class="tronlogo">
                                    <h4 class="text-center mb-4">Registration</h4>
                                    <img src="{{ asset('upload/useruploads/TWT.png') }}" class="trust" alt="info" /></div><br />

                                    <div id="ralt" >Please login or Install <a href="https://trustwallet.com/" target="blank" >Trustwallet</a></div>

                                    <div class="reload "><button type="button" class="btn rbtn" onclick="re();">Reconnect</button></div><br/>
                                        <div id="adata" class="alert alert-primary">Not Connected to Wallet!</div>

                                        @if($errors->any())
                                           @foreach($errors->all() as $err)
                                           <h4>{{$err}}</h4>
                                           @endforeach
                                           @endif
                                           @if(Session::has('fail'))
                                           <div class="alert alert-warning">
                                          {{Session::get('fail')}}
                                          </div>
                                          @endif
                                          @if(Session::has('success'))
                                          <div class="alert alert-success rsuccess">{{Session::get('success')}}</div>
                                          @endif

                                    <form action="{{route('member-register')}}" method="POST">
                                    @csrf

                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Upline</strong></label>
                                            <input name="upline" id="upline" type="text" class="form-control" required placeholder="upline" value="@if(isset($upline)) {{$upline}} @endif">
                                        </div>

                                       <div class="mb-3">
                                            <label class="mb-1"><strong>Wallet Address</strong></label>
                                            <input name="address" id="adrdata" type="text" class="form-control" readonly="" placeholder="wallet address">
                                        </div>
                
                                        <div class="text-center mt-4">
                                            <button id="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="{{route('member-signin')}}" >Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset(config('app.member_folder').'/vendor/global/global.min.js')}}"></script>
    <script src="{{ asset(config('app.member_folder').'/js/custom.js')}}"></script>
    <script src="{{ asset(config('app.member_folder').'/js/deznav-init.js')}}"></script>
    <script>
        window.onload = function() {
        
            rconnect();
        };
        // const injectedProvider = window.ethereum;
        // injectedProvider.addListener("chainChanged", (id) => {
        // //   console.log(id); // => '0x1'
        // location.reload();
        // });
    </script>
</body>

</html>