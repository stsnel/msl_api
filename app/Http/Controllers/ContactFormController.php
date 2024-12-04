<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
 
class ContactFormController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function create(): View
    {
        return view('forms.contact-us');
    }
 
    /**
     * Store a new blog post.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate and store the blog post...
        // dd($request->all());

        $formFields = $request->validate([
            'email'         => ['required', 'email'],
            'firstName'     => ['required'],
            'lastName'      => ['required'],
            'affiliation'   => ['required'],
            'subject'       => ['required'],
            'message'       => ['required', 'min:50'],
        ]);


        // create the contact message to handler
        

        // redirects to with the additonal elements located in components/notifications/
        return redirect('/')->with('modals', [
            'type'      => 'success', 
            'message'   => 'Contact request sent. You will receive a confirmation email soon, please check your spam as well']
         );

        // $post = /** ... */
 
        // return to_route('post.show', ['post' => $post->id]);
    }
}