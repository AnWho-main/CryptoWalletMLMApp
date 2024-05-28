@extends('layouts.main')
@php
    $org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'] . ' | Chat Ticket')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script type="text/javascript"></script>
    <div class="content-body">
        <div class="container-fluid">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="alt1" id="alting" style="color: green; display: none;">Data updated successfully!
                        </div>

                        <div class="card">
                            <div class="card-body">
                        

                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Username</label>
                                            <div class="col-sm-8">
                                                <p>{{ $rsd->ticket_username }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{ $rsd->id }}" id="tid" />
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Ticket
                                                Section</label>
                                            <div class="col-sm-8">
                                                <p>{{ $section->section_name }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Ticket
                                                Number</label>
                                            <div class="col-sm-8">
                                                <p>{{ $rsd->ticket_no }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Subject</label>
                                            <div class="col-sm-8">
                                                <p>{{ $rsd->ticket_subject }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <!-- <label for="inputPassword3" class="col-sm-3 col-form-label">Category</label> -->
                                            <div class="col-sm-9">
                                                <select name="fk_cid" class="form-control" id="tstatus"
                                                    onchange="sendToServer();">
                                                    @foreach (config('global.supportstatus') as $statusKey => $statusVal)
                                                        @if ($statusKey == $rsd->ticket_status)
                                                            <option value="{{ $statusKey }}" selected>{{ $statusVal }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $statusKey }}">{{ $statusVal }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                    
                        </div>
                    </div>
                    </div>
                </div>
            </form>
            <div class="messaging card">
                <div class="card-body">
                    <div class="mesg" style="padding-top: 12px;">
                        <div class="msg_history">
                            @foreach ($data as $record)
                                @if ($record->replied_by == 'admin')
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
                                            <p>{{ $record->ticket_message }}</p>
                                            @if (isset($record->ticket_attachment))
                                                <a href="../../{{ config('global.UPLOADPATH') }}{{ $record->ticket_attachment }}"
                                                    target="blank" style="color: gray;"><i class="fa fa-paperclip"
                                                        aria-hidden="true"></i> Attachment</a>
                                            @endif
                                            <span class="time_date">{{ date('d-m-y', strtotime($record->created_at)) }} |
                                                {{ date('h:i A', strtotime($record->created_at)) }}</span>
                                        </div>
                                    </div>
                                @endif
                                @if ($record->replied_by == 'user')
                                    @if (isset($userData->photo))
                                        @php
                                            $photo = '../../' . config('global.UPLOADPATH') . $userData->photo;
                                        @endphp
                                    @endif
                                    <div class="incoming_msg">
                                        <div class="incoming_msg_img"> <img style="border-radius: 50%; margin-left:4px;"
                                                src="@if (!is_null($userData->photo)) \upload\nouser.png  @else @if (!file_exists(public_path(config('global.UPLOADPATH') . $userData->photo))) \upload\nouser.png  @else {{ $photo }} @endif  @endif"
                                                alt="no image">
                                        </div>
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <i>
                                                    @if (isset($userData->m_name))
                                                        {{ $userData->m_name }}
                                                    @else
                                                        unknown @endif
                                                </i>
                                                <p>{{ $record->ticket_message }}</p>
                                                @if (isset($record->ticket_attachment))
                                                    <a href="../../{{ config('global.UPLOADPATH') }}{{ $record->ticket_attachment }}"
                                                        target="blank" style="color: gray;"><i class="fa fa-paperclip"
                                                            aria-hidden="true"></i> Attachment</a>
                                                @endif
                                                <span class="time_date">
                                                    {{ date('d-m-y', strtotime($record->created_at)) }} |
                                                    {{ date('h:i A', strtotime($record->created_at)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <form class="form-horizontal" action="{{ route('send-member-msg',$rsd->id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <!--<div class="input-group">-->
                            <!--      <label class="col-sm-2 font-weight-bold">Attachment</label>-->
                            <!--      <input type="file" id="file" class="custome-file-input" name="myfile" value="" >       -->
                            <!--  </div>-->
                            <div class="type_msg">
                                <div class="input_msg_write">
                                    <input type="text" name="amsg" required class="write_msg"
                                        placeholder="Type a message" />
                                    <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o"
                                            aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </section>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
        <script>
            function sendToServer() {

                // var ticket_section = document.getElementById("tsection").value;
                var ticket_status = document.getElementById("tstatus").value;
                var ticket_id = document.getElementById("tid").value;
                // alert( ticket_section);

                $.ajax({
                    url: '{{ route('member-set-updateTicket') }}',
                    type: 'POST',
                    data: {
                        ticket_status: ticket_status,
                        ticket_id: ticket_id,
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        document.getElementById('alting').style.display = "block";
                        // console.log(response);
                        // alert("Category Rearrange Successfully!");
                    }
                });
            }
        </script>

        <style>
            .container {
                max-width: 1170px;
                margin: auto;
            }

            img {
                max-width: 100%;
            }

            .inbox_people {
                background: #f8f8f8 none repeat scroll 0 0;
                float: left;
                overflow: hidden;
                width: 40%;
                border-right: 1px solid #c4c4c4;
            }

            .inbox_msg {
                border: 1px solid #c4c4c4;
                clear: both;
                overflow: hidden;
            }

            .top_spac {
                margin: 20px 0 0;
            }


            .recent_heading {
                float: left;
                width: 40%;
            }

            .srch_bar {
                display: inline-block;
                text-align: right;
                width: 60%;
            }

            .headind_srch {
                padding: 10px 29px 10px 20px;
                overflow: hidden;
                border-bottom: 1px solid #c4c4c4;
            }

            .recent_heading h4 {
                color: #05728f;
                font-size: 21px;
                margin: auto;
            }

            .srch_bar input {
                border: 1px solid #cdcdcd;
                border-width: 0 0 1px 0;
                width: 80%;
                padding: 2px 0 4px 6px;
                background: none;
            }

            .srch_bar .input-group-addon button {
                background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
                border: medium none;
                padding: 0;
                color: #707070;
                font-size: 18px;
            }

            .srch_bar .input-group-addon {
                margin: 0 0 0 -27px;
            }

            .chat_ib h5 {
                font-size: 15px;
                color: #464646;
                margin: 0 0 8px 0;
            }

            .chat_ib h5 span {
                font-size: 13px;
                float: right;
            }

            .chat_ib p {
                font-size: 14px;
                color: #989898;
                margin: auto
            }

            .chat_img {
                float: left;
                width: 11%;
            }

            .chat_ib {
                float: left;
                padding: 0 0 0 15px;
                width: 88%;
            }

            .chat_people {
                overflow: hidden;
                clear: both;
            }

            .chat_list {
                border-bottom: 1px solid #c4c4c4;
                margin: 0;
                padding: 18px 16px 10px;
            }

            .inbox_chat {
                height: 550px;
                overflow-y: scroll;
            }

            .active_chat {
                background: #ebebeb;
            }

            .incoming_msg_img {
                display: inline-block;
                width: 6%;
            }

            .received_msg {
                display: inline-block;
                padding: 0 0 0 10px;
                vertical-align: top;
                width: 92%;
            }

            .received_withd_msg p {
                background: #ebebeb none repeat scroll 0 0;
                border-radius: 3px;
                color: #646464;
                font-size: 14px;
                margin: 0;
                padding: 5px 10px 5px 12px;
                width: 100%;
            }

            .time_date {
                color: #747474;
                display: block;
                font-size: 12px;
                margin: 8px 0 0;
            }

            .received_withd_msg {
                width: 57%;
            }

            .mesgs {
                float: left;
                padding: 30px 15px 0 25px;
                width: 100%;
            }

            .sent_msg p {
                background: #05728f none repeat scroll 0 0;
                border-radius: 3px;
                font-size: 14px;
                margin: 0;
                color: #fff;
                padding: 5px 10px 5px 12px;
                width: 100%;
            }

            .outgoing_msg {
                overflow: hidden;
                margin: 26px 0 26px;
            }

            .sent_msg {
                float: right;
                width: 46%;
            }

            .input_msg_write input {
                background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
                border: medium none;
                color: #4c4c4c;
                font-size: 15px;
                min-height: 48px;
                width: 100%;
            }

            .type_msg {
                border-top: 1px solid #c4c4c4;
                position: relative;
            }

            .msg_send_btn {
                background: #05728f none repeat scroll 0 0;
                border: medium none;
                border-radius: 50%;
                color: #fff;
                cursor: pointer;
                font-size: 17px;
                height: 33px;
                position: absolute;
                right: 0;
                top: 11px;
                width: 33px;
            }

            .messaging {
                padding: 0 0 50px 0;
            }

            .msg_history {
                height: 516px;
                overflow-y: auto;
            }
        </style>
    @endsection
