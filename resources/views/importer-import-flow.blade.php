@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#">Datasets</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('importer-imports-log', ['importer_id' => $importer_id, 'import_id' => $import_id]) }}">Mapping log</a>
          </li>          
        </ul>
        
            <div class="card">
                
                <div class="card-body">
					@if($sourceDatasetIdentifiers->count() > 0)
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>source dataset identifier</th>
									<th>source identifier</th>
									<th>source dataset</th>
									<th>create</th>
									<th>created_at</th>
								</tr>
							</thead>
							<tbody>
								@foreach($sourceDatasetIdentifiers as $sourceDatasetIdentifier)
								<tr data-bs-toggle="collapse" data-bs-target="#r-{{ $loop->iteration }}">
									<td>
										{{ $sourceDatasetIdentifier->id }} 
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
  											<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
										</svg> 
									</td>
									<td>
										{{ $sourceDatasetIdentifier->identifier }}
									</td>									
									
									<td>
										@if($sourceDatasetIdentifier->response_code == 200)
											<p class="text-success">success</p>
										@elseif(is_null($sourceDatasetIdentifier->response_code))
											<p class="text-primary">in queue</p>
										@else
											<p class="text-danger">error</p>
										@endif
									</td>
									
									<?php $sourceDataset = $sourceDatasetIdentifier->source_dataset ?>
									<td>
										@if($sourceDataset)
											@if($sourceDataset->status == 'succes')
    											<p class="text-success">success</p>
    										@elseif(is_null($sourceDataset->status))
    											<p class="text-primary">in queue</p>
    										@else
    											<p class="text-danger">error</p>
    										@endif
										@endif										
									</td>
									
									<?php if($sourceDataset) { $datasetCreate = $sourceDataset->dataset_create; } ?>
									<td>
										@if($datasetCreate)
											@if($datasetCreate->response_code == 200)
    											<p class="text-success">success</p>
    										@elseif(is_null($datasetCreate->response_code))
    											<p class="text-primary">in queue</p>
    										@else
    											<p class="text-danger">error</p>
    										@endif
										@endif
									</td>
									
									<td>{{ $sourceDatasetIdentifier->created_at }}</td>
								</tr>
								<tr class="collapse accordion-collapse" id="r-{{ $loop->iteration }}">
                    				<td colspan="6">
                    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam consequat mauris sit amet ornare 
                    					elementum. Etiam velit tortor, placerat at finibus et, dignissim et neque. Aliquam erat volutpat. 
                    					Quisque laoreet ornare mollis. Sed fringilla eget magna at varius. Donec condimentum semper lacus, 
                    					sit amet mattis tellus finibus nec. Pellentesque habitant morbi tristique senectus et netus et malesuada 
                    					fames ac turpis egestas. Sed egestas augue sit amet euismod volutpat. In quis porttitor tellus, pretium 
                    					commodo dolor. Praesent aliquam viverra nulla, sed accumsan sem euismod et. Aliquam eleifend ipsum non 
                    					interdum efficitur. Mauris sed pellentesque lacus. Cras eu nibh sed felis tempus faucibus nec ut lorem. 
                    					In iaculis feugiat rhoncus.
                    				</td>
                				</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<p>No sourcedata identifiers found.</p>
					@endif
                </div>
            </div>                                    
        </div>
    </div>
</div>
@endsection
