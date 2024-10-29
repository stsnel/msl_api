<x-layout_main>
<div class="flex justify-center items-center ">
        <div role="tablist" class="tabs tabs-lifted">
            <a role="tab" href="{{ route('lab-detail', ['id' => $data['name']]) }}" class="tab">Laboratory</a>
            <a role="tab" href="{{ route('lab-detail-equipment', ['id' => $data['name']]) }}" class="tab tab-active">Equipment</a>            
        </div>
    </div>

    <div class="flex justify-center items-center p-10 ">

        {{-- a general no small width view notification --}}
        <div class="block md:hidden">
            no mobile yo
        </div>

        <div class="hidden md:block grow max-w-screen-2xl">
            <div class="flex w-full justify-center min-h-screen">
                
                <div class="bg-base-300  grow">
                    <div class="w-full flex flex-col">
    
                        <div class=" flex flex-col place-items-center">
                            <div class="divide-y divide-slate-700 p-4 flex flex-col place-items-center max-w-screen-lg ">
                                <div class=" w-full pt-5 pb-5">
                                    <h1 class="text-lg">{{ $data['title'] }}</h1>                                    
                                </div>
                                
                                <div class=" w-full pt-5 pb-5">                                    
                                    <p>
                                        {!! $data['msl_description_html'] !!}
                                    </p>
                                </div >
                                
                                @if (array_key_exists("msl_website", $data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Website</h4>

                                    </div>
                                    <div class="w-full ">
                                        <p>{{ $data['msl_website'] }}</p>
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_domain_name", $data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Domain</h4>

                                    </div>
                                    <div class="w-full ">
                                        <p>{{ $data['msl_domain_name'] }}</p>
                                    </div>
                                </div>
                                @endif

                                @if (array_key_exists("msl_organization_name", $data))
                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Organization name</h4>

                                    </div>
                                    <div class="w-full ">
                                        <p>{{ $data['msl_organization_name'] }}</p>
                                    </div>
                                </div>
                                @endif

                                <br>
                                <div class="w-full pt-5 pb-5 flex flex-row">
                                    <div class="w-1/3">
                                        <h4 class="text-left">Address</h4>                            
                                    </div>
                                    <div class="w-full ">
                                        <p>
                                            @if ($data['msl_address_street_1'] !== "") {{ $data['msl_address_street_1'] }}<br> @endif
                                            @if ($data['msl_address_street_2'] !== "") {{ $data['msl_address_street_2'] }}<br> @endif
                                            @if ($data['msl_address_postalcode'] !== "") {{ $data['msl_address_postalcode'] }}<br> @endif
                                            @if ($data['msl_address_city'] !== "") {{ $data['msl_address_city'] }}<br> @endif
                                            @if ($data['msl_address_country_name'] !== "") {{ $data['msl_address_country_name'] }}<br> @endif
                                        </p>
                                    </div>
                                </div>
                                
                                

                            </div>

                        </div>
                        

                    </div>
                    
                </div>
            </div>
        </div>
       
        


    </div>




</x-layout_main>