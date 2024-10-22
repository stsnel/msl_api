<x-layout_main>
    <div class="flex justify-center items-center ">
        <div role="tablist" class="tabs tabs-lifted">
            <a role="tab" href="{{ route('labs-map') }}" class="tab">Laboratories map</a>
            <a role="tab" href="{{ route('labs-list') }}" class="tab tab-active">Laboratories list</a>
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
                            <h2>Filters</h2>
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
                
                <div class="grow w-full">
                    <div class="w-full flex flex-col bg-base-100">

                        <div class='grow mx-auto p-4 w-full'>
                            <div class="relative flex items-center w-full h-12 rounded-lg focus-within:shadow-lg overflow-hidden">
                                <div class="grid place-items-center h-full w-12 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                {{-- full or limited width? --}}
                                <form method="get" class="w-full h-16">
                                    <input type="hidden" name="page" value="1" />
                                    <input class="peer h-full w-full outline-none text-sm pr-2" type="text" id="search" placeholder="Search laboratories.." name="query" /> 
                                </form>
                            </div>
                        </div>
    
                        <div class="grow flex justify-between p-4 px-10">
                           
                            <?php /* dd($activeFilters); */?>
                            
                            {{-- styling needs some tuning regarding long filter text elements --}}
                            <div class="flex flex-col max-w-80 text-wrap">
                                <h5>Applied Filters</h5>
                                <?php
                                $filterKeys = collect($activeFilters)->keys();

                                ?>
                                <ul class="list-disc list-inside"> 

                                    @foreach ( $filterKeys as $key )
                                        <li>{{ $key }}:
                                            @foreach ( $activeFilters[$key] as $entry)
                                                {{ $entry }} 
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                                {{-- {{ json_encode($activeFilters) }} --}}
                            </div>


                            <div>
                                <h5>{{ $result->getTotalResultsCount() }} laboratories found</h5>
                            </div>
                                                        


                            {{-- <div>
                                <div class="dropdown">
                                    Order by
                                    <div tabindex="0" role="button" class="btn m-1">Relevance
                                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                                    <li><a>Item 1</a></li>
                                    <li><a>Item 2</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                            
                            
                        </div>
    
                        {{-- insert pagination as well here --}}
                        
                        <div class="flex flex-col ">
                            @foreach ($result->getResults() as $laboratory)

                            <a
                            class="self-center w-9/12" 
                            href="">
                                
                            <div class="border-t border-slate-200/50 hover:bg-secondary ">
                                <div class="p-4">                                    
                                       <h4 class="text-left">{{ $laboratory['title'] }}</h4>
                                       <span>{{ $laboratory['msl_organization_name'] }}</span>
                                </div>
                            </div>    

                            </a>

                            @endforeach                            
                        </div>
                        
                        
                        {{-- make component out of this --}}
                        <div class="self-center join p-4">
                            
                            <a href="{{ $paginator->previousPageUrl() }}">
                                <button class="join-item btn">«</button>
                            </a>

                            @for ($i = 1; $i < $paginator->lastPage() + 1; $i++)
                                <a href="{{ $paginator->url($i) }}">
                                    <button 
                                    class="join-item btn">{{ $i }}</button>
                                </a>
                            @endfor

                            <a href="{{ $paginator->nextPageUrl() }}">
                                <button class="join-item btn">»</button>
                            </a>

                        </div>
  
                    </div>
                    
                </div>


            </div>
        </div>
       
        


    </div>




</x-layout_main>