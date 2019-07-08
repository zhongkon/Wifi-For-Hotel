@extends('layouts.blank')

@section('title', 'Edit')

@section('cssaddon')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/4.2.4/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<!-- BEGIN CSS for this page -->
<link href="/assets/plugins/datetimepicker/css/daterangepicker.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
<!-- END CSS for this page -->

@endsection

@section('jsaddon')
<script src="/assets/plugins/datetimepicker/js/moment.min.js"></script>
<script src="/assets/plugins/datetimepicker/js/daterangepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<!-- BEGIN Java Script for this page -->
<script>
    $(function() {
        $('input[name="expirydate"]').daterangepicker({
            timePicker24Hour: true,
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'D MMM, YYYY h:mm:ss'
            }
        });
    });
</script>

<!-- END Java Script for this page -->
@endsection

@section('content')

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
						<div class="card mb-8">
							<div class="card-header">
								<h3><i class="fa fa-hand-pointer-o"></i> Wifi Mac Authentication</h3>
							</div>
								
							<div class="card-body">
<!--
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
-->
<form action="#" enctype="multipart/form-data" data-parsley-validate novalidate autocomplete="off"
method="post"
	action="@if(isset($mac)){{ URL::to('/admin/mac-auth/'.$mac->id.'/edit') }}
	        @else{{ URL::to('/admin/mac-auth/create') }}@endif">
    @csrf
    <input type="hidden" name="uid" value="{{{ (isset($mac) ? $mac->MacAddress : null) }}}" />
    <div class="form-group">
        <label for="MacAddress">Mac Address<span class="text-danger">*{{ $errors->first('MacAddress')}}</span></label>
        <input type="text" @if(isset($mac)) {{"disabled"}} @endif name="MacAddress" data-parsley-trigger="change" required placeholder="Enter Mac Address" class="form-control" id="MacAddress" value="@isset($mac){{$mac->MacAddress}}@endisset"/>
    </div>

    <div class="form-group">
        <label>Expiry Date <span class="text-danger">*{{ $errors->first('Expire')}}</span></label>
        <div>
            <input type="text" class="form-control" name="expirydate" value="@isset($mac){{$mac->Expire}}@endisset"/>
        </div>
    </div> 

    <div class="form-group">
        <label for="Group">Group <span class="text-danger">* @php if ($errors->has('GroupName')) { echo "Group is require";} @endphp </span></label>
        @php
            $wg = "non";
        @endphp

        @isset($mac)
        @php         $wg = $mac->GroupName;        @endphp
        @endisset

        <select id="GroupName" name="GroupName" class="form-control">
            @foreach ($Group as $g)                
                <option value="{{ $g->GroupName }}" @php if($wg == $g->GroupName){ echo "selected";} @endphp >{{ $g->Description }}</option>
            @endforeach
    </select>
    </div>

    <div class="form-group">
        <label>เจ้าของ Device<span class="text-danger">*{{ $errors->first('Holder')}}</span></label>
        <div>
            <input type="text" class="form-control" name="Holder" placeholder="Holder" required class="form-control" value="@isset($mac){{$mac->Holder}}@endisset"/>
        </div>
    </div>

    <div class="form-group">
        <label for="UserName">รุ่นและรายละเอียดของ Device<span class="text-danger">*{{ $errors->first('model')}}</span></label>
        <textarea required name ="Device" class="form-control">@isset($mac){{$mac->model}}@endisset</textarea>        
    </div>

    <div class="form-group text-right m-b-0">
        <button class="btn btn-primary" type="submit" >
            Submit
        </button>
        <button type="reset" class="btn btn-secondary m-l-5" onclick="parent.jQuery.fancybox.close();">
            Cancel
        </button>        
    </div>

</form>

@endsection
