    {{-- 

    href        = (string)
    title       = (string)
    authors     = (array) structure: ckan native
    description = (string)

    --}}

<a
    class="self-center w-9/12 no-underline" 
    href="{{ $href }}">
    
    <div class="hover:bg-secondary-100 ">


        <div class="p-4"> 
            
            @if (isset($title))
                <h4 class="text-left">{{ $title }}</h4> 
            @endif

            @if (isset($authors))
                <h5 class="text-left font-medium pt-4">
                        @foreach ( $authors as $author )
                            {{ $author["msl_author_name"] }} 
                        {{-- a little divider between names --}}
                            @if (sizeof($authors) -1 != array_search($author, $authors) )
                                |
                            @endif
                        @endforeach
                </h5>
            @endif

            @if (isset($date))
                <p>{{ $date }}</p>
            @endif


            @if (isset($description))
                {{-- https://laravel.com/docs/11.x/strings#method-str-limit --}}
                <p class="italic ">{{ Str::limit($description, 295, preserveWords: true) }}</p>
            @endif

            

        </div>


    </div>    

</a>
