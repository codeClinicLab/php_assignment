@extends('layouts.app')

@section('content')
<style type="text/css">
    .card-header {
    justify-content: space-between;
    display: flex;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Author List') }}
                     <a class="btn btn-primary" href="{{ route('add-author') }}"> Add Author </a>
                     
                </div>

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


                    <table id="author-list" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First</th>
                                <th>Last</th>
                                <th>Birth</th>
                                <th>Gender</th>
                                <th>BirthPlace</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['items'] as $items )

                             {{-- @php  
                           $bookCount = 0; 
                               foreach ($books['items'] as $key => $book){ 
                                    if(in_array($items['id'],$book)){
                                        $bookCount++;
                                    }  
                               } 
                            @endphp --}} 
                        <tr>
                            <td>{{ $items['id'] }}</td>
                            <td>{{ $items['first_name'] }}</td>
                            <td>{{ $items['last_name'] }}</td>
                            <td>{{ $items['birthday'] }}</td>
                            <td>{{ $items['gender'] }}</td>
                            <td>{{ $items['place_of_birth'] }}</td> 
                            <td>
                                 <a  class="btn btn-warning" href="{{ route('author-details',['id' => $items['id']]) }}">
                                    View Author
                                 </a> 

                            </td>
                             
                        </tr>
                        @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>


 
@endsection

@section('page-script')

<script type="text/javascript">
    $(document).ready(function () {
    $('#author-list').DataTable();
});
</script>
@endsection