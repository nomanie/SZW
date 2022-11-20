@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-lg-2">
            @include('admin.global.sidebar')
        </div>
        <div class="col-lg-10" style="background: #ececec;">
            <car-brands></car-brands>
        </div>
    </div>
@endsection
