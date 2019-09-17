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
								<h3><i class="fa fa-hand-pointer-o"></i> Wifi User Group</h3>
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
	action="@if(isset($Group)){{ URL::to('/admin/group-config/'.$Group->id.'/edit') }}
	        @else{{ URL::to('/admin/group-config/create') }}@endif">
    @csrf
    <input type="hidden" name="uid" value="{{{ (isset($Group) ? $Group->id : null) }}}" />
    <input type="hidden" name="Redirect" value="https://google.com" />
    <input type="hidden" name="Status" value="A" />

    <div class="form-group">
        <label for="GroupType">Type Of Group <span class="text-danger">* @php if ($errors->has('Type')) { echo "Type is require";} @endphp </span></label>
        <select id="Type" name="Type" class="form-control" @if(isset($Group)) {{"disabled"}} @endif >
            <option value="G"@if(isset($Group)) @if($Group->Type == 'G')) {{"selected"}} @endif @endif>Hotel Room or Guest Inhouse</option>
            <option value="I"@if(isset($Group)) @if($Group->Type == 'I')) {{"selected"}} @endif @endif>Catering Function or Hotel Staff</option>
        </select>
    </div>

    <div class="form-group">
        <label for="Group Code">Group Code<span class="text-danger">*{{ $errors->first('GroupName')}}</span></label>
        <input type="text" name="GroupName" data-parsley-trigger="change" required placeholder="Enter group code" class="form-control" id="GroupName" value="@isset($Group){{$Group->GroupName}}@endisset"/>
    </div>

    <div class="form-group">
        <label>Group Description <span class="text-danger">*{{ $errors->first('Description')}}</span></label>
        <div>
            <input type="text" name="Description" data-parsley-trigger="change" required placeholder="Enter The name of group" class="form-control" id="Description" value="@isset($Group){{$Group->Description}}@endisset"/>
        </div>
    </div> 

    <div class="form-group">
        <label for="MaxConcurrent">Max Concurrent per login account <span class="text-danger">* @php if ($errors->has('MaxConcurrent')) { echo "MaxConcurrent is require";} @endphp </span></label>
        <input type="text" name="MaxConcurrent" data-parsley-trigger="change" required placeholder="Enter Concurrent Number" class="form-control" id="MaxConcurrent" value="@isset($Group){{$Group->MaxConcurrent}}@endisset" @if(isset($Group)) @if($Group->Type == 'I')) {{"disabled"}} @endif @endif/>
    </div>

    <div class="form-group">
        <label>Upload(Mbps) <span class="text-danger">*{{ $errors->first('Upload')}}</span></label>
        <div>
            <input type="text" class="form-control" name="Upload" placeholder="Upload" required class="form-control" value="@isset($Group){{$Group->Upload}}@endisset"/>
        </div>
    </div>

    <div class="form-group">
        <label>Download(Mbps) <span class="text-danger">*{{ $errors->first('Download')}}</span></label>
        <div>
            <input type="text" class="form-control" name="Download" placeholder="Download" required class="form-control" value="@isset($Group){{$Group->Download}}@endisset"/>
        </div>
    </div>

    <div class="form-group">
        <label for="more info">More Info<span class="text-danger">*{{ $errors->first('info')}}</span></label>
        <textarea required name ="info" class="form-control">@isset($Group){{$Group->info}}@endisset</textarea>        
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
