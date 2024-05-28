@extends('layouts.main')
@php
    $org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'] . ' | '.$st)
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{$st}} Income Report</h4>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <form class="align-middle mb-0 table table-borderless"
                                action="{{ asset(config('app.member_folder') . '/listIncomeReports/' . $st) }}" method="GET">
                                @csrf
                                <table>
                                    <thead>
                                        <tr>
                                        {{--      <th style="width: 150px;">
                                               
                                            <input type="text" name="client_id" style="width: 150px;"
                                                    value="{{ request()->get('client_id') }}" class="form-control "
                                                    placeholder="client Id"> 
                                            </th> --}}
                                            
                                            <input type="text" name="sts" style="display: none;"
                                                    value="@if ($st == 'direct') direct @elseif($st == 'level') level @elseif($st == 'roi') roi @elseif($st == 'reward') reward @elseif($st == 'club') club @else {{ request()->get('sts') }} @endif"
                                                    style="width: 100px;" class="form-control">
                                            <th style="width: 150px;">
                                                <input type="text" placeholder="ref. name" name="ref_name"
                                                    value="{{ request()->get('ref_name') }}" style="width: 180px;"
                                                    class="form-control ">
                                            </th>
                                            <th style="width: 150px;">
                                                <input type="text" placeholder="ref. ID" name="client_intro_id"
                                                    value="{{ request()->get('client_intro_id') }}" style="width: 180px;"
                                                    class="form-control ">
                                            </th>
                                            <th style="width: 150px;">
                                                <input type="date" placeholder="dd-mm-yyyy" name="datefrom"
                                                    value="{{ request()->get('datefrom') }}" style="width: 180px;"
                                                    class="form-control ">
                                            </th>
                                            <th style="width: 150px;">
                                                <input type="date" name="dateto" value="{{ request()->get('dateto') }}"
                                                    style="width: 180px;" class="form-control ">
                                            </th>
                                            <th style="width: 50px;">
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
                                            </th>
                                            <th>
                                                <button type="submit" name="search" style="width: 110px;"
                                                    class="btn-wide btn btn-primary">Search</button>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </form>
                            <br />
                        </div>
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr.No</th>
                                      {{--  <th class="text-center">Client Id</th>  --}}
                                        <th class="text-center">Ref. Id</th>
                                        <th class="text-center">Ref. Name</th>
                                        @foreach (config('global.incomeTypesArray')[$st] as $key => $value)
                                            @php
                                                $valu = $value;
                                            @endphp
                                            @if (strpos($valu, '#') !== false)
                                                @php
                                                    $exp = explode('#', $valu);
                                                @endphp
                                                @if (!empty($exp[1]))
                                                    <th>{{ $exp[1] }}</th>
                                                @endif
                                            @endif
                                        @endforeach
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Transaction <br> Entry Date</th>
                                        <!--<th class="text-center">Transaction<br> Amt</th>
                                        <th class="text-center">Deduct<br> Tds</th>
                                        <th class="text-center">Deduct <br>Admin</th>-->
                                        <th class="text-center">Payable<br> Amt.</th>
                                        <!--<th class="text-center">Gen.Date</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($rsd) > 0)
                                        @php
                                            $i = 0;
                                            $index = 0;
                                            $routePath = '/' . env('ADMIN_FOLDER') . '/listIncomeReports/';
                                            $routePathStatus = '/' . env('ADMIN_FOLDER') . '/listIncomeReports/status/';
                                        @endphp
                                        @foreach ($rsd as $rs)
                                            <tr id="rid{{ $rs->id }}">
                                                <td class="text-center">{{ ++$i }}</td>
                                                {{--    <td class="text-center">{{ $rs->client_id }}</td> --}}
                                                <td class="text-center">
                                                    @if (!empty($rs->rclient_id))
                                                        {{ $rs->rclient_id }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if (!empty($rs->m_name))
                                                        {{ $rs->m_name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                @foreach (config('global.incomeTypesArray')[$st] as $key => $value)
                                                    @php
                                                        $valu = $value;
                                                    @endphp
                                                    @if (strpos($valu, '#') !== false)
                                                        @php
                                                            $exp = explode('#', $valu);
                                                        @endphp
                                                        @if (!empty($exp[0]))
                                                            @php
                                                                $c = $exp[0];
                                                            @endphp
                                                            <td class="text-center">{{ $rs->$c }}</td>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                <td class="text-center">{{ $rs->income_type }}</td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($rs->payout_date)) }}
                                                </td>
                                                <!--<td class="text-center">{{ $rs->total_amt }}</td>
                                                <td class="text-center">{{ $rs->tds_charges }}</td>
                                                <td class="text-center">{{ $rs->admin_charges }}</td>-->
                                                <td class="text-center"> {{ $rs->payable_income }}</td>
                                                <!--<td class="text-center">{{ date('d-m-Y', strtotime($rs->payout_date)) }}</td>-->
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
                        <div class="d-block text-center card-footer pagination-block"><br />
                            {{ $rsd->appends(request()->input())->links('layouts.paginationlinks') }}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
