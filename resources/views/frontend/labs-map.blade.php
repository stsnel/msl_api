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
                            <h1>Filters</h1>
                        </div>

                    </div>

                    <div>
                        placeholder Filters
                    </div>

                </div>
                
                <div class="bg-base-300  grow">
                    <div class="w-full flex flex-col">
                    <h1>JAJA</h1>

                        
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>
       
        


    </div>




</x-layout_main>