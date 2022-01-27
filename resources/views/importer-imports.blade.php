@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <h1>Imports for importer {{ $importer->name }}</h1>
            <div class="card">
                <div class="card-header">Imports</div>
                <div class="card-body">
					@if($imports->count() > 0)
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>identifiers</th>
									<th>source datasets</th>
									<th>creates</th>
									<th>created_at</th>
									<th>actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($imports as $import)
								<tr>
									<td>{{ $import->id }}</td>
									<td>4/4</td>
									<td>3/4</td>
									<td>3/4</td>
									<td>{{ $import->created_at }}</td>
									<td><a href="{{ route('importer-imports-flow', ['importer_id' => $importer->id, 'import_id' => $import->id]) }}">View flow in detail</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<p>No imports in queue.</p>
					@endif
                </div>
            </div>                                    
        </div>
    </div>
</div>
@endsection
