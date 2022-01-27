@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Remove by ID</div>
                <div class="card-body">
					<form method="get" action="{{ route('remove-dataset-confirm') }}">
						<div class="row mb-3">
    						<label for="datasetId" class="col-sm-2 col-form-label">Dataset ID(name)</label>
    						<div class="col-sm-10">
      							<input type="text" class="form-control" id="datasetId" name="datasetId">
    						</div>
  						</div>
  						<button type="submit" class="btn btn-primary">Search</button>
					</form>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">Remove by source</div>
                <div class="card-body">
					<form method="get" action="{{ route('remove-dataset-confirm') }}">
						<div class="row mb-3">
    						<label for="datasetSource" class="col-sm-2 col-form-label">Maintainer name</label>
    						<div class="col-sm-10">
      							<input type="text" class="form-control" id="datasetSource" name="datasetSource">
    						</div>
  						</div>
  						<button type="submit" class="btn btn-primary">Search</button>
					</form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
