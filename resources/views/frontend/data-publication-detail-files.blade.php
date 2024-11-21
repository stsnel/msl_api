@section('title', 'Data publication')
<x-layout_main>

    <div class="mainContentDiv">

        {{-- a general no small width view notification --}}
        @include('components.no_mobile_view')

        <div class="noMobileView_wideScreenDiv">

        <div class="tabLinksParent">
            @include('components.tabLinks',[
                'categoryName'  => 'Sections',
                'routes'        => array(
                        'Metadata'   => route("data-publication-detail", ['id' => $data['name']]),
                        'Files'  => route("data-publication-detail-files", ['id' => $data['name']])
                ),
                'routeActive'   => route("data-publication-detail-files", ['id' => $data['name']])
            ])
        </div>

        <div class="listMapDetailDivParent">
            <div class="detailDiv dividers">
                <div class="detailEntryDiv">
                    <h2>Files</h2>
                </div>
                    
                <div class="detailEntryDiv"> 
                    <div class="flex flex-wrap justify-center place-content-center gap-5 w-full">                
                        @if (array_key_exists("msl_downloads", $data))
                            @foreach ($data['msl_downloads'] as $download)
                                <div class="card bg-base-300 shadow-xl flex justify-between flex-col p-2 w-9/12 ">
                                    <a href="{!! $download['msl_download_link'] !!}" title="download file">{{ $download['msl_file_name'] }}.{{ $download['msl_extension'] }}</a>
                                </div>
                            @endforeach
                        @else
                            <p>No files found for this data publication</p>
                        @endif
                    </div>
                </div>                        
            </div>
        </div>
       
    </div>

@push('vite')
    @vite(['resources/js/jquery.js', 'resources/js/tooltip.js'])
@endpush


</x-layout_main>