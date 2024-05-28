@extends('layouts.main')
@php
$org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'].' | Our Plan Chart')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">

        <div class="col-xl-12 col-lg-12">
						<div class="card profile-card card-bx m-b30">
							<div class="card-header">
								<h6 class="title">Our Plan</h6>
							</div>
                            <form id="myForm" method="POST" action="{{ route('member-planChart') }}">
                         @csrf
                            <div class="form-row">
                            <div class="col-md-12">
                            @php
                            $org = \AppHelper::instance()->orgProfile();
                            @endphp 
                            <center>
                             <embed src="{{ asset('plan-chart.pdf') }}" width="100%" height="600">
                            </center>
                            </div>
                        </form>
                            </div>
					</div>

        </div>
    </div>
</div>

@endsection