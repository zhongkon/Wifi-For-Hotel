@extends('layouts.master')

@section('title', 'Audit Trail')

@section('cssaddon')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css" />
<style>
.resetpass{
    color:red;
    font-weight: bold;
}
</style>
@endsection

@section('jsaddon')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
               var table = $('#audit-trail').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('audit-trail/data') }}',
               columns: [
                        { data: 'hdate', name: 'hdate' },
                        { data: 'room', name: 'room' },
                        { data: 'password', name: 'password' },
                        { data: 'doer', name: 'doer' },
                        { data: 'checkout', name: 'checkout' }
                     ],
                     createdRow: function( row, data, dataIndex ) {
                    if ( data['doer'] != "WWW INTERFACE" )
                    {
                        $(row).addClass( 'resetpass' );
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
				
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="fa fa-table"></i> ประวัติการออกรหัสผ่าน Wifi สำหรับแขก</h3>
                            
                        </div>
                            
                        <div class="card-body">
                        
                        <table class="table table-bordered table-hover display" id="audit-trail">
                        <thead>
                            <tr>
                                <th>Date Time</th>
                                <th>User Name</th>
                                <th>Password</th>
                                <th>Generate By</th>
                                <th>Password Expire</th>
                            </tr>
                        </thead>
                        </table>
                            
                        </div>														
                    </div><!-- end card-->					
                </div>
</div>
@endsection
