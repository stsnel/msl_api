<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
 

class LaboratoryFormController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function create(): View
    {
        return view('forms.laboratory-intake');
    }
 
    /**
     * Store a new blog post.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate and store the blog post...
        // dd($request->all());


        //  in order of appearance
        $formFields = $request->validate([
            'lab-name'              => ['required'],
            'street'                => ['required'],
            'street-no'             => ['required'],
            'street-detail'         => ['nullable'],
            'postalCode'            => ['required'],
            'city'                  => ['required'],
            'state'                 => ['required'],
            'country'               => ['required'],
                
            'url'                   => ['required', 'url'],
                
            "description"           => ['required','min:10','max:4000'],
            "dataSharing"           => ['nullable'],
            "facilityAccess"        => ['nullable'],
                
            'subdomain'             => ['required'],

            "contact-firstName"     => ['required'],
            "contact-lastName"      => ['required'],
            "contact-email"         => ['required', 'email'],
            "contact-affiliation"   => ['required'],

            // 'email' => ['required', 'email'],
            // 'subject' => ['required'],
            // 'message' => ['required', 'min:50'],
        ]);


        // create the contact message to handler
        

        // when submitting, maybe a way to stay on the page and foret all the old values?
        return redirect('/')->with('success', 'contact request sent. You will receive a confirmation email soon, please check your spam as well');

        // $post = /** ... */
 
        // return to_route('post.show', ['post' => $post->id]);
    }
}
