@extends('layouts.master')


@section('title', 'What\'s Wrong?')

@section('cssaddon')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css" />
<style>
.loginfail{
    color:red;
    font-weight: bold;
}
</style>
@endsection

@section('jsaddon')
<!-- BEGIN Java Script for this page -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
                var table = $('#wifisuccess').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('what-wrong/datapap') }}',
                columns: [
                        { data: 'authdate', name: 'authdate' },
                        { data: 'username', name: 'username' },
                        { data: 'pass', name: 'pass' },
                        { data: 'reply', name: 'reply' }
                     ],
                createdRow: function( row, data, dataIndex ) {
                    if ( data['reply'] == "Access-Reject" )
                    {
                        $(row).addClass( 'loginfail' );
                    }
                }
                });        
                    
                setInterval( function () {
                table.ajax.reload();
                }, 30000 );
    });

    $(function() {
                var table = $('#wififail').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('what-wrong/datavlan') }}',
                columns: [
                { data: 'authdate', name: 'authdate' },
                        { data: 'username', name: 'username' },
                        { data: 'pass', name: 'pass' },
                        { data: 'reply', name: 'reply' }
                     ],
                createdRow: function( row, data, dataIndex ) {
                    if ( data['reply'] == "Access-Reject" )
                    {
                        $(row).addClass( 'loginfail' );
                    }
                }
                });

                setInterval( function () {
                table.ajax.reload();
                }, 30000 );
    });

  </script>

@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">	
                                        
    <!--Content here-->
    <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
                <div class="card mb-3">
                    <div class="card-header">
                        <h3><i class="fa fa-table"></i>User Login Logs</h3>                
                    </div>
                        
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="wifisuccess" class="table table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>User Name</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                </tr>
                            </thead>										
                        </table>
                        </div>
                        
                    </div>														
                </div><!-- end card-->					
            </div>
    </div>


    </div>
</div>

@endsection
