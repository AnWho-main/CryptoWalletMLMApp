@extends('layouts.main')
@php
    $org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'] . ' | ticket List')
@section('content')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script type="text/javascript"></script>

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    @foreach (config('global.supportstatus') as $statusKey => $statusVal)
                                        @php
                                            $availTickets = 0;
                                            $availTickets = \AppHelper::instance()->availTic($statusKey);
                                        @endphp
                                        <th style="padding: 0px 100px; color: gray;">
                                            <div class="col border-right-blue-grey border-right-lighten-4">
                                                <div class="card-body text-center">
                                                    <h1 class="display-4" style="color: black;">
                                                        <i class="ft-chevron-up fs-2 success"></i>
                                                        <?php echo $availTickets; ?>
                                                    </h1>
                                                    <span>
                                                        <?php echo $statusVal; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </th>
                                    @endforeach
                                </thead>
                            </table>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List Support Ticket </h4>
                        </div>
                        @if (session()->has('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body">
                        <div class="table-responsive">
                            <form class="align-middle mb-0 table table-borderless"
                                action="{{ route('member-search-listTicket') }}" method="GET">
                                @csrf
                                <table>
                                    <thead>
                                        <tr>
                                            <td><input type="text" name="ticket_no" style="width: 150px;"
                                                    value="{{ request()->get('ticket_no') }}" class="form-control"
                                                    placeholder="Ticket No"></td>
                                            <td style="width: 50px;">
                                                <select name="ticket_status" class="form-control" id="tstatus"
                                                    style="width: 140px;">
                                                    <option value="" selected>Select Status</option>
                                                    @foreach (config('global.supportstatus') as $statusKey => $statusVal)
                                                        @if ($statusKey == 0)
                                                            <option value="-1"
                                                                @if (request()->get('ticket_status') == -1) selected @endif>
                                                                {{ $statusVal }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $statusKey }}"
                                                                @if (request()->get('ticket_status') == $statusKey) selected @endif>
                                                                {{ $statusVal }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td style="width: 50px;">
                                                <select name="ticket_section" class="form-control" id="tsection"
                                                    style="width: 150px;">
                                                    <option value="" selected>Select Section</option>
                                                    @foreach ($sections as $section)
                                                        @if (request()->get('ticket_section') == $section->id)
                                                            <option value="{{ $section->id }}" selected>
                                                                {{ $section->section_name }}</option>
                                                        @else
                                                            <option value="{{ $section->id }}">{{ $section->section_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td style="width: 50px;">
                                                <select name="per_page_selected" class="form-control" style="width: 110px;"
                                                    onchange="this.form.submit()">
                                                    @php
                                                        $per_page_selected = request()->get('per_page_selected');
                                                        foreach (config('global.pagingListArray') as $pagingValue) {
                                                            if ($per_page_selected == $pagingValue) {
                                                                $pagingSelected = 'selected';
                                                            } else {
                                                                $pagingSelected = '';
                                                            }
                                                            echo "<option value=\"$pagingValue\" $pagingSelected>$pagingValue</option>";
                                                        }
                                                    @endphp
                                                </select>
                                            </td>
                                            <th style="width: 50px;">
                                                <button ttype="submit" name="search" style="width: 110px;"
                                                    class="btn-wide btn btn-primary">Search</button>
                                            </th>
                                            <th>
                                                <a href="{{ asset(config('app.member_folder') . '/ticket') }}"
                                                     class="btn-wide btn btn-primary">Add Ticket</a>
                                            </th>

                                        </tr>
                                    </thead>
                                </table>
                            </form>
                            <br />
                        </div>
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless"
                                id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr.No</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Ticket No</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Section</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($rsd) > 0)
                                        @php
                                            $i = 0;
                                            $index = 0;
                                            $routePath = '/' . config('app.member_folder') . '/listTicket/';
                                        @endphp
                                        @foreach ($rsd as $rs)
                                            @php
                                                if ($rs->ticket_status == 1) {
                                                    $class = 'success';
                                                } elseif ($rs->ticket_status == 0) {
                                                    $class = 'danger';
                                                } else {
                                                    $class = 'secondary';
                                                }
                                            @endphp
                                            <tr id="rid{{ $rs->id }}">
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td class="text-center">{{ $rs->ticket_username }}</td>
                                                <td class="text-center">{{ $rs->ticket_no }}</td>
                                                <td class="text-center">{{ $rs->ticket_subject }}</td>
                                                <td class="text-center">{{ $support[$index++] }}</td>
                                                <td class="text-center">
                                                    @foreach (config('global.supportstatus') as $statusKey => $statusVal)
                                                        @if ($rs->ticket_status == $statusKey)
                                                            <span class="badge badge-{{ $class }}"
                                                                style="padding: 7px;">{{ $statusVal }}</span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('member-show-ticketchat', ['id' => $rs->id]) }}"><button
                                                            type="button" class="btn-wide btn btn-info"><i
                                                                class="fa fa-commenting-o"
                                                                aria-hidden="true"></i></button></a>&nbsp;
                                                    <a type="button"
                                                        href="{{ route('member-delete-ticket', ['id' => $rs->id]) }}"
                                                        class="btn-wide btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="20">No result found!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="pagination-block">
                            <?php //{{ $rsd->appends(request()->input())->links() }}
                            ?>
                            <!-- Custome pagination  -->
                            {{ $rsd->appends(request()->input())->links('layouts.paginationlinks') }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
