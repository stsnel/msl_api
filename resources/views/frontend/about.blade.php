<x-layout_main >
    <div class="flex justify-center items-center flex-col">
        <h1 class="pt-20">About MSL</h1>

            <div class="max-w-screen-lg flex flex-col md:flex-row p-10 gap-6" 
            >
                <div class="max-w-screen-xl flex flex-col gap-6 w-full h-full ">
            
                    <div class="w-full card bg-base-300 shadow-xl p-4 flex flex-col justify-between">
                        <h4 class="">Your data in the EPOS MSL data catalogue?</h4>
                        <p class="pr-10 pl-10">You can ensure that our data catalogue finds 
                            it by publishing your data at one of the MSL-affilated data repositories. 
                            In doubt? Contact us.</p>
                    </div>
    
                    <div class="w-full card bg-base-300 shadow-xl p-4 flex flex-col justify-between">
                        <h4>Your lab in the EPOS Multi-Scale Labs community?</h4>
                        <p class="pr-10 pl-10">Perhaps it already is (have a look at the MSL labs)! If not, 
                            and would you like to explore how you could do so? Get in touch with MSL 
                            coordinator Geertje ter Maat. </p>
                    </div>
                </div>
                <div class="w-full card bg-base-300 shadow-xl p-4 flex flex-col justify-center">
                    <h4>EPOS central data portal</h4>
                    <p class="pr-10 pl-10">MSL data can be found in the MSL data catalogue on this website, 
                        and in the EPOS multi-disciplinary data portal (ICS-C), 
                        alongside data from other solid Earth scientific disciplines, including seismology, 
                        geology, volcanology, satellite observations and others. </p>
                </div>
            
            </div>
        

        {{-- Vision
        We strive to create the best earth science laboratory data service to 
        support Geo-scientists in their scientific endeavor and 
        to facilitate knowledge exchange between them

        Mission
        Our mission is to support your research into Earth system behavior, 
        by providing you with data, models and expertise on 
        rock properties and processes, building on standards and tools developed with the community. --}}

        <img 
            src= {{ asset('images/heros/about.png') }}
            alt="aboutImage"
            class="object-contain max-w-lg p-10">

            <div class="max-w-screen-lg flex flex-col md:flex-row p-10 gap-6" 
            >
                <div class="w-full card bg-base-300 shadow-xl p-4 flex flex-col justify-start ">
                    <h4>Our Vision</h4>
                    <p class="pr-10 pl-10">We strive to create the best earth science laboratory data service to 
                        support Geo-scientists in their scientific endeavor and 
                        to facilitate knowledge exchange between them. </p>
                </div>
                <div class="w-full card bg-base-300 shadow-xl p-4 flex flex-col justify-start ">
                    <h4>Our Mission</h4>
                    <p class="pr-10 pl-10">Our mission is to support your research into Earth system behavior, 
                        by providing you with data, models and expertise on 
                        rock properties and processes, 
                        building on standards and tools developed with the community. </p>
                </div>
            
            </div>

        <div class="max-w-screen-md">
            <p>
                In a world that demands increasing collaboration within the scientific community, 
                solid Earth science laboratories are challenged with finding each other to exchange best practices and re-use data. 
                Data produced by the various laboratories are crucial to serving society’s needs for geo-resources exploration and for protection against geo-hazards. 
                Indeed, to model resource formation and system behaviour during exploitation, we need an understanding from the molecular to the continental scale, based on experimental and analytical data.
                    Therefore, coordination and communication inside the European solid Earth science laboratories, 
                complemented with services to increase curation and access for re-use of laboratory data is needed to effectively contribute to solve the grand challenges facing society. 
            </p>
            <p>
                The <a class="link" href="https://www.epos-eu.org/tcs/multi-scale-laboratories">EPOS Multi-Scale Laboratories (MSL)</a> community includes a wide range of world-class laboratories. 
                The length scales addressed by these infrastructures cover the nano- and micrometre levels (electron microscopy and micro-beam analysis) 
                to the scale of experiments on centimetre and decimetre sized samples, to analogue model experiments simulating the reservoir scale, the basin scale and the plate scale. 
            </p>
            <p>
                EPOS MSL collects and harmonizes available and emerging laboratory (meta)data on the properties and processes controlling rock system behaviour at scales ranging from nm to km to global. 
                The aim is to generate data products that are easily findable, accessible and interoperable for future research, notably into Geo-resources, Geo-storage, Geo-hazards 
                and Earth System Evolution. Data emerging from MSL labs can be categorized as below, following the six major sub-domains in MSL:  
            </p>


          


            
        </div>

        @php
        $infoList = [
          array(
            "name"=>"Data from geochemical measurements", 
            "listItems"=>array(
                "Volcanic ash from explosive eruptions",
                "Magmas in the context of eruption and lava-flow hazard evaluation",
                "Rock systems of key importance in mineral exploration and mining operations"
            )
          ),
          array(
            "name"=>"Data from rock and melt physical properties", 
            "listItems"=>array(
                "Rock and fault properties of importance for modelling and forecasting natural and induced subsidence, seismicity and associated hazards",
                "Crustal and upper mantle rheology as needed for modelling sedimentary basin formation and crustal stress distributions",
                "The composition, porosity and permeability of reservoir rocks of interest in relation to unconventional resources, fluid storage and geothermal energy"
            )
          ),
          array(
            "name"=>"Data from analogue modelling of geological processes", 
            "listItems"=>array(
                "From reservoir (km) to tectonic plate (global) scale",
                "To study and visualize the fundamental processes underlying crustal and mantle deformation processes, including fault formation, mountain building and sedimentary basin evolution",
            )
          ),
          array(
            "name"=>"Data from magnetic and paleomagnetic measurements", 
            "listItems"=>array(
                "Understanding the evolution of sedimentary basins and associated resources",
                "Charting geo-hazard frequency",
            )
          ),
          array(
            "name"=>"Microscopy and tomography data", 
            "listItems"=>array(
                "Image data of Earth materials obtained with a wide variety in techniques",
                "Aimed at analyzing the process, often occurring at nano- to micrometer scale, governing the physical, chemical and transport behavior of Earth materials",
            )
          ),
          array(
            "name"=>"Data from geo-energy test beds", 
            "listItems"=>array(
                "The latest addition to Multi-Scale Labs includes:",
                "Data obtained in testing or monitoring field-scale subsurface applications aimed at curbing CO2 emissions. Such applications include subsurface storage of fluids (H, N, CO2, hot water), or geothermal energy production",
                "Data can include fibre optics sensing data (DAS, DSS, DTS), seismological data, electromagnetics"
            )
          ),


        ]
      
      @endphp

        <div class="max-w-screen-lg flex md:flex-row flex-wrap p-10 gap-4 justify-between">
            @foreach ($infoList as $infoElement)
                <div class="dropdown dropdown-hover p-4">
                    <div tabindex="0" role="button" class="m-1 p-4 bg-base-300 rounded-lg w-64 h-24 place-content-center"> 
                        <h5 class="text-base font-normal">{{ $infoElement["name"] }}</h5>
                        {{-- <h5>
                            <svg  class="h-6 w-6 secondary" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                viewBox="0 0 490.03 490.03" xml:space="preserve">
                                <path d="M245.015,490.015L490.03,234.132l-69.802-69.773L490.03,91.46L398.548,0.015L245.015,160.352L91.482,0.015L0,91.46
                                    l69.802,72.899L0,234.132L245.015,490.015z M42.904,91.924l48.099-48.076l154.012,160.831L399.027,43.847l48.099,48.076
                                    L245.015,303.009L42.904,91.924z M91.003,186.52l154.012,160.846L399.027,186.52l48.099,48.076L245.015,445.674L42.904,234.596
                                    L91.003,186.52z"/>
                            </svg>
                        </h5> --}}
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-300 rounded-box z-[1] p-2 shadow-xl w-96 ">
                        @foreach ( $infoElement["listItems"] as $listItem)
                            <li class="p-2">{{ $listItem }}</li> 
                        @endforeach
                    </ul>
                </div>
            @endforeach
        
        </div>

    </div>


  
  </x-layout_main>