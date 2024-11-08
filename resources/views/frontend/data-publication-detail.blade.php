<x-layout_main>

    <div class="flex justify-center items-center p-10 ">

        {{-- a general no small width view notification --}}
        <div class="block md:hidden">
            no mobile yo
        </div>

        <div class="hidden md:block grow max-w-screen-2xl">
            <div class="flex w-full justify-center min-h-screen">

                <?php /* dd($data); */ ?>
                
                <div class="bg-base-300  grow">
                    <div class="w-full flex flex-col">
    
                        <div class=" flex flex-col place-items-center">
                            <div class="divide-y divide-slate-700 p-4 flex flex-col place-items-center max-w-screen-lg ">
                                <div class=" w-full pt-5 pb-5">
                                    <h1 class="text-lg">{{ $data['title'] }}</h1>
                                    <p class="italic text-center">                                       
                                        @foreach ( $data['msl_authors'] as $author )
                                            {{ $author["msl_author_name"] }}
                                        @endforeach 
                                    </p>
                                </div>
                                
                                <div class=" w-full pt-5 pb-5">
                                    <p class="">{{ $data['msl_publisher'] }} ({{ $data['msl_publication_year'] }})</p>
                                    <p>
                                        {!! $data['msl_notes_annotated'] !!}
                                    </p>
                                </div >
                                    
                                
                                <div class="w-full pt-5 pb-5">
                                    <h4 class="text-left">Keywords</h4>

                                    @if (array_key_exists("msl_tags", $data))
                                        <br>
                                        <details class="collapse collapse-arrow bg-base-200">
                                        <summary class="collapse-title">Originally assigned keywords <i id="orginal-keywords-popup">i</i></summary>
                                        <div class="collapse-content">
                                            @foreach ( $data['msl_tags'] as $keyword)
                                                <div 
                                                    class="badge badge-outline hover:bg-slate-500 badge-lg"
                                                    data-highlight="tag" 
                                                    data-uri="{{ json_encode($keyword['msl_tag_uris']) }}"
                                                >
                                                    {{ $keyword['msl_tag_string'] }}
                                                </div>
                                            @endforeach
                                        </div>
                                        </details>
                                        <script>
                                            tippy('#orginal-keywords-popup', {
                                                content: "lists only keywords originally assigned by the authors",
                                                placement: "right"
                                            });                                    
                                        </script>
                                    @endif

                                    

                                    @if (array_key_exists("msl_original_keywords", $data))
                                        <br>
                                        <details class="collapse collapse-arrow bg-base-200">
                                        <summary class="collapse-title">Corresponding MSL vocabulary keywords <i id="corresponding-keywords-popup">i</i></summary>
                                        <div class="collapse-content">
                                            @foreach ( $data['msl_original_keywords'] as $keyword)
                                                <div 
                                                    class="badge badge-outline hover:bg-slate-500 badge-lg"
                                                    data-uri="{{ $keyword['msl_original_keyword_uri'] }}"
                                                >
                                                    {{ $keyword['msl_original_keyword_label'] }}
                                                </div>
                                            @endforeach
                                        </div>
                                        </details>
                                        <script>
                                            tippy('#corresponding-keywords-popup', {
                                                content: "lists terms from MSL vocabularies that are the same as, or are interpreted synonymous to the originally assigned keywords",
                                                placement: "right"
                                            });
                                        </script>
                                    @endif

                                    @if (array_key_exists("msl_enriched_keywords", $data))
                                    <br>
                                    <details class="collapse collapse-arrow bg-base-200" open>
                                    <summary class="collapse-title">MSL enriched keywords <i id="enriched-keywords-popup">i</i></summary>
                                    <div class="collapse-content">
                                        @foreach ( $data['msl_enriched_keywords'] as $keyword)
                                            <div 
                                                class="badge badge-outline hover:bg-slate-500 badge-lg" 
                                                data-associated-subdomains='["{{ implode(', ', $keyword['msl_enriched_keyword_associated_subdomains']) }}"]'
                                                data-uri="{{ $keyword['msl_enriched_keyword_uri'] }}"
                                            >
                                                {{ $keyword['msl_enriched_keyword_label'] }}
                                            </div>
                                        @endforeach
                                    </div>
                                    </details>
                                    <script>
                                        tippy('#enriched-keywords-popup', {
                                            content: "MSL enriched keywords include MSL vocabulary terms corresponding to the keywords originally assigned by the authors, parent terms, and MSL vocabulary terms corresponding to words used in the data publication title and abstract. In enriching keyword sets like this, MSL strives to make datasets more findable. See anything odd? Contact us at epos.msl.data@uu.nl. MSL vocabularies available on GitHub - see top tab ‘vocabularies'.",
                                            placement: "right"
                                        });
                                    </script>
                                    @endif
                                </div>

                                @if (array_key_exists("msl_subdomains_original", $data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">MSL original sub domains</h4>

                                    </div>
                                    <div class="flex flex-col w-full ">
                                        {{-- hover behaviour: highlights all related tags above --}}
                                        @foreach ( $data['msl_subdomains_original'] as $keyword)
                                            <div class="badge badge-outline hover:bg-slate-500 badge-lg">{{ $keyword['msl_subdomain_original'] }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_subdomains",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">MSL enriched sub domains <i id="enriched-subdomains-popup">i</i></h4>

                                    </div>
                                    <div class="flex flex-col w-full ">
                                        {{-- hover behaviour: highlights all related tags above --}}
                                        @foreach ( $data['msl_subdomains'] as $keyword)
                                            <div 
                                                class="badge badge-outline hover:bg-slate-500 badge-lg" 
                                                data-toggle="domain-highlight"
                                                data-domain="{{ $keyword['msl_subdomain'] }}"                                                                                        
                                            >
                                                {{ $keyword['msl_subdomain'] }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <script>
                                        tippy('#enriched-subdomains-popup', {
                                            content: "Based on the MSL enriched keywords, enriched sub domains are added based on the originating vocabularies.",
                                            placement: "right"
                                        });
                                    </script>
                                </div>
                                @endif

                                @if (array_key_exists("msl_source",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Source</h4>

                                    </div>
                                    <div class="w-full ">
                                        <a href="{{ $data['msl_source'] }}">{{ $data['msl_source'] }}</a>
                                        
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_publisher",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Source publisher</h4>

                                    </div>
                                    <div class="w-full ">
                                        <p>{{ $data['msl_publisher'] }}</p>
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_doi",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">DOI</h4>

                                    </div>
                                    <div class="w-full ">
                                        <p>{{ $data['msl_doi'] }}</p>
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_authors",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Authors</h4>

                                    </div>
                                    <div class="w-full flex flex-col divide-y divide-slate-700 gap-4">
                                        @foreach ( $data['msl_authors'] as $keyword)
                                            <div>
                                                <p class="text-sm p-0">{{ $keyword['msl_author_name'] }}</p>
                                                <p class="text-sm p-0">{{ $keyword['msl_author_orcid'] }}</p>
                                                <p class="text-sm p-0">{{ $keyword['msl_author_affiliation'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_contributors",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Contributers</h4>

                                    </div>
                                    <div class="w-full flex flex-col divide-y divide-slate-700 gap-4">
                                        @foreach ( $data['msl_contributors'] as $keyword)
                                            <div>
                                                <p class="text-sm p-0">{{ $keyword['msl_contributor_name'] }}</p>
                                                <p class="text-sm p-0">{{ $keyword['msl_contributor_role'] }}</p>
                                                <p class="text-sm p-0">{{ $keyword['msl_contributor_orcid'] }}</p>
                                                <p class="text-sm p-0">{{ $keyword['msl_contributor_affiliation'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_references",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">References</h4>

                                    </div>
                                    <div class="w-full flex flex-col divide-y divide-slate-700 gap-4 ">

                                        @foreach ( $data['msl_references'] as $keyword)
                                            <div>
                                                <p class="text-sm p-0">{{ $keyword['msl_reference_title'] }}</p>
                                                <p class="text-sm p-0">{{ $keyword['msl_reference_doi'] }}</p>
                                                <p class="text-sm p-0">{{ $keyword['msl_reference_handle'] }}</p>
                                                <p class="text-sm p-0">{{ $keyword['msl_reference_type'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_points_of_contact",$data))
                                <br>
                                    <div class="w-full pt-5 pb-5 flex flex-row">
                                        <div class="w-1/3">
                                            <h4 class="text-left">Contact</h4>

                                        </div>
                                        <div class="w-full flex flex-col divide-y divide-slate-700 gap-4">
                                            {{-- hover behaviour: highlights all related tags above --}}
                                            @foreach ( $data['msl_points_of_contact'] as $keyword)
                                                <div>
                                                    <p class="text-sm p-0">{{ $keyword['msl_contact_name'] }}</p>
                                                    <p class="text-sm p-0">{{ $keyword['msl_contact_electronic_address'] }}</p>
                                                    <p class="text-sm p-0">{{ $keyword['msl_contact_organisation'] }}</p>
                                                </div>
                                            @endforeach
  
                                        </div>
                                    </div>
                                @endif
                                
                                @if (array_key_exists("msl_citation",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Citiation</h4>

                                    </div>
                                    <div class="w-full flex flex-col divide-y divide-slate-700 gap-4">
                                        {{-- hover behaviour: highlights all related tags above --}}
                                        <div>
                                            <p class="text-sm p-0">{{ $data['msl_citation'] }}</p>

                                        </div>

                                    </div>
                                </div>
                                @endif


                                @if (array_key_exists("msl_collection_period",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Collection Period</h4>

                                    </div>
                                    <div class="w-full flex flex-col divide-y divide-slate-700 gap-4">
                                        <div>
                                            @foreach ( $data['msl_collection_period'] as $keyword)
                                                <p class="text-sm p-0">{{ $keyword["msl_collection_start_date"] }} - {{ $keyword["msl_collection_end_date"] }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_geolocations",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Geo location(s)</h4>

                                    </div>
                                    <div class="w-full flex flex-col divide-y divide-slate-700 gap-4">
                                        <div>
                                            @foreach ( $data['msl_geolocations'] as $keyword)
                                                <p class="text-sm p-0">{{ $keyword['msl_geolocation_place'] }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_geojson_featurecollection",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Spatial coordinates</h4>

                                    </div>
                                    <div class="w-full flex flex-col divide-y divide-slate-700 gap-4">
                                        <div id="map" style="height: 300px;"></div>

                                        <script>
                                            function onEachFeature(feature, layer) {
                                                if (feature.properties.name) {                                
                                                    var popupContent = `<h5>${feature.properties.name}</h5>`;

                                                    layer.bindPopup(popupContent);
                                                }
                                            }
                                        
                                            var features = <?php echo $data['msl_geojson_featurecollection']; ?>;        				
                                        
                                            var map = L.map('map').setView([51.505, -0.09], 4);
                                            
                                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                maxZoom: 19,
                                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                                            }).addTo(map);
                                                                                                                                    
                                            L.geoJSON(features, {
                                                onEachFeature: onEachFeature
                                            }).addTo(map);                                                                                                                                                                                
                                        </script>
                                    </div>
                                </div>
                                @endif

                            </div>

                        </div>
                        

                    </div>
                    
                </div>
            </div>
        </div>
       
        


    </div>

@push('vite')
    @vite(['resources/js/jquery.js', 'resources/js/tooltip.js'])
@endpush


</x-layout_main>