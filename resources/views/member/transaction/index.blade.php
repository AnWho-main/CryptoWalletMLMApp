@extends('layouts.main')
@php
    $org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'] . ' | Transactions')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Transactions</h4>
                        </div>

                        <div class="card-body">
                         <div class="row"> 
                            <div class="col-sm-4">
                                    <div class="card card-box bg-secondary">
                                        <div class="card-header ">
                                            <div class="chart-num-days">
                                                <p>
                                                    Total
                                                </p>
                                                <h2 class="count-num text-white">${{$ClientTransactions[0]}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card card-box bg-secondary">
                                        <div class="card-header ">
                                            <div class="chart-num-days">
                                                <p>
                                                    Today's  
                                                </p>
                                                <h2 class="count-num text-white">${{$ClientTransactions[2]}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">  
                                    <div class="card card-box bg-secondary">
                                        <div class="card-header ">
                                            <div class="chart-num-days">
                                                <p>
                                                    Current month  
                                                </p>
                                                <h2 class="count-num text-white">${{$ClientTransactions[1]}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    

                            <div class="row">
                              <!-- /.col -->
                              <div class="col-lg-12 col-12">
                                            <div class="small-box bg " style="padding-bottom: 16px;">
                                            <canvas id="myChart" width="400" height="200"></canvas>
                                            </div>
                              </div>
                                      <!-- /.col -->
                            </div>

                            <div class="table-responsive">
                                <form name="frm" method="GET">
                                    <table class="table text-nowrap border-primary">
                                        <thead>
                                            <th> Transaction
                                                <select name="amount_type" class="form-select form-select"
                                                    onchange="this.form.submit()">
                                                    <option value="">Type</option>
                                                    <option value="Debit"
                                                        @if (request()->get('amount_type') == 'Debit') selected @endif>Debit</option>
                                                    <option value="Credit"
                                                        @if (request()->get('amount_type') == 'Credit') selected @endif>Credit
                                                    </option>
                                                </select>
                                            </th>

                                            <th  style="width: 220px;">
                                                <input type="text" id="reportrange" name="reportrange" readonly value="{{ request()->get('reportrange') }}"  style="width: 220px;"  class="form-control">
                                           </th>

                                            {{--
                                            <th> From <br> <input type="date" placeholder="dd-mm-yyyy" name="datefrom"
                                                    value="{{ request()->get('datefrom') }}" class="form-control ">
                                            </th>
                                            <th> To <br> <input type="date" name="dateto"
                                                    value="{{ request()->get('dateto') }}" class="form-control ">
                                            </th>--}}
                                            <th> Per Page
                                                <select name="per_page_selected" class="form-control"
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
                                            <th> <br> <button type="submit" name="search"
                                                    class="btn-wide btn btn-primary">Search</button></th>
                                        </thead>
                                    </table>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap border-primary">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">TXN</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Description</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($rsd) > 0)
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($rsd as $rs)
                                                @php
                                                    if (!empty($rs->wallet_address)) {
                                                        $sh = 1;
                                                        $shortAddress = \AppHelper::instance()->shortAddress($rs->wallet_address);
                                                    } else {
                                                        $sh = 0;
                                                    }
                                                @endphp
                                                <tr>
                                                    <th class="text-center" scope="row">{{ ++$i }}</th>
                                                    <td class="text-center">{{ date('d-m-Y', strtotime($rs->created_at)) }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($sh == 1)
                                                            {{ $shortAddress }}
                                                            <i class="fa fa-clone" aria-hidden="true"
                                                                onclick="setClipboard('{{ $rs->wallet_address }}')"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($rs->txn_no))
                                                            &nbsp;&nbsp;
                                                            <a href="{{ config('global.TXNURL') . $rs->txn_no }}"
                                                                target="_blank">
                                                                <i class="fa fa-link" aria-hidden="true"
                                                                    style="color:orange"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $rs->amount_type }}</td>
                                                    <td class="text-center">{{ $rs->amount }}</td>
                                                    <td class="text-center">{{ $rs->status }}</td>
                                                    <td class="text-center">{{ $rs->message }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="20">No result found!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="pagination-block">
                                    <br />
                                  {{ $rsd->appends(request()->input())->links('layouts.paginationlinks') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
       $day = array();
       $amt= array();
       foreach($dailyTransSum as $dw){
         $day[] = $dw->day;
         $amt[] = $dw->total_amount;
       }
       $labels = $day;
     $data = $amt;
    @endphp

    
<!-- chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Amount($)',
                data: @json($data),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(function() {

    // var start = moment().subtract(29, 'days');
    var start = moment().startOf('month');  
    var end = moment();

    var dateRange =  document.getElementById('reportrange').value;
    if(dateRange != ""){
        var dateParts = dateRange.split(' - ');
        var start = dateParts[0];
        var end = dateParts[1];
    }

    function cb(start, end) {
        $('#reportrange').val(start.format('M/D/YYYY') + ' - ' + end.format('M/D/YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>


@endsection
