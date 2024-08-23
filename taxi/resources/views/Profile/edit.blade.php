@extends('template.admin')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center pt-5">
                <div class="col-lg-6 col-sm-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title"><strong>Profile update</strong></div>
                        </div>
                        <form method='POST' action="{{url($update_url)}}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"
                                           class="form-control mb-1 @error('name') is-invalid @enderror" id="name"
                                           placeholder="name" value="{{$user->name}}">
                                    <span class="error"> @error('name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone number</label>
                                    <input type="number" name="phone_number"
                                           class="form-control mb-1 @error('phone_number') is-invalid @enderror"
                                           id="phone_number"
                                           placeholder="phone number" value="{{$user->phone_number}}" disabled>
                                    <span class="error"> @error('phone_number'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email"
                                           class="form-control mb-1 @error('email') is-invalid @enderror" id="email"
                                           placeholder="email address" value="{{$user->email}}" disabled>
                                    <span class="error"> @error('email'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address"
                                           class="form-control mb-1 @error('address') is-invalid @enderror"
                                           id="address"
                                           placeholder="address"
                                           value="{{$user->address}}">
                                    <span class="error"> @error('address'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="bank_name">Bank name</label>
                                    <input type="text" name="bank_name"
                                           class="form-control mb-1 @error('bank_name') is-invalid @enderror"
                                           id="bank_name"
                                           placeholder="bank name"
                                           value="{{$user->bank_name}}">
                                    <span class="error"> @error('bank_name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="account_number">Account number</label>
                                    <input type="number" name="account_number"
                                           class="form-control mb-1 @error('account_number') is-invalid @enderror"
                                           id="account_number"
                                           placeholder="account_number"
                                           value="{{$user->account_number}}">
                                    <span class="error"> @error('account_number'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="picture">Profile Picture</label>
                                    <input type="file" accept="image/*" name="picture"
                                           class="form-control mb-1 @error('picture') is-invalid @enderror"
                                           id="picture"
                                           placeholder="picture"
                                           value="{{$user->picture}}">
                                    <span class="error"> @error('picture'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="" class="btn btn-danger ml-4">cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div id="map" style="width:500px; height: 500px;"></div>
            </div>
        </div>
        <button id="getLocationButton">Get Location</button>
    </div>
@endsection
