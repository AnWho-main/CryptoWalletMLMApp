@extends('layouts.main')
@php
    $org = \AppHelper::instance()->orgProfile();
@endphp
@section('title', $org['organization_name'] . ' | Network Explorer')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
            
                    <div class="card-header">
                        <h4 class="card-title">Network Explorer</h4>
                    </div>
            
                    @if(session()->has('pdenied'))
                    <div class="alert alert-danger">
                      {{session('pdenied')}}
                    </div>
                    @endif
                    
                      @if(!isset($rsd))
                        <div class="alert alert-danger">Your ID is inactive or under process... Please check after sometime...</div>
                        @else
            
                    <div class="table-responsive">
                        @php
            $clubTable = $rsd['clb'];
            $id = $rsd['cid']; // dynamic
            $clientName = $rsd['cid']." - ".$rsd['name']; // dynamic
            $parent_id = -1;
            @endphp
                     
                      <form class="align-middle mb-0 table table-borderless"
                        action="{{ asset(config('app.member_folder').'/networkExplorer/') }}" method="GET">
                        @csrf
            
                        <table>
                          <thead>
                            <tr>
                              <th style="width: 150px;">
                                <input type="text" name="client_id" style="width: 150px;" value="{{ request()->get('client_id') }}"
                                  class="form-control " placeholder="Member Id">
                              </th>
                              <th style="width: 50px;">
                                <select class="form-control" name="club" style="width: 110px;">
                                <option value="ClientProfile" @if(request()->get('club') == 'ClientProfile') selected @endif >Profile Account</option>
                                  <!-- @foreach(config('global.clubTablesArray') as $key => $club)
                                  <option value="{{$key}}" @if(request()->get('club') == $key) selected @endif >{{$club}}</option>
                                  @endforeach -->
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
                      <div class="container">
                        <link rel="stylesheet" href="{{asset('custome/explorer-tree/dtree.css')}}">
            
                        <script type="text/javascript" src="{{asset('custome/explorer-tree/dtree.js')}}"></script>
                        <p style="width: 100%;">

                        <span class="badge badge-rounded badge-success"><a
                            href="javascript: mytree.openAll();"><b>Open All</b></a></span>
                          | <span class="badge badge-rounded badge-warning"><a
                            href="javascript: mytree.closeAll();"><b>Close All</b></a></span>

                          <script language=javascript>
                            mytree = new dTree('mytree');
                            mytree.add('{{$id}}', '{{$parent_id}}', '{{$clientName}}', '');
                            @php
                            $org = \AppHelper:: instance() -> explorer($clubTable, $id, $parent_id);
                            @endphp
                            document.write(mytree); 
                          </script>
                          <br /><br /><br /><br /><br /><br />
                        </p>
                      </div>
                    </div>
                    
                       @endif
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection