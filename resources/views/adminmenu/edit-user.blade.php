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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@isset($user){{$user->name}}@endisset{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@isset($user){{$user->email}}@endisset{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('User Permission') }}</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="usertype" @isset($user) @php if($user->type == 0){ echo "checked";} @endphp @endisset value ="0"> System Admin</label>
                                <label class="radio-inline"><input type="radio" name="usertype" @isset($user) @php if($user->type == 1){ echo "checked";} @endphp @endisset value ="1"> Front Office</label>
                                <label class="radio-inline"><input type="radio" name="usertype" @isset($user) @php if($user->type == 2){ echo "checked";} @endphp @endisset value ="2"> Disable User</label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <button type="reset" class="btn btn-secondary m-l-5" onclick="parent.jQuery.fancybox.close();">
                                    Cancel
                                </button>    
                            </div>
                        </div>
                    </form>

@endsection
