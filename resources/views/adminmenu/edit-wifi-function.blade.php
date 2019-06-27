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
								<h3><i class="fa fa-hand-pointer-o"></i> New Wifi User and Edit</h3>
							</div>
								
							<div class="card-body">
                            

<form action="#" enctype="multipart/form-data" data-parsley-validate novalidate autocomplete="off"
method="post"
	action="@if(isset($wifiuser)){{ URL::to('/admin/wifi-function/'.$wifiuser->id.'/edit') }}
	        @else{{ URL::to('/admin/wifi-function/create') }}@endif">
    @csrf
    <input type="hidden" name="uid" value="{{{ (isset($wifiuser) ? $wifiuser->username : null) }}}" />
    <div class="form-group">
        <label for="FunctionName">Function Name<span class="text-danger">*{{ $errors->first('functionname')}}</span></label>
        <input type="text" name="FunctionName" data-parsley-trigger="change" required placeholder="Enter Function name" class="form-control" id="FunctionName" value="@isset($wifiuser){{$wifiuser->functionname}}@endisset"/>
    </div>
    <div class="form-group">
        <label>Sales เจ้าของงาน<span class="text-danger">*{{ $errors->first('sale')}}</span></label>
        <div>
            <input type="text" class="form-control" name="sales" placeholder="Sales" required class="form-control" value="@isset($wifiuser){{$wifiuser->sale}}@endisset"/>
        </div>
    </div>
    <div class="form-group">
        <label for="UserName">UserName<span class="text-danger">*@php if ($errors->has('username')) { echo " User Name ต้องไม่ซ้ำกัน";} @endphp</span></label>
        <input type="text"  @if(isset($wifiuser)) {{"disabled"}} @endif name="username" data-parsley-trigger="change" required placeholder="Enter UserName" class="form-control" id="UserName" value="@isset($wifiuser){{$wifiuser->username}}@endisset"/>
        
    </div>
    <div class="form-group">
        <label for="Password">Password<span class="text-danger">*{{ $errors->first('Password')}}</span></label>
        <input id="Password" type="text" name="Password" placeholder="Password" required class="form-control" value="@isset($wifiuser){{$wifiuser->password}}@endisset"/>
    </div>
    <div class="form-group">
        <label>Expiry Date <span class="text-danger">*{{ $errors->first('functionend')}}</span></label>
        <div>
            <input type="text" class="form-control" name="expirydate" value="@isset($wifiuser){{$wifiuser->fuctionend}}@endisset"/>
        </div>
    </div> 
    <div class="form-group">
        <label for="Group">Group <span class="text-danger">* @php if ($errors->has('wifigroup')) { echo "jong require";} @endphp </span></label>
        @php
            $wg = "non";
        @endphp

        @isset($wifiuser)
        @php         $wg = $wifiuser->GroupName;        @endphp
        @endisset

        <select id="GroupName" name="GroupName" class="form-control">
            @foreach ($Group as $g)                
                <option value="{{ $g->GroupName }}" @php if($wg == $g->GroupName){ echo "selected";} @endphp >{{ $g->Description }}</option>
            @endforeach
    </select>
    </div>

    <div class="form-group">
        <label>Number Concurrent Device</label>
        <div>
            <input data-parsley-type="number" name ="qty" type="text" class="form-control" required placeholder="Enter only numbers" value="@isset($wifiuser){{$wifiuser->qty}}@endisset"/>
        </div>
    </div>                                                    
    <div class="form-group">
        <label>Textarea</label>
        <div>
            <textarea required name ="comment" class="form-control">@isset($wifiuser){{$wifiuser->comment}}@endisset</textarea>
        </div>
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
