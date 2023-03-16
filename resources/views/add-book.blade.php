@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Book') }}</div>

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
 
                    <form action="{{ route('store-book')}}" method="post">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Author</label>
                                <select class="form-control" required name="author_id"> 
                                    @foreach($authors['items'] as $author)
                                    <option value="{{ $author['id'] }}"> {{ $author['first_name'] . ' ' . $author['last_name'] }}</option>
                                    @endforeach
                                </select>
                               
                            </div>
                              <div class="col-md-3">
                                <label>Title</label>
                                  <input class="form-control" type="text" name="title" placeholder="title" required>
                            </div>


                            <div class="col-md-3">
                                <label>Realease Date</label>
                                <input class="form-control" type="date" name="release_date" placeholder="release_date" required>
                            </div>

                           
                            
                        </div>

                         <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Description</label>
                                <input class="form-control" type="text" name="description" placeholder="description" required>
                            </div>

                            <div class="col-md-6">
                                <label>isbn</label>
                                <input class="form-control" type="text" name="isbn" placeholder="isbn" required>
                            </div>
                            
                        </div>

                         <div class="row mt-2">
                             

                            <div class="col-md-6">
                                <label>Format</label>
                                <input class="form-control" type="text" name="format" placeholder="format" required>
                            </div>

                            <div class="col-md-6">
                                <label>Number of Pages </label>
                                <input class="form-control" type="number" name="number_of_pages" placeholder="1" required>
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
