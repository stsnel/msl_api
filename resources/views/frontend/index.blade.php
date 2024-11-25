<x-layout_main>
    <div
    class="hero h-dvh"
    style="background-image: url('images/heros/7.jpg');">
      <div class="hero-content text-neutral-content text-center grid w-full">
        <div class="index-opacity-parent">
          <h1 class="index-opacity-child">Welcome </h1>
          <p class="index-opacity-child pb-8">
              to the EPOS Multi-Scale Labs data catalogue! This catalogue is the central access point for Earth scientific laboratory data in Europe. 
              Here you can find data from rock and melt physics, paleomagnetism, geochemistry, microscopy, tomography and analogue modelling of geological processes. 
          </p>
          <a href="{{ route('data-access') }}">
            <button class="btn btn-primary btn-lg btn-wide index-opacity-child">Data Access</button>
          </a>
          

          <div class="index-opacity-child p-8">
            
            <p class="">
              {{ $result->getTotalResultsCount() }} datasets
            </p>
            <p class="">
              86 labs
            </p>
            <p class="">
              6 data repositories
            </p>
          </div>

        </div>

        {{-- <div class="index-opacity-parent h-max">

        </div> --}}

      </div>
       
    </div>
</x-layout_main>

