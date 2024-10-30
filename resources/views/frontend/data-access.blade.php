<x-layout_main>

    <div class="flex justify-center items-center p-10 ">

        {{-- a general no small width view notification --}}
        <div class="block md:hidden">
            no mobile yo
        </div>

        {{-- make this part a component for this page and Labs --}}

        <div class="hidden md:block grow max-w-screen-2xl ">
            <div class="flex w-full justify-center">


                <div class="border-r-2 w-3/12 min-w-64 bg-base-300 flex flex-col place-items-center justify-self-center p-4">

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
                            id="search-filters-query"
                            placeholder="Search Filters.." /> 

                        </div>

                        <div class="pt-6 flex flex-col">
                            <div class="form-control w-full">
                            <label class="label cursor-pointer justify-center space-x-2">
                                <input type="checkbox" id="filterTreeToggleInterpreted" checked="checked" class="checkbox" />
                                <span class="label-text">MSL enriched keywords</span>
                            </label>
                            </div>

                            <div class="form-control w-full">
                            <label class="label cursor-pointer justify-center space-x-2">
                                <input type="checkbox" id="filterTreeToggleOriginal" class="checkbox" />
                                <span class="label-text">MSL original keywords</span>
                            </label>
                            </div>

                            <h4 class="p-4">Filters</h4>

                            <div class="form-control w-full">
                                <label class="label cursor-pointer justify-center space-x-2">
                                        <input type="checkbox" class="checkbox checkbox-sm" id="hide_empty_terms" />
                                        <span class="label-text place-content-center">Hide empty terms</span>
                                </label>
                            </div>

                            <div class="p-2">
                                <div class="w-full flex place-content-center">
                                    <a href="#" id="expand_all" title="expand all nodes">
                                        <button class="btn btn-sm">
                                            expand all
                                        </button>
                                    </a>
                                    <a href="#" id="close_all" title="close all nodes">
                                        <button class="btn btn-sm">
                                            close all
                                        </button>
                                    </a>
                                </div>
                            </div>
                            {{-- what about the text overflow? --}}
                            {{-- how about making this element wider and set the z-layer behind the results and make it come forward when hovering --}}
                            <div id="jstree-interpreted" class="text-wrap"></div>
                            <div id="jstree-original" class="text-wrap" style="display: none;"></div>
                        </div>

                    </div>

                    <script>
                    var dataInterpreted = @php echo File::get(base_path('public/interpreted.json')) @endphp;                    
                    var dataOriginal = @php echo File::get(base_path('public/original.json')) @endphp;
                    var facets = @php echo json_encode($result->getFacets()); @endphp;
                    var activeFilters = @php echo json_encode($activeFilters); @endphp;
                    var activeNodes = [];
                    </script>

                    @push('vite')
                        @vite(['resources/js/jquery.js', 'resources/js/jstree.js', 'resources/js/filters-menu.js'])
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
                                    <input class="peer h-full w-full outline-none text-sm pr-2" type="text" id="search" placeholder="Search data-publications.." name="query" /> 
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
                                <h5>{{ $result->getTotalResultsCount() }} data publications found</h5>
                            </div>
                            
                            <div>
                                <form class="min-w-64 mx-auto flex justify-between content-center" method="get" action="">
                                    <label for="sort" class="self-center text-gray-900 dark:text-white">
                                       <h5 >Order by</h5>
                                    </label>
                                    <select id="sort" name="sort" onchange="this.form.submit()" class="p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="score desc" @if ($sort == 'score desc') {{ 'selected' }} @endif>Relevance</option>
                                        <option value="msl_citation asc" @if ($sort == 'msl_citation asc') {{ 'selected' }} @endif>Author Ascending</option>
                                        <option value="msl_citation desc" @if ($sort == 'msl_citation desc') {{ 'selected' }} @endif>Author Descending</option>
                                        <option value="msl_publication_date desc" @if ($sort == 'msl_publication_date desc') {{ 'selected' }} @endif>Publication date</option>
                                    </select>
                                    <input type="hidden" name="page" value="1" />
                                </form>
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
                            @foreach ($result->getResults() as $dataPublication)


                            <a
                            class="self-center w-9/12 no-underline" 
                            href="{{ route('data-publication-detail', ['id' => $dataPublication['id']]) }}">
                                
                            <div class="border-t border-slate-200/50 hover:bg-secondary ">
                                <div class="p-4">                                    
                                       <h4 class="text-left">{{ $dataPublication['title'] }}</h4> 
                                       <h5 class="text-left font-medium pt-4">
                                            @foreach ( $dataPublication['msl_authors'] as $author )
                                                {{ $author["msl_author_name"] }} ; {{ $author["msl_author_affiliation"] }}
                                            @endforeach
                                        </h5>
                                       {{-- <p>{{ Str::limit($dataPublication['msl-author'], 100) }}</p> --}}
                                       <p class="italic ">{{ Str::limit($dataPublication['notes'], 300) }}</p>
                                    
                                </div>
                            </div>    

                            </a>

                            @endforeach                            
                        </div>
                        
                        {{-- make component out of this --}}
                        <div class="self-center join p-4">
                            
                            <a href="{{ $paginator->previousPageUrl() }}">
                                <button class="join-item btn no-underline">«</button>
                            </a>

                            @for ($i = 1; $i < $paginator->lastPage() + 1; $i++)
                                <a href="{{ $paginator->url($i) }}">
                                    <button 
                                    class="join-item btn no-underline">{{ $i }}</button>
                                </a>
                            @endfor

                            <a href="{{ $paginator->nextPageUrl() }}">
                                <button class="join-item btn no-underline">»</button>
                            </a>

                        </div>
  
                    </div>
                    
                </div>
            </div>
        </div>
       
        


    </div>




</x-layout_main>