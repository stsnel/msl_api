<x-layout_main >
    <div class="flex justify-center items-center flex-col">
        <h1>About MSL</h1>

            <div class="max-w-screen-xl flex flex-col md:flex-row p-10 gap-6" 
            >
                <div class="max-w-screen-xl flex flex-col gap-6 w-full h-full ">
            
                    <div class="w-full card bg-base-300 shadow-xl p-4 flex flex-col justify-between">
                        <h2 class="">Your data in the EPOS MSL data catalogue?</h2>
                        <p class="pr-10 pl-10">You can ensure that our data catalogue finds it by publishing your data at one of the MSL-affilated data repositories. In doubt? Contact us.</p>
                    </div>
    
                    <div class="w-full card bg-base-300 shadow-xl p-4 flex flex-col justify-between">
                        <h2>Your lab in the EPOS Multi-Scale Labs community?</h2>
                        <p class="pr-10 pl-10">Perhaps it already is (have a look at the MSL labs)! If not, and would you like to explore how you could do so? Get in touch with MSL coordinator Geertje ter Maat. </p>
                    </div>
                </div>
                <div class="w-full card bg-base-300 shadow-xl p-4 flex flex-col justify-around">
                    <h2>EPOS central data portal</h2>
                    <p class="p-10">MSL data can be found in the MSL data catalogue on this website, and in the EPOS multi-disciplinary data portal (ICS-C), 
                        alongside data from other solid Earth scientific disciplines, including seismology, geology, volcanology, satellite observations and others. </p>
                </div>
            
        </div>
        
        <img 
            src= {{ asset('images/heros/about.png') }}
            alt="aboutImage"
            class="object-contain max-w-lg p-10">

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
            <p>
                Data from geochemical measurements: 
                <ul class="list-disc list-inside">                    
                    <li>Volcanic ash from explosive eruptions</li>
                    <li>Magmas in the context of eruption and lava-flow hazard evaluation</li>
                    <li> Rock systems of key importance in mineral exploration and mining operations</li>
                </ul>
            </p>
            <p>
                Data from rock and melt physical properties: 
                <ul class="list-disc list-inside">                    
                    <li>Rock and fault properties of importance for modelling and forecasting natural and induced subsidence, seismicity and associated hazards</li>
                    <li>Crustal and upper mantle rheology as needed for modelling sedimentary basin formation and crustal stress distributions</li>
                    <li>The composition, porosity and permeability of reservoir rocks of interest in relation to unconventional resources, fluid storage and geothermal energy</li>
                </ul>
            </p>
            <p>
                Data from analogue modelling of geological processes: 
                <ul class="list-disc list-inside">                    
                    <li>From reservoir (km) to tectonic plate (global) scale</li>
                    <li>To study and visualize the fundamental processes underlying crustal and mantle deformation processes, including fault formation, mountain building and sedimentary basin evolution</li>
                </ul>
            </p>
            <p>
                Data from magnetic and paleomagnetic measurements:
                <ul class="list-disc list-inside">                    
                    <li>Understanding the evolution of sedimentary basins and associated resources</li>
                    <li>Charting geo-hazard frequency</li>
                </ul>
            </p>
            <p>
                Microscopy and tomography data: 
                <ul class="list-disc list-inside">                    
                    <li>Image data of Earth materials obtained with a wide variety in techniques</li>
                    <li>Aimed at analyzing the process, often occurring at nano- to micrometer scale, governing the physical, chemical and transport behavior of Earth materials</li>
                </ul>
            </p>
            <p>
                Data from geo-energy test beds: 
                <ul class="list-disc list-inside">                    
                    <li>The latest addition to Multi-Scale Labs includes:</li>
                    <li>Data obtained in testing or monitoring field-scale subsurface applications aimed at curbing CO2 emissions. Such applications include subsurface storage of fluids (H, N, CO2, hot water), or geothermal energy production.</li>
                    <li>Data can include fibre optics sensing data (DAS, DSS, DTS), seismological data, electromagnetics.</li>
                    
                </ul>
            </p>
            
        </div>
    </div>


  
  </x-layout_main>