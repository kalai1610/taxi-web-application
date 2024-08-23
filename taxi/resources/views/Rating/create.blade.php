@extends('template.admin')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center pt-5">
                <div class="col-lg-6 col-sm-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title"><strong>Rating</strong></div>
                        </div>
                        <form method='POST' action="{{url('/customer/ride/'.$ride_id.'/rating')}}">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <div>
                                    <div class="text-lg text-bold mb-4">Rating</div>
                                    <div class="row">
                                        <div class="col-lg-1 col-2 text-center">
                                            <label for="1">1</label>
                                            <input type="radio" name="rating"
                                                   class="form-control @error('rating') is-invalid @enderror" id="1"
                                                   value="1"></div>
                                        <div class="col-lg-1 col-2 text-center">
                                            <label for="2">2</label>
                                            <input type="radio" name="rating"
                                                   class="form-control  @error('rating') is-invalid @enderror" id="2"
                                                   value="2">
                                        </div>

                                        <div class="col-lg-1 col-2 text-center">
                                            <label for="3">3</label>
                                            <input type="radio" name="rating"
                                                   class="form-control  @error('rating') is-invalid @enderror"
                                                   id="3"
                                                   value="3">
                                        </div>
                                        <div class="col-lg-1 col-2 text-center">
                                            <label for="4">4</label>
                                            <input type="radio" name="rating"
                                                   class="form-control @error('rating') is-invalid @enderror"
                                                   id="4"
                                                   value="4">
                                        </div>
                                        <div class="col-lg-1 col-2 text-center">
                                            <label for="5">5</label>
                                            <input type="radio" name="rating"
                                                   class="form-control mb-5 @error('rating') is-invalid @enderror"
                                                   id="5"
                                                   value="5">
                                        </div>
                                        <span class="error"> @error('rating'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-lg text-bold">Feedback</label>
                                    <input type="text" class="form-control " name="feedback" id="feedback"
                                           placeholder="Feedback">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Submit</button>
                                <a href="{{url('/customer/ride/rating')}}" class="btn btn-danger ml-4">cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
