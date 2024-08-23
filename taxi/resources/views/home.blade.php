@extends('template.admin')
@section('content')
    <div class="content-wrapper">
@auth('driver')
    <h1>HI, you're logged in</h1>
@endauth
    </div>
@endsection
