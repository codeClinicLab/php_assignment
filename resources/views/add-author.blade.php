@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Author') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                     @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
 
                    <form action="{{ route('store-author')}}" method="post">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>first name</label>
                                <input class="form-control" type="text" name="first_name" placeholder="first_name" required>
                            </div>

                            <div class="col-md-6">
                                <label>last name</label>
                                <input class="form-control" type="text" name="last_name" placeholder="last_name" required>
                            </div>
                            
                        </div>

                         <div class="row mt-2">
                            <div class="col-md-6">
                                <label>birthday</label>
                                <input class="form-control" type="date" name="birthday" placeholder="birthday" required>
                            </div>

                            <div class="col-md-6">
                                <label>biography</label>
                                <input class="form-control" type="text" name="biography" placeholder="biography" required>
                            </div>
                            
                        </div>

                         <div class="row mt-2">
                            <div class="col-md-6">
                                <label>gender</label>
                                <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio1" name="gender" value="male" checked>Male
                                <label class="form-check-label" for="radio1"></label>
                                </div>
                                <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio1" name="gender" value="Female">Female
                                <label class="form-check-label" for="radio1"></label>
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <label>place_of_birth</label>
                                <input class="form-control" type="text" name="place_of_birth" placeholder="place_of_birth" required>
                            </div>
                            
                        </div>
                         <div class="row mt-5">
                        <button class="btn btn-primary "> Save </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
