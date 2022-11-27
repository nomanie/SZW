@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-lg-2">
            @include('admin.global.sidebar')
        </div>
        <div class="col-lg-10" style="background: #ececec;">
            <car-brands></car-brands>
            {{$dataTable->table()}}
            @push('scripts')
                {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
            @endpush
        </div>
    </div>
    <div id='car-brand-toast' class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="position: absolute; top: 0; right: 0;">
        <div class="toast-header">
            <strong class="mr-auto">Komunikat</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Hello, world! This is a toast message.
        </div>
    </div>
@endsection
