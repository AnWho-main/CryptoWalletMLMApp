@php
$org = \AppHelper::instance()->orgProfile();   
@endphp  

   @include('layouts.header')
        @include('layouts.nav')

            @yield('content')
      
    @include('layouts.footer')
