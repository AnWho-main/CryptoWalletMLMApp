@extends('layouts.main')
@php
    $org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'] . ' | ticket')
@section('content')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <div class="content-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ticket</h4>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal"
                                @if (isset($upd)) action="{{ route('member-update-ticket', ['id' => $upd->id]) }}" @else action="{{ route('member-insert-ticket') }}" @endif
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if (session()->has('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if (session()->has('alt'))
                                        <div class="alert alert-danger">
                                            {{ session('alt') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-sm-8">

                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-3 col-form-label">Subject </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"
                                                        value="{{ isset($upd) ? $upd->ticket_subject : old('ticket_subject') }}"
                                                        id="ticket_subject" name="ticket_subject" required
                                                        placeholder="Enter Ticket Subject">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-3 col-form-label">Section </label>
                                                <div class="col-sm-9">
                                                    <select name="ticket_section" class="form-control" required>
                                                        @php
                                                            $support_section = DB::table('support_sections')->get();
                                                        @endphp
                                                        <option value="" selected>Select Section </option>
                                                        @foreach ($support_section as $support_sections)
                                                            <option value="{{ $support_sections->id }}"
                                                                @if (isset($upd)) @if ($upd->ticket_section == $support_sections->id) selected @endif
                                                                @endif>
                                                                {{ $support_sections->section_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-3 col-form-label"> Status</label>
                                                <div class="col-sm-9">
                                                    <select name="ticket_status" class="form-control" id="tstatus"
                                                        required>
                                                        @foreach (config('global.supportstatus') as $statusKey => $statusVal)
                                                            @if (isset($upd))
                                                                @if ($statusKey == $upd->ticket_status)
                                                                    <option value="{{ $statusKey }}" selected>
                                                                        {{ $statusVal }}</option>
                                                                @else
                                                                    <option value="{{ $statusKey }}">{{ $statusVal }}
                                                                    </option>
                                                                @endif
                                                            @else
                                                                @if ($statusKey == 1)
                                                                    <option value="{{ $statusKey }}" selected>
                                                                        {{ $statusVal }}</option>
                                                                @else
                                                                    <option value="{{ $statusKey }}">
                                                                        {{ $statusVal }}
                                                                    </option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-3 col-form-label
                                                ">Message </label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" class="form-control" value="{{ isset($upd) ? $upd->ticket_message : '' }}" id="ticket_message"
                                                        name="ticket_message" required placeholder="Enter Message">{{ isset($upd) ? $upd->ticket_message : '' }}</textarea>
                                                </div>
                                            </div>

                                            <!--<div class="form-group row">-->
                                            <!--  <label for="inputPassword3" class="col-sm-3 col-form-label">Attachement </label>-->
                                            <!--  <div class="col-sm-9">-->
                                            <!--    <input type="file" class="form-control"   value="{{ isset($upd) ? $upd->ticket_attachment : '' }}" id="ticket_attachment" name="ticket_attachment">-->
                                            <!--    @if (isset($upd))-->
                                            <!--<div class="cont ">    -->
                                            <!--  <div class="container ">-->
                                            <!--    <span class="tooltiptext2">-->
                                            <!--  <img style="height:40px;"  src="@if ($upd->ticket_attachment == null) \upload\nophoto.jpg  @else @if (!file_exists(public_path('/upload/useruploads/' . $upd->ticket_attachment))) \upload\nophoto.jpg  @else \upload\useruploads\{{ $upd->ticket_attachment }} @endif  @endif" >-->
                                            <!-- </span>-->
                                            <!--  </div>-->
                                            <!--</div>  -->
                                            <!--@endif-->
                                            <!--  </div>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">{{ $btn }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
