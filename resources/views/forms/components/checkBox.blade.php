{{-- 
    vars

    $ElementsArray => array(string)
    $sectionName => string, describes the name of the elements for interactions
    $placeholder => string
    $title => title for the text-field

--}}

{{-- no error handling --}}

<div class="w-full flex-row place-content-center h-full ">
    @foreach ( $ElementsArray as $element)
        <div class="form-control">
            <label class="cursor-pointer label">
                <span class="label-text">{{ $element }}</span>
                <input type="checkbox" 
                name="{{ $sectionName }}"
                class="checkbox checkbox-secondary checkbox-md" 
                checked="checked"/>
                
            </label>
        </div>
    @endforeach
</div>


