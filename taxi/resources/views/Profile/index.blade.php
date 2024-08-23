@extends('template.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header ml-md-5 ml-sm-3 ml-2 ">
            <div class="row ">
                <h1 class="text-danger"><strong>Profile</strong></h1>
                <a class=" ml-auto mr-5 " href="{{url($edit_url)}}"><i class=" fas fa-edit"></i></a>
            </div>
        </section>
        <hr>
        <div class="container text-lg">
            <div class="row justify-content-center">
                <div class="image">
                    <img class="img-circle" src="{{asset($user->picture)}}" width="200px" height="200px">
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <span class="text-bold ">Name :</span>
                <span>{{$user->name}} </span>
            </div>
            <hr>
            <div class="row justify-content-center">
                <span class="text-bold ">Email address : </span>
                <span>{{$user->email}} </span>
            </div>
            <hr>
            <div class="row justify-content-center">
                <span class="text-bold ">Phone Number :</span>
                <span>{{$user->phone_number}} </span>
            </div>
            <hr>
            <div class="row justify-content-center">
                <span class="text-bold ">Address : </span>
                <span>{{$user->address??'nill'}} </span>
            </div>
            <hr>
            <div class="row justify-content-center">
                <span class="text-bold ">Bank name : </span>
                <span>{{$user->bank_name??'nill'}} </span>
            </div>
            <hr>
            <div class="row justify-content-center">
                <span class="text-bold ">Account number :</span>
                <span>{{$user->account_number??'nill'}} </span>
            </div>
            <hr>
            <div class="row justify-content-center">
                <span class="text-bold ">Rating :</span>
                <span>{{$user->account_number??'nill'}} </span>
            </div>
            <hr>
        </div>
    </div>
@endsection
