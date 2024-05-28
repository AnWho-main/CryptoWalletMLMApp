@extends('layouts.main')
@php
$org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'].' | Member Profile Update')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">

        <div class="col-xl-12 col-lg-12">
						<div class="card profile-card card-bx m-b30">
							<div class="card-header">
								<h6 class="title">KYC Update</h6>
							</div>
							<form class="profile-form" id="myForm" action="{{route('member-updateKYC')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                @if(session()->has('updt'))
                                <div class="alert alert-success">
                                    {{session('updt')}}
                                </div>
                                @endif
                                @if(session()->has('nupdt'))
                                <div class="alert alert-danger">
                                    {{session('nupdt')}}
                                </div>
                                @endif
								<div class="card-body">
									<div class="row">
                                        {{--
										<div class="col-sm-6 m-b30">
											<label class="form-label">Name</label>
                                            <input name="m_name" @if(!is_null($upd)) value="{{$upd->m_name}}" @endif
                                        placeholder="your name" type="text" class="form-control" @if($vc == 1) readonly=() @else  required  @endif>
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Mobile</label>
                                            <input name="m_mobile" @if(!is_null($upd)) value="{{$upd->m_mobile}}" @else value="{{ old('m_mobile') }}" @endif
                                        placeholder="mobile" oninput="maxLengthCheck(this)"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10"
                                        min="10" type="tel" pattern="[0-9]{10}" class="form-control"  @if($vc == 1) readonly=() @else  required  @endif>
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Email</label>
                                            <input name="m_email" @if(!is_null($upd)) value="{{$upd->m_email}}" @endif
                                        placeholder="email" type="email"  class="form-control"  @if($vc == 1) readonly=() @else  required  @endif>
										</div>
                                        --}}
										<div class="col-sm-6 m-b30">
											<label class="form-label">PAN no</label>
                                            <input name="m_pan" @if(!is_null($upd)) value="{{$upd->m_pan}}" @endif
                                        placeholder="pan number" type="text" pattern="^[A-Za-z0-9]{10}$" class="form-control"  @if($vc == 1) readonly=() @else  required  @endif>
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">PAN Image</label>
                                            <input name="pan_image" type="file" @if(!is_null($upd)) value="{{$upd->pan_image}}" @endif
                                        class="form-control"  @if($vc == 1) readonly=() @else  required  @endif>
                                        @error('pan_image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Aadhar no</label>
                                            <input name="m_adhar_no" @if(!is_null($upd)) value="{{$upd->m_adhar_no}}" @endif
                                        placeholder="aadhar number" type="text" pattern="^[0-9]{12}$"  class="form-control"  @if($vc == 1) readonly=() @else  required  @endif>
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Aadhar Image</label>
                                            <input name="adhaar_image" type="file"  
                                        class="form-control"  @if($vc == 1) readonly=() @else  required  @endif>
                                        @error('adhaar_image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                       
										</div>
                                        @if(!is_null($upd->kyc_remark))
										<div class="col-sm-6 m-b30">
											<label class="form-label">Remark</label>
                                            <input name="kyc_remark" @if(!is_null($upd)) value="{{$upd->kyc_remark}}" @endif
                                        placeholder="kyc remark" type="text" class="form-control" readonly=() >
										</div>
                                        @endif
										
									</div>
								</div>
								<div class="card-footer">
                                @if($vc == 1) 
                        @php $ck = "";$mg = ""; 
                        if($upd->kyc_status == 'approved'){
                            $ck ="success";
                            $mg = "KYC Approved👍🏻";
                        }else{
                            $ck ="warning";
                            $mg = "KYC Pending";
                        } 
                        @endphp
                        <button type="button" class="btn btn-{{$ck}}" >{{$mg}}</button>
                        @else  
                        <button type="submit" class="btn btn-info">update</button>
                        @endif
								</div>
							</form>
						</div>
					</div>

        </div>
    </div>
</div>



@endsection