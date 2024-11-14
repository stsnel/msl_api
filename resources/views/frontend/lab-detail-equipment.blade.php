<x-layout_main>
    <div class="mainContentDiv ">

        {{-- a general no small width view notification --}}
        @include('components.no_mobile_view')

        <div class="noMobileView_wideScreenDiv">

            <div class="tabLinksParent">

                @include('components.tabLinks',[
                    'routes'        => array(
                            'Laboratory'    => route('lab-detail', ['id' => $ckanLabName]),
                            'Equipment'     => route('lab-detail-equipment', ['id' => $ckanLabName])
                    ),
                    'routeActive'   => route('lab-detail-equipment', ['id' => $ckanLabName])
                ])
            </div>
                
            <div class="listMapDetailDivParent ">
            
                <div class="detailDiv bg-primary-100">        
                    
                        <div class="detailEntryDiv">
                            <h2 class="">Laboratory Equipment</h2>
                            <h1 class="text-lg">{{ $data2['title'] }}</h1>
                        </div>

                        <div class="flex flex-wrap justify-center place-content-center gap-10 w-full">
                            @if (count($data) > 0)                                                                    
                            @foreach ($data as $equipment)
                            
                            <div class="card bg-base-300 shadow-xl flex justify-between flex-col p-2 w-9/12 ">

                                <h4 class="pr-4 pl-4 pt-4">{{ $equipment['title'] }}</h4>

                                @if (strlen($equipment['msl_description_html']) > 0)
                                    <div class="p-4">
                                        {!! $equipment['msl_description_html'] !!}
                                    </div>
                                @else
                                    <p class="italic text-center pt-10 pb-8">no description found</p>
                                @endif

                                @php
                                    $equipmentInfos= array(
                                        'Category'  => $equipment['msl_category_name'],
                                        'Domain'    => $equipment['msl_domain_name'],
                                        'Group'     => $equipment['msl_group_name'],
                                        'Type'      => $equipment['msl_type_name'],
                                    )
                                @endphp
                                <div class="w-3/4 place-content-center self-center p-2">
                                    @foreach ($equipmentInfos as $equipInfo)
                                    <div class="w-full flex flex-row p-2">
                                            <p class="w-1/2 place-content-center text-left font-bold">
                                                {{ array_search($equipInfo, $equipmentInfos) }}
                                            </p>
                                            <p class="w-1/2 text-left">{{ $equipInfo }}</p>
                                    </div>
                                @endforeach
                                </div>

                                @if(isset($equipment['msl_equipment_addons']))
                                    <div class="p-2 rounded-xl">
                                        <h5 class="">Addons</h5>
                                        <div class="w-full flex flex-row p-2 place-content-center gap-4">

                                            @foreach ($equipment['msl_equipment_addons'] as $addon)
                                                    <div class="w-3/4 bg-neutral-100 text-neutral-900 rounded-lg place-content-center pl-4 pr-4 flex flex-col text-sm">
                                                        @php
                                                            $addonInfos= array(
                                                                'Type' => $addon['msl_equipment_addon_type'],
                                                                'Group' => $addon['msl_equipment_addon_group'],
                                                                'Description' => $addon['msl_equipment_addon_description']
                                                            )
                                                        @endphp

                                                        @foreach ( $addonInfos as $addonInfo )
                                                            <div class="w-full flex flex-row">
                                                                    <p class="w-1/2 place-content-center text-left font-bold">
                                                                        {{ array_search($addonInfo, $addonInfos) }}
                                                                    </p>
                                                                    <p class="w-1/2 text-left">{{ $addonInfo }}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                            @endforeach

                                        </div>

                                    </div>

                                @endif                                  

                            </div>   

                            @endforeach                                
                        @else
                            <p>No equipment found for this laboratory</p>
                        @endif
            
                        </div>  
                                
                    </div>
                    
                </div>
            </div>
        </div>
       
        


    </div>




</x-layout_main>