@extends('layouts.master')

@section('title', 'Guest Room')

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
};
//eventFiredBtnDeleteSweetAlert();


// START CODE FOR BASIC DATA TABLE 

$('#allrooms').on('draw.dt', function () {
      //console.log('draw.dt');
      eventFiredBtnDeleteSweetAlert(this);
  })
  // .on('responsive-resize.dt', function () {
  //     console.log('responsive-resize.dt');
  //      eventFiredBtnDeleteSweetAlert();
  // })


  .DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: '{{ url("admin/guest-config/data") }}',
    columns: [
            { data: 'id', name: 'id' },
            { data: 'Room', name: 'Room' },
            { data: 'RoomType', name: 'RoomType' },
            { data: 'Description', name: 'Description' },
            { data: 'updated_by', name: 'updated_by' },
            { data: 'created_by', name: 'created_by' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions','searchable': false, 'orderable': false }                        
          ]  
});


$(".fancybox").fancybox({
    type: 'iframe',
    afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
        parent.location.reload(true);
    }
});

</script>	

<!-- END Java Script for this page -->
@endsection

@section('content')

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
    <div class="card mb-3">
        <div class="card-header">
            <h3><i class="fa fa-table"></i>Create Guest Wifi </h3>
            <div class="pull-right">
                    <div class="pull-right">
                            <!--a role="button" href="/admin/wifi-function/create" class="btn btn-primary iframe cboxElement"><span class="btn-label"><i class="fa fa-check"></i></span>New User</a-->
                            <a role="button" class="btn btn-primary fancybox" data-fancybox data-type="iframe" data-src="/admin/guest-config/create" href="javascript:;"><span class="btn-label"><i class="fa fa-check"></i></span>New Room</a>
                    </div>
                </div>
        </div>
            
        <div class="card-body">
            
            <div class="table-responsive">
            <table id="allrooms" class="table table-bordered table-hover display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Room</th>
                    <th>Room Type</th>
                    <th>Speed</th>
                    <th>Update By</th>
                    <th>Createtor</th>
                    <th>Last Update</th>
                    <th>Action</th>
                </tr>
            </thead>									

            </table>
            </div>

        </div>							
    </div><!-- end card-->					
</div>

@endsection
