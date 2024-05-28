        <!--**********************************
            Sidebar start
        ***********************************-->

		<style>
        /* Styles for the loader container */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Styles for the loader */
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
        }
        .loader-container h2 {
             color: white;
         }

        /* Animation for the loader */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

		    <!-- Loader container -->
			<div style="display: none;" class="loader-container" id="loaderContainer">
				<h2>Please wait--</h2>
				<div class="loader"></div>
				</div>

        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
					<li><a href="{{route('member-dashboard')}}" aria-expanded="false">
							<i class="material-icons">grid_view</i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="material-icons">person</i>	
							<span class="nav-text">Profile</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{route('member-showProfile')}}">Display</a></li>
							<li><a href="{{route('member-editprofile')}}">Update</a></li>	
						</ul>
					</li>
					<li><a  href="{{route('member-editKYC')}}" aria-expanded="false">
							<i class="material-icons">app_registration</i>	
							<span class="nav-text">Update KYC</span>
						</a>
					</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="material-icons">assessment</i>	
							<span class="nav-text">Business</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{route('member-planChart')}}">Our Plan</a></li>
							<li><a href="{{ route('member-welcome')}}" target="_blank">Welcome</a></li>	
						</ul>
					</li>
					<li><a class="" href="{{route('member-buy-package','package')}}" aria-expanded="false">
						<i class="material-icons"> account_balance_wallet </i>
						<span class="nav-text">Buy Package</span>
						</a>
					</li>
					<li><a class="" href="{{route('member-buy-package','boosting')}}" aria-expanded="false">
						<i class="material-icons"> speed </i>
							<span class="nav-text">Buy Boosting</span>
						</a>
					</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							
							<i class="material-icons"> network_wifi </i>
							<span class="nav-text">My Network</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{route('member-search-myDirect')}}">Direct Network</a></li>
							<li><a href="{{route('member-search-downlineList')}}">Downline list</a></li>
							<li><a href="{{route('member-network-explore')}}">Network Explorer</a></li>
						</ul>
					</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="material-icons"> attach_money </i>
							<span class="nav-text">Income</span>
						</a>
						<ul aria-expanded="false">
						@foreach(config('global.incomeTypesArray') as $key => $value)
							<li><a href="{{ asset(config('app.member_folder').$value[2]) }}">{{ $value[1] }}</a></li>
							@endforeach 
						</ul>
					</li>
					<li><a href="{{route('member-transaction')}}" class="" aria-expanded="false">
					<i class="material-icons"> swap_horiz </i>
							<span class="nav-text">Transactions</span>
						</a>
					</li>
					<li><a class="" href="{{route('member-search-withdrawals')}}" aria-expanded="false">
							<i class="material-icons"> payment </i>
							<span class="nav-text">Withdrawals</span>
						</a>
					</li>
					<li><a class="" href="{{route('member-search-listTicket')}}" aria-expanded="false">
							<i class="material-icons"> contact_support </i>
							<span class="nav-text">Support</span>
						</a>
					</li>
				</ul>
				
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->