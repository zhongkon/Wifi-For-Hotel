@extends('layouts.master')

@section('title', 'Catering & Function')

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

$('#allwifiuser').on('draw.dt', function () {
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
    ajax: '{{ url("admin/wifi-function/data") }}',
    columns: [
            //{ data: '.id', name: '.id' },
            { data: 'functionname', name: 'functionname' },
            { data: 'username', name: 'username' },
            { data: 'password', name: 'password' },
            { data: 'Description', name: 'Description','searchable': false, 'orderable': false },
            { data: 'qty', name: 'qty' },
            { data: 'functionend', name: 'functionend' },
            { data: 'sale', name: 'sale' },
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
            <h3><i class="fa fa-table"></i>Create Wifi Account for Event Catering Function or spacial users</h3>
            <div class="pull-right">
                    <div class="pull-right">
                            <!--a role="button" href="/admin/wifi-function/create" class="btn btn-primary iframe cboxElement"><span class="btn-label"><i class="fa fa-check"></i></span>New User</a-->
                            <a role="button" class="btn btn-primary fancybox" data-fancybox data-type="iframe" data-src="/admin/wifi-function/create" href="javascript:;"><span class="btn-label"><i class="fa fa-check"></i></span>New User</a>
                    </div>
                </div>
        </div>
            
        <div class="card-body">
            
            <div class="table-responsive">
            <table id="allwifiuser" class="table table-bordered table-hover display">
            <thead>
                <tr>
                    <th>Function Name</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Speed</th>
                    <th>Max User</th>
                    <th>Expiry Date</th>
                    <th>Sales Name</th>
                    <th>Action</th>
                </tr>
            </thead>									

            </table>
            </div>

        </div>							
    </div><!-- end card-->					
</div>

@endsection
