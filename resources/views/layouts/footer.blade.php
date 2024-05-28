	
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer out-footer">
            <div class="copyright">
               <p>Copyright © <a href="{{route('index')}}" target="_blank"> {{$org['organization_name']}}</a></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
   <!-- Required vendors -->
    <script src="{{ asset(config('app.member_folder').'/vendor/global/global.min.js')}}"></script>
	<script src="{{ asset(config('app.member_folder').'/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<script src="{{ asset(config('app.member_folder').'/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
	
	<!-- Apex Chart -->
	<script src="{{ asset(config('app.member_folder').'/vendor/apexchart/apexchart.js')}}"></script>
	<script src="./vendor/swiper/js/swiper-bundle.min.js"></script>
	<script src="https://s3.tradingview.com/tv.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
	<script src="{{ asset(config('app.member_folder').'/vendor/raphael/raphael.min.js')}}"></script>
	<script src="{{ asset(config('app.member_folder').'/vendor/morris/morris.min.js')}}"></script>
	
	<!-- Dashboard 1 -->
	<script src="{{ asset(config('app.member_folder').'/js/dashboard/dashboard-1.js')}}"></script>
    <script src="{{ asset(config('app.member_folder').'/js/custom.js')}}"></script>
	<script src="{{ asset(config('app.member_folder').'/js/deznav-init.js')}}"></script>
	<script src="{{ asset(config('app.member_folder').'/js/dashboard/tradingview-2.js')}}"></script>
	

    <!-- daterangepicker -->
<script src="{{ asset(config('app.member_folder').'/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset(config('app.member_folder').'/plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{ asset('custome/activity.js')}}"></script>
	<script>
		jQuery(document).ready(function(){
			setTimeout(function(){
				dzSettingsOptions.version = 'dark';
				new dzSettings(dzSettingsOptions);
			},1500)
		});
	</script>
</body>
</html>