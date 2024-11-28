
@if(session()->has('success'))
    <div class="
    p-10
    fixed 
    z-40
    top-1/2 left-1/2 
    -translate-x-1/2
    bg-success-200 text-success-900">
        <p>
            {{ session('success') }}
        </p>
    </div>
@endif