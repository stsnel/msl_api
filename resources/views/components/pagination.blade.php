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