@extends('layouts.app')

@section('content')
<style type="text/css"> 
  .name {font-size: 30px;border-bottom: 2px solid #888;margin-bottom: 20px;}.name:first-letter {font-size: 300%;}.label {width: 70px;font-weight: bold;}.label, .phone, .mobile, .email {display: inline-block;}.details-td {border-right: 1px solid #eee;white-space: nowrap;padding: 20px;padding-right: 30px;}.description-td {position: relative;width: 100%;padding: 20px;padding-left: 30px;padding-right: 30px;text-align: justify;margin-top: 15px;}.description {outline: 0px solid transparent;border: 0px solid transparent;}.edit {position: absolute;top: 0px;right: 0;width: 13px;height: 13px;cursor: pointer;}.update {display: none;position: absolute;right: 20px;bottom: 0;background: #c2e59c;border: 0;padding: 5px;width: 80px;color: #333;outline: 0px solid transparent;border: 0px solid transparent;}
  .description-books {
    justify-content: space-between;
    display: flex;
    margin: 6px 0;
}
a.btn.btn-danger.mt-4.float-right {
    float: right;
}
 
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Author Details') }}</div>

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

                    <table>
    <tr>
        <td colspan="3">
            <div class="name"> {{ $Details['first_name'] . ' ' . $Details['last_name'] }}</div>
        </td>
    </tr>
    <tr>
        <td class="details-td">
            <div class="label">Gender</div> : <div class="phone">{{ $Details['gender'] }} </div>
            <br><div class="label">DOB</div> : <div class="mobile">{{ $Details['birthday'] }}</div>
            <br><div class="label">Bio</div> : <div class="mobile">{{ $Details['biography'] }}</div>
            <br><div class="label">BirthPlace</div> : <div class="mobile">{{ $Details['place_of_birth'] }}</div> 
        </td>
        <td class="description-td">
            
            <label > <h3><strong class="text-center"> Author Books </strong></h3></label>
            @if(!empty($Details['books']))
            @foreach($Details['books']  as $book)
            <div class="description description-books" spellcheck="false"> 
            <div class="label">Book Title</div><div class="phone">{{ $book['title'] }} </div>
            <a class="btn btn-danger" href="{{ route('delete-book',['id' => $book['id'] ]) }}" > 
               Delete Book 
            </a>     
               

            </div>  
            @endforeach
            @else
            <br>
            <span><b>There is no Books for the author </b></span>
            <br>
            
            <a class="btn btn-danger mt-4 float-right" href="{{ route('delete-author',['id' => $Details['id'] ]) }}" target="_blank"> 
               Delete Author
            </a>
            @endif
            
            <!-- <input type="button" value="Update" class="update"> -->
        </td>
    </tr>
</table>

                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
