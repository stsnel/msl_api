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
                                    <h3 class="text-left">Keywords</h3>

                                    @if (array_key_exists("tags",$data))
                                    <br>
                                    <div class="p-4 card bg-base-200">
                                        <p>Originally assigned keywords</p>
                                        <div class="card-actions justify-beginning">
                                            @foreach ( $data['tags'] as $keyword)
                                                @include('components.micro_components.word_card', ['stringInput' => $keyword['display_name']])
                                            @endforeach
                                          </div>
                                    </div>
                                    @endif

                                    @if (array_key_exists("msl_original_keywords",$data))
                                    <br>
                                    <div class="p-4 card bg-base-200">
                                        <p>Corresponding MSL vocabulary keywords</p>
                                        <div class="card-actions justify-beginning">
                                            
                                            @foreach ( $data['msl_original_keywords'] as $keyword)
                                                @include('components.micro_components.word_card', ['stringInput' => $keyword['msl_original_keyword_label']])
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif

                                    @if (array_key_exists("msl_enriched_keywords",$data))
                                    <br>
                                    <div class="p-4 card bg-base-200">
                                        <p>MSL enriched keywords</p>
                                        <div class="card-actions justify-beginning">
                                            @foreach ( $data['msl_enriched_keywords'] as $keyword)
                                                @include('components.micro_components.word_card', ['stringInput' => $keyword['msl_enriched_keyword_label']])
                                            @endforeach
                                          </div>
                                    </div>
                                    @endif
                                </div>

                                @if (array_key_exists("msl_subdomains",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">MSL enriched sub domains</h4>

                                    </div>
                                    <div class="flex flex-col w-full ">
                                        {{-- hover behaviour: highlights all related tags above --}}
                                        @foreach ( $data['msl_subdomains'] as $keyword)
                                            @include('components.micro_components.word_card', ['stringInput' => $keyword['msl_subdomain']])
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_source",$data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h5 class="text-left">Source</h5>

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
                                        <h3 class="text-left">Source publisher</h3>

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
                                        <h3 class="text-left">DOI</h3>

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
                                        <h3 class="text-left">Authors</h3>

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
                                        <h3 class="text-left">Contributers</h3>

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
                                        <h3 class="text-left">References</h3>

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
                                            <h3 class="text-left">Contact</h3>

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
                                        <h3 class="text-left">Citiation</h3>

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
                                        <h3 class="text-left">Collection Period</h3>

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
                                        <h3 class="text-left">Geo location(s)</h3>

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

                                {{-- make small box with map next to coordinate data --}}
                                {{-- <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h3 class="text-left">Spatial coordinates</h3>

                                    </div>
                                    <div class="w-full flex flex-col divide-y divide-slate-700 gap-4">
                                            <p class="text-sm p-0 italic">eLong 6.50291</p>
                                            <p class="text-sm p-0 italic">nLat 46.5512</p>
                                            <p class="text-sm p-0 italic">sLat 46.0732</p>
                                            <p class="text-sm p-0 italic">wLong 5.82176</p>

                                    </div>
                                </div> --}}

                            </div>

                        </div>
                        

                    </div>
                    
                </div>
            </div>
        </div>
       
        


    </div>




</x-layout_main>