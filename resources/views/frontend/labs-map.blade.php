<x-layout_main>
    <div class="flex justify-center items-center ">
        <div role="tablist" class="tabs tabs-lifted">
            <a role="tab" href="{{ route('labs-map') }}" class="tab tab-active">Laboratories map</a>
            <a role="tab" href="{{ route('labs-list') }}" class="tab">Laboratories list</a>
            <a role="tab" href="{{ route('equipment-map') }}" class="tab">Equipment map</a>
            <a role="tab" href="{{ route('equipment-list') }}" class="tab">Equipment list</a>
        </div>
    </div>

    <div class="flex justify-center items-center p-10 ">
        {{-- a general no small width view notification --}}
        <div class="block md:hidden">
            no mobile yo
        </div>

        {{-- make this part a component for this page and Labs --}}

        <div class="hidden md:block grow max-w-screen-2xl ">
            <div class="flex w-full justify-center">


                <div class="border-r-2 w-3/12 min-w-64 bg-base-300 flex flex-col place-items-center justify-self-center">

                    <div class='w-full mx-auto p-4 flex flex-col '>
                        <div class="relative flex items-center w-full h-12 rounded-lg focus-within:shadow-lg overflow-hidden">
                            
                            <div class="grid place-items-center h-full w-12 ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                    
                            <input
                            class="peer h-full w-full outline-none text-sm pr-2"
                            type="text"
                            id="search"
                            placeholder="Search Filters.." /> 

                        </div>

                        <div>
                            <h2>Filters</h1>

                            <div id="jstree-laboratories" class="text-wrap"></div>
                        </div>

                    </div>

                    
                        <script>
                            var dataLaboratories = @php echo File::get(base_path('public/laboratories.json')) @endphp;
                            var facets = @php echo json_encode($result->getFacets()); @endphp;
                            var activeFilters = @php echo json_encode($activeFilters); @endphp;
                            var activeNodes = [];

                        </script>

                    @push('vite')
                        @vite(['resources/js/jquery.js', 'resources/js/jstree.js', 'resources/js/filters-menu-labs.js'])
                    @endpush
                    

                </div>
                
                <div class="bg-base-300  grow">
                    <div class="w-full flex flex-col">

                    <div id="map" style="height: 700px;"></div>

                    <script>
        				function onEachFeature(feature, layer) {
                            if (feature.properties) {                                
                                var popupContent = `<h5>${feature.properties.title}</h5><p>${feature.properties.msl_organization_name}</p><a href="">view lab information</a>`;

                                layer.bindPopup(popupContent);
                            }
                        }
        			
        				var features = <?php echo json_encode($locations); ?>;        				
        			
        				var map = L.map('map').setView([51.505, -0.09], 4);
        				
        				L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);
                        
                        for (feature of features) {
							L.geoJSON(feature, {
								onEachFeature: onEachFeature
							}).addTo(map);        					
        				}
                        
        			</script>

                        
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>
       
        


    </div>




</x-layout_main>