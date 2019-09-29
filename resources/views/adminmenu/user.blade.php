@extends('layouts.master')

@section('title', 'System User')

@section('cssaddon')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/4.2.4/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('jsaddon')

<!-- BEGIN Java Script for this page -->

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/4.2.4/sweetalert2.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script>

var eventFiredBtnDeleteSweetAlert = function(jE) {
    // Use sweetalert AFTER DataTables
    $(jE).on('click', '.btnDelete', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        var btnDelete = $(this);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then(function(isConfirm) {
            if (isConfirm) {
                //btnDelete.closest('form').submit();
                swal("Deleted!", "Your record has been deleted.", "success");
                window.location.href = link;
            }else {
                  swal("Error", "Not Delete", "error");
            }
        });
    });

    $(jE).on('click', '.btnDisable', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        var btnDelete = $(this);
        swal({
            title: 'Are you sure?',
            text: "Do you want to disable this account!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, disable it!'
            }).then(function(isConfirm) {
            if (isConfirm) {
                //btnDelete.closest('form').submit();
                swal("Disable!", "Your record has been disble.", "success");
                window.location.href = link;
            }else {
                  swal("Error", "Not Disable", "error");
            }
        });
    });
};
//eventFiredBtnDeleteSweetAlert();

$('#systemuser').on('draw.dt', function () {
      //console.log('draw.dt');
      eventFiredBtnDeleteSweetAlert(this);
  })

$(function() {
                var table = $('#systemuser').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('admin/users/data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'type', name: 'type' },
                    { data: 'created_at', name: 'created_at','searchable': false, 'orderable': false },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions','searchable': false, 'orderable': false }
                ]
                });
                    
                setInterval( function () {
                table.ajax.reload();
                }, 30000 );
    });
</script>	

<!-- END Java Script for this page -->
@endsection

@section('content')

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
    <div class="card mb-3">
        <div class="card-header">
            <h3><i class="fa fa-table"></i>Create Staff User</h3>
            <div class="pull-right">
                    <div class="pull-right">                           
                            <a role="button" class="btn btn-primary" data-fancybox data-type="iframe" data-src="/admin/users/create" href="javascript:;"><span class="btn-label"><i class="fa fa-check"></i></span>New System User</a>
                    </div>
                </div>
        </div>
            
        <div class="card-body">
            
            <div class="table-responsive">

            <table id="systemuser" class="table table-bordered table-hover display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User type</th>
                    <th>insert</th>
                    <th>update</th>
                    <th>Action</th>
                </tr>
            </thead>									

            </table>

            </div>

        </div>							
    </div><!-- end card-->					
</div>

@endsection
