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
								<h6 class="title">Profile Update</h6>
							</div>
							<form class="profile-form" id="myForm" action="{{route('member-Profile')}}" method="post" enctype="multipart/form-data">
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
										<div class="col-sm-6 m-b30">
											<label class="form-label">Name</label>
											<input  name="m_name" @if(!is_null($upd)) value="{{$upd->m_name}}" @endif
                                        placeholder="Frist Name" type="text" class="form-control">
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Father's Name</label>
											<input name="m_father_name" @if(!is_null($upd)) value="{{$upd->m_father_name}}"
                                        @endif placeholder="Father's Name" type="text" class="form-control" required>
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Profile Image</label>
											<input  name="photo" type="file" @if(!is_null($upd)) value="{{$upd->m_name}}" @endif
                                        class="form-control">
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Mobile</label>
											<input t name="m_mobile" @if(!is_null($upd)) value="{{$upd->m_mobile}}" @endif
                                        placeholder="Mobile" oninput="maxLengthCheck(this)"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10"
                                        min="10" type="text" class="form-control" >
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Email</label>
                                            <input name="m_email" @if(!is_null($upd)) value="{{$upd->m_email}}" @endif
                                        placeholder="Email" type="email"  class="form-control" >
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Birth</label>
                                            <input name="m_dob" @if(!is_null($upd)) value="{{$upd->m_dob}}" @endif required
                                        placeholder="DOB" type="date" class="form-control">
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Address</label>
                                            <input name="m_address" @if(!is_null($upd)) value="{{$upd->m_address}}" @endif
                                        required placeholder="Address" type="text" class="form-control">
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">City</label>
                                            <input name="m_city" @if(!is_null($upd)) value="{{$upd->m_city}}" @endif required
                                        placeholder="City" type="text" class="form-control">
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">State</label>
                                            <input name="m_state" @if(!is_null($upd)) value="{{$upd->m_state}}" @endif required
                                        placeholder="State" type="text" class="form-control">
										</div>
										<div class="col-sm-6 m-b30">
											<label class="form-label">Country</label>
                                            <select name="m_country" class="form-control" required>
                                        <option value="">Select Country</option>
                                        @foreach($mcon as $master_countries1)
                                        <option value="{{ $master_countries1->id }}" @if(isset($upd)) @if($upd->
                                            m_country==$master_countries1->id) selected @endif @endif> {{
                                            $master_countries1->country_name }}</option>
                                        @endforeach
                                    </select>
										</div>
                                        <div class="col-sm-6 m-b30">
											<label class="form-label">Zipcode</label>
                                            <input name="m_pin" @if(!is_null($upd)) value="{{$upd->m_pin}}" @endif required
                                        placeholder="Zipcode" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">{{$btn}}</button>
								</div>
							</form>
						</div>
					</div>

        </div>
    </div>
</div>

@endsection