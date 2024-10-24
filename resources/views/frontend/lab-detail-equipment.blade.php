<x-layout_main>
<div class="flex justify-center items-center ">
        <div role="tablist" class="tabs tabs-lifted">
            <a role="tab" href="{{ route('lab-detail', ['id' => $ckanLabName]) }}" class="tab">Laboratory</a>
            <a role="tab" href="{{ route('lab-detail-equipment', ['id' => $ckanLabName]) }}" class="tab tab-active">Equipment</a>
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
                            <div class="divide-y divide-slate-700 p-4 flex flex-col  max-w-screen-lg ">                                
                                <h1>Equipment</h1>
                                
                                @if (count($data) > 0)                                                                    
                                    @foreach ($data as $equipment)
                                    <div class="">
                                        <table class="table">                                            
                                            <tbody>
                                            <tr>
                                                <th>title</th>
                                                <td>{{ $equipment['title'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>description</th>
                                                <td>{!! $equipment['msl_description_html'] !!}</td>
                                            </tr>
                                            <tr>
                                                <th>category</th>
                                                <td>{{ $equipment['msl_category_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>title</th>
                                                <td>{{ $equipment['title'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>domain</th>
                                                <td>{{ $equipment['msl_domain_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>group</th>
                                                <td>{{ $equipment['msl_group_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>type</th>
                                                <td>{{ $equipment['msl_type_name'] }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
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
       
        


    </div>




</x-layout_main>