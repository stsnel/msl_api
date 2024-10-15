<x-layout_main >
  @php
  $repos = [
    array(
      "name"=>"MagIC", 
      "imageLink"=>'images/repositories/Magic.png',
      "repoLink"=>''
    ),
    array(
      "name"=>"British Geological Survey - National Geoscience Data Centre (UKRI/NERC)", 
      "imageLink"=>'images/repositories/BGS.png',
      "repoLink"=>''
    ),
    array(
      "name"=>"4TU.ResearchData", 
      "imageLink"=>'images/repositories/4tu-logo.png',
      "repoLink"=>''
    ),
    array(
      "name"=>"Digital.CSIC", 
      "imageLink"=>'images/repositories/CSIC.jpg',
      "repoLink"=>''
    ),
    array(
      "name"=>"GFZ data services", 
      "imageLink"=>'images/repositories/GFZ-Data-Services-logo.png',
      "repoLink"=>''
    ),
    array(
      "name"=>"Yoda data services", 
      "imageLink"=>'images/repositories/YodaUU.png',
      "repoLink"=>''
    )  
  ]

@endphp



{{-- @foreach ($repositories as $repo)
  {{ $repo }}
@endforeach --}}



    <div class="flex flex-col justify-center items-center p-10">
        <h2 class="p-10">
            Data repositories</h2>
        <div class="flex w-10/12 2xl:w-2/3 flex-wrap justify-center gap-4">

            
          @foreach ($repositories as $repo)
            @if ($repo["hide"] == "false")

              <div class="card bg-base-300 w-64 h-64 shadow-xl flex justify-between flex-col p-2">
                <figure>
                  <img
                  class="h-48 object-contain"
                  src= {{ asset( $repo["image_url"]) }}
                    alt={{ $repo["organization_display_name"] }} />
                </figure>
                <div class="card-body p-2">
                  <h2 class="text-center">
                    {{ $repo["organization_display_name"] }}
                    {{-- <div class="badge badge-secondary">NEW</div> --}}
                  </h2>
                </div>
                <button class="btn btn-primary">View Datasets</button>

              </div>
            @endif
            
          @endforeach
        </div>
        

    </div>
    


</x-layout_main>