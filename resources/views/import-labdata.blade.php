@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        	<div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        	</div>
        
            <div class="card">
                <div class="card-header">Import labdata</div>
                <div class="card-body">
					<form method="post" action="{{ route('update-fast-data') }}">
                  		@csrf
                  		<button type="submit" class="btn btn-primary">Update data from FAST</button>
                  	</form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
