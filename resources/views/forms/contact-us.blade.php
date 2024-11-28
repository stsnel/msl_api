@section('title', 'Contact Us')
<x-layout_main>

    <section class="">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <h1 class="">Contact Us</h1>
        <p class="mb-8 lg:mb-16 text-center">Do you have questions? Want to contribute and get started? Want to report an error on this page? Please get in touch with us! </p>
        <form method="POST" action="/contact-us" class="space-y-8" novalidate>
            @csrf
            

            <div>

                <label for="email" class="block mb-2 ">Email</label>
                <input 
                type="email" id="email" name="email" 
                class="form-field-text @error('email') error-highlight-input @enderror" 
                placeholder="GraniteusRockwell@coolRock.edu"
                value="{{ old('email') }}">

                @error('email')
                    <p class="error-highlight"> {{ $message }} </p>
                @enderror

            </div>

            <div>
                
                <label for="name" class="block mb-2 ">Name</label>
                <input type="name" id="name" name="name" 
                class="form-field-text @error('name') error-highlight-input @enderror" 
                placeholder="Graniteus Rockwell"
                value="{{ old('name') }}"
                >

                @error('name')
                    <p class="error-highlight"> {{ $message }} </p>
                @enderror

            </div>

            <div>

                @php
                    $subjects = [
                        'Request the laboratory intake form',
                        'Report a bug or feedback',
                        'Contribute as a repository',
                    ]
                @endphp

                <label for="subject" class="block mb-2 ">Subject</label>
                <select 
                name="subject"
                id="subject"
                class="select form-field-text focus:select-secondary @error('subject') error-highlight-input bg-error-300 @else bg-white @enderror">
                    <option disabled selected>Select the subject</option>
                    {{-- from https://laravel.com/docs/11.x/blade#additional-attributes --}}
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject }}" @selected(old('subject') == $subject)>
                            {{ $subject }}
                        </option>
                    @endforeach
                </select>

                @error('subject')
                    <p class="error-highlight"> {{ $message }} </p>
                @enderror

            </div>
            
            <div class="">

                <label for="message" class="block mb-2 ">Message</label>
                <textarea 
                id="message" 
                name="message"
                rows="6" 
                class="h-96 form-field-text @error('message') error-highlight-input @enderror" 
                {{-- class="block p-3 w-full text-sm rounded-lg "  --}}
                value="{{ old('email') }}"
                placeholder="Your message"></textarea>

                @error('message')
                    <p class="error-highlight"> {{ $message }} </p>
                @enderror

            </div>

            <div class="w-full flex place-content-center">
                <button type="submit" class="btn btn-primary">Send message</button>
            </div>

        </form>
    </div>
  </section>

</x-layout_main>