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
                <div class="card-header">Upload materials file</div>
                <div class="card-body">
					<form action="{{ route('process-materials-file') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="mb-3">
                        	<label for="formFile" class="form-label">Materials xlsx file</label>
                        	<input class="form-control" type="file" id="formFile" name="materials-file">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Upload file</button>
					</form>
                </div>
            </div>
            
            <div class="card mt-5">
                <div class="card-header">Upload rock physics file</div>
                <div class="card-body">
					<form action="{{ route('process-rockphysics-file') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="mb-3">
                        	<label for="formFile" class="form-label">Rockphysics xlsx file</label>
                        	<input class="form-control" type="file" id="formFile" name="rockphysics-file">
                        </div>
                        <div class="mb-3">
                        	<label for="sheet" class="form-label">Select sheet to export</label>
                        	<select class="form-select" aria-label="Default select example" id="sheet" name="sheet">  								
                          		<option value="apparatus">Apparatus</option>
                          		<option value="ancillary">Ancillary equipment</option>
                          		<option value="pore">Pore fluid</option>
                          		<option value="measured">Measured property</option>
                          		<option value="inferred">Inferred deformation behavior</option>
							</select>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload file</button>
					</form>
                </div>
            </div>                                    
        </div>
    </div>
</div>
@endsection
