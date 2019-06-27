@extends('layouts.app')
@section('title', 'Serviços')
@push('styles')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
      type="text/css"/>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <div class="col-12 mb-3">
                <a href="{{ route('services.create') }}" class="btn btn-custom waves-light waves-effect">Novo</a>
            </div>
            <table id="datatable" class="table table-bordered">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th style="width: 5%">Ações</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
<script type="text/javascript">"use strict";
    $(document).ready(function () {
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "method": "POST",
                "url": "{{ route('services.ajax.datatables') }}",
                "dataType": "json"
            },
            "columns": [
                {"data": "name"},
                {"data": "actions", "searchable": false, "orderable": false}
            ]
        });
    });
</script>
@endpush