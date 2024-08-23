@extends('template.app')
@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title"><strong>Register</strong></div>
                        </div>
                        <form method='POST' action="{{url($registerRoute)}}">
                            @csrf
                            @method('POST')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"
                                           class="form-control mb-1 @error('name') is-invalid @enderror" id="name"
                                           placeholder="name">
                                    <span class="error"> @error('name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone number</label>
                                    <input type="number" name="phone_number"
                                           class="form-control mb-1 @error('phone_number') is-invalid @enderror"
                                           id="phone_number"
                                           placeholder="phone number">
                                    <span class="error"> @error('phone_number'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email"
                                           class="form-control mb-1 @error('email') is-invalid @enderror" id="email"
                                           placeholder="email address">
                                    <span class="error"> @error('email'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password"
                                           class="form-control mb-1 @error('password') is-invalid @enderror"
                                           id="password"
                                           placeholder="Password">
                                    <span class="error"> @error('password'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm password</label>
                                    <input type="password" name="password_confirmation"
                                           class="form-control mb-1 @error('password_confirmation') is-invalid @enderror"
                                           id="confirm_password"
                                           placeholder="confirm password">
                                    <span class="error"> @error('password_confirmation'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group ">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input mb-1"
                                               id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">remember me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <div class="card-footer">
                            Already have an account?
                            <a class="text-primary ml-1" href="{{url($login)}}"><b>Login</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
