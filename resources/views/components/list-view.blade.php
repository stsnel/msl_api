    {{-- 

    href        = (string)
    title       = (string)
    authors     = (array) structure: ckan native
    description = (string)

    --}}

<a
    class="self-center w-9/12 no-underline" 
    href="{{ $href }}">
    
    <div class="border-t border-slate-200/50 hover:bg-secondary-100 ">


        <div class="p-4"> 
            
            @if (isset($title))
                <h4 class="text-left">{{ $title }}</h4> 
            @endif

            @if (isset($authors))
                <h5 class="text-left font-medium pt-4">
                        @foreach ( $authors as $author )
                        |  {{ $author["msl_author_name"] }} ; {{ $author["msl_author_affiliation"] }}
                        @endforeach
                </h5>
            @endif

            @if (isset($description))
                <p class="italic ">{{ Str::limit($description, 300) }}</p>
            @endif

            

        </div>


    </div>    

</a>
