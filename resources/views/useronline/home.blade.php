@extends('layouts.master')


@section('title', 'User Online Wifi')

@section('cssaddon')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css" />
@endsection

@section('jsaddon')

<!-- BEGIN Java Script for this page -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
                var table = $('#useronline').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('user-online/data') }}',
                columns: [
                        //{ data: '.id', name: '.id' },
                        { data: 'server', name: 'server' },
                        { data: 'user', name: 'user' },
                        { data: 'address', name: 'address' },
                        { data: 'mac-address', name: 'mac-address' },
                        { data: 'login-by', name: 'login-by' },
                        { data: 'uptime', name: 'uptime' },
                        { data: 'bytes-in', name: 'bytes-in' },
                        { data: 'bytes-out', name: 'bytes-out' }                        
                     ]
                });        
                    
                setInterval( function () {
                table.ajax.reload();
                }, 30000 );
    });
  </script>
@endsection

@section('content')

<div class="row">
				
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="fa fa-table"></i>  Wifi User Online </h3>
                            
                        </div>
                            
                        <div class="card-body">
                        
                        <table class="table table-bordered table-hover display" id="useronline">
                        <thead>
                            <tr>
                                
                                <th>Location</th>
                                <th>Username</th>
                                <th>IP Address</th>
                                <th>Mac Address</th>
                                <th>Login By</th>
                                <th>Uptime</th>
                                <th>Bytes In</th>
                                <th>Byte Out</th>
                            </tr>
                        </thead>
                        </table>
                            
                        </div>														
                    </div><!-- end card-->					
                </div>
</div>

@endsection
