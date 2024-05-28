@extends('layouts.main')
@php
    $org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'] . ' | MyDirect')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">MY DIRECT NETWORK</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <form class="align-middle mb-0 table table-borderless" action="{{ asset(config('app.member_folder').'/myDirect/') }}" method="GET">
                                    @csrf
                                  
                                      <table>
                                        <thead>
                                          <tr>
                                            <th style="width: 150px;">
                                              <input type="text" name="client_id" style="width: 150px;"
                                                value="{{ request()->get('client_id') }}" class="form-control " placeholder="Member Id">
                                            </th>
                                            <th style="width: 150px;">
                                              <input type="date" placeholder="dd-mm-yyyy" name="datefrom"
                                                value="{{ request()->get('datefrom') }}" style="width: 180px;" class="form-control ">
                                            </th>
                                            <th style="width: 150px;">
                                              <input type="date" name="dateto" value="{{ request()->get('dateto') }}" style="width: 180px;"
                                                class="form-control ">
                                            </th>
                                            <th style="width: 50px;">
                                              <select name="per_page_selected" class="form-control" style="width: 110px;"
                                                onchange="this.form.submit()">
                                                  
                                                @php
                                                $per_page_selected = request()->get('per_page_selected');
                                                foreach(config('global.pagingListArray') as $pagingValue){
                                                if($per_page_selected == $pagingValue){$pagingSelected = "selected";}else{$pagingSelected="";}
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
                               
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap border-primary">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S. No.</th>
                                            <th class="text-center">Member Id</th>
                                            <th class="text-center">Member Name</th>
                                            <th class="text-center">City</th>
                                            <th class="text-center">Reg.Date</th>
                                            <th class="text-center">Act.Date</th>
                                            <th class="text-center">Status</th>
                                          </tr>
                                    </thead>

                                    <tbody>
                                        @if(count($rsd) > 0)
                                        @php
                                        $i = 0;
                                        $routePath = '/'.config('app.member_folder').'/myDirect/';
                                        $routePathStatus = '/'.config('app.member_folder').'/myDirect/status/';
                                        @endphp
                                        @foreach($rsd as $rs)
                                        @php
                                      if($rs->activation_status == 1){
                                      $class = "success";
                                      $statusVal = "active";
                                      }
                                      else{
                                       $class = "danger";
                                       $statusVal = "inactive";
                                      }
                                      @endphp
                        
                                        <tr>
                                          <th class="text-center" scope="row">{{ ++$i }}</th>
                                          <td class="text-center">{{ $rs->client_id }}</td>
                                          <td class="text-center">{{ $rs->m_name }}</td>
                                          <td class="text-center">{{ $rs->m_city }}</td>
                                          <td class="text-center">{{ date('d-m-Y', strtotime($rs->join_date)); }}</td>
                                          <td class="text-center">@if(!is_null($rs->activation_date)){{date('d-m-Y', strtotime($rs->activation_date));}}@else 00-00-0000 @endif
                                          </td>
                                          <td class="text-center" > <span class="badge badge-{{ $class }}" style="padding: 7px;">{{ $statusVal }}</span></td>
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
@endsection
