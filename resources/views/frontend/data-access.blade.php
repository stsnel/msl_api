<x-layout_main>

        <div class="flex justify-center items-center p-10">

            {{-- make this part a component for this page and Labs --}}

            <div class="flex w-full flex-col lg:flex-row">


                <div class="border-r-2 w-96 bg-base-300 grid place-items-center">

                    <div class='max-w-md mx-auto'>
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
                            placeholder="Search something.." /> 

                        </div>
                    </div>

                </div>
                
                <div class=" bg-base-300 grid flex-grow place-items-center">

                    <div class='w-full mx-auto p-4'>
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
                            placeholder="Search something.." /> 
                        </div>
                    </div>

                    <div class="flex justify-between w-full p-4">
                        <div><p>2,818 data publications found</p></div>
                        <div>
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
                        </div>
                        
                        
                    </div>

                    <div>
                        <div class="border-t-2 border-b-2">
                            <div class="p-4">
                                North America during the Lower Cretaceous: new palaeomagnetic constraints from intrusions in New England (Dataset)

                                Suzanne A. McEnroe; (1996)
                                Paleomagnetic, rock magnetic, or geomagnetic data found in the MagIC data repository from a paper titled: Suzanne A. McEnroe (1996). North America during the Lower Cretaceous:...
                                
                            </div>
                        </div>

                    </div>

                    <div class=" join p-4">
                        <button class="join-item btn">1</button>
                        <button class="join-item btn">2</button>
                        <button class="join-item btn btn-disabled">...</button>
                        <button class="join-item btn">99</button>
                        <button class="join-item btn">100</button>
                      </div>
                </div>
            </div>
            


        </div>




</x-layout_main>