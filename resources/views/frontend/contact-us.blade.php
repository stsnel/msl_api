@section('title', 'Contact Us')
<x-layout_main>

    <section class="">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <h1 class="">Contact Us</h1>
        <p class="mb-8 lg:mb-16 text-center">Do you have questions? Want to contribute and get started? Want to report an error on this page? Please get in touch with us! </p>
        <form method="POST" action="#" class="space-y-8">
            @csrf
            <div>
                <label for="email" class="block mb-2 ">Your email</label>
                <input type="email" id="email" name="email" class="shadow-sm text-sm w-full h-10 p-3 rounded-lg border-primary-500" placeholder="e@mail.com" required>
            </div>
            <div>
                <label for="subject" class="block mb-2 ">Subject</label>
                <select 
                name="subject"
                id="subject"
                class="select w-full bg-white" 
                required>
                    <option disabled selected>Select the subject</option>
                    <option>Report a bug or feedback</option>
                    <option>Contribute as a repository</option>
                    <option>Request the laboratory intake form</option>
                
                </select>
            </div>
            
            <div class="">
                <label for="message" class="block mb-2 ">Your message</label>
                <textarea id="message" rows="6" class="block p-3 w-full text-sm rounded-lg " placeholder="Your message" required></textarea>
            </div>
            <div class="w-full flex place-content-center">
                <button type="submit" class="btn btn-primary">Send message</button>

            </div>
        </form>
    </div>
  </section>

</x-layout_main>