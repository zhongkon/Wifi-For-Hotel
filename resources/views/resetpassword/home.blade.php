@extends('layouts.master')


@section('title', 'Reset Wifi Password')

@section('cssaddon')
        <script src="/assets/js/modernizr.min.js"></script>
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/moment.min.js"></script>

		<!-- BEGIN CSS for this page -->
        <link href="/assets/plugins/datetimepicker/css/daterangepicker.css" rel="stylesheet" /> 
		<!-- END CSS for this page -->
@endsection

@section('jsaddon')
<script src="/assets/plugins/datetimepicker/js/moment.min.js"></script>
<script src="/assets/plugins/datetimepicker/js/daterangepicker.js"></script>
<script>
    $(function() {
        $('input[name="datecheckout"]').daterangepicker({
            timePicker24Hour: true,
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'D MMM, YYYY h:mm:ss'
            }
        });
    });
</script>
@endsection

@section('content')
<div class="row">
        <div class="col-sm-3"></div>
    <div class="col-xs-12 col-sm-12 col-md-auto col-lg-6 col-xl-6">
        <div class="card mb-3">
            <div class="card-header">
                <h3><i class="fa fa-user"></i> เปลี่ยนรหัสผ่านให้กับแขกเท่านั้น!</h3>
                ใช้สำหรับ เปลี่ยนรหัสผ่านให้กับแขกเท่านั้น!ไม่สามารถเพิ่มผู้ใช้งานใหม่ได้รูปแบบในการแก้ไข<br>
                ป้อน เบอร์ห้องต้องเป็นเลข 4 หลักเท่านี้นถ้าห้องใหนเป็นเลข 3 หลักให้เติม 0 ใว้ข้างหน้านด้วย
            </div>
                
            <div class="card-body">
            <form method="post" action="/resetpassword/save" data-parsley-validate novalidate autocomplete ="off">
            @csrf
            {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="userName">User Name<span class="text-danger">*</span></label>
                    <input type="text" name="userName" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName">
                </div>

                <div class="form-group">
                        <label for="password">Password<span class="text-danger">*</span></label>
                        <input id="password" type="text" placeholder="Password" required class="form-control" name="Password">
                    </div>

                    <div class="form-group">
                            <label for="Check-Out">Check-Out Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="datecheckout">
                    </div>                

                <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-secondary m-l-5">
                            Cancel
                        </button>
                    </div>

            </form>
        </div>
                                                                    
        </div><!-- end card-->					
    </div>
    <div class="col-sm-3"></div>
    </div>
@endsection
