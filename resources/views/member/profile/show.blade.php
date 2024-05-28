@extends('layouts.main')
@php
$org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'].' | Member Profile Display')
@section('content')

<div class="content-body">

    <div class="container-fluid">
        <div class="row">

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-blog" style="text-align: center;">
                            <img src="@if($rsd->m_photo == null)\upload\nouser.png @else{{config('app.folder_upload').$rsd->m_photo}}@endif" alt="" class="img-fluid mt-4 mb-4 w-50 rounded">
                            <h4>{{ $rsd->m_name }}</h4>
                            <p class="mb-0">{{ $rsd->client_id }}</p>
                            <p class="mb-0"> @php 
                        $shortAddress = \AppHelper::instance()->shortAddress(Session::get('loginAddress'));
                        @endphp {{$shortAddress}} <i class="fa fa-clone" aria-hidden="true" onclick="setClipboard('{{Session::get('loginAddress')}}')"></i></h6> </p>
                            <p class="mb-0">1323241234312</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div id="about-me" class="tab-pane">
                                <div class="profile-about-me">

                                    <div class="profile-personal-info">
                                        <h4 class="text-primary mb-4">Personal Information</h4>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Father's Name <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{ $rsd->m_father_name }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{ $rsd->m_email }}</span>
                                            @if(!empty($rsd->m_email))
                                            <button type="button" class="btn btn-info" style="padding: 2px;" > verify email</button>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Mobile <span class="pull-end">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{ $rsd->m_mobile }}</span>
                                            @if(!empty($rsd->m_mobile))
                                            <button type="button" class="btn btn-info" style="padding: 2px;" > verify mobile no.</button>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">DOB <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>@if(!empty($rsd->m_dob)){{ date('d-m-Y', strtotime($rsd->m_dob)); }}@else --/--/---- @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Address <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{ $rsd->m_address }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">City <span class="pull-end">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{ $rsd->m_city }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">State <span class="pull-end">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{ $rsd->m_state }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Country <span class="pull-end">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>@if(!empty($mcon->country_name)) {{$mcon->country_name}} @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Zipcode <span class="pull-end">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{ $rsd->m_pin }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('custome/activity.js')}}"></script>

@endsection