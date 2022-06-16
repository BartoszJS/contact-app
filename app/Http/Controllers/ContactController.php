<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;

class ContactController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $companies = $user->companies()->orderBy('name')->pluck('name','id')->prepend('All Companies','');
       // \DB::enableQueryLog();
        $contacts = $user->contacts()->latestFirst()->paginate(10);
       // dd(\DB::getQueryLog());
        return view('contacts.index', compact('contacts','companies'));
    }
    public function create()
    {
      $contact = new Contact();
      $companies = auth()->user()->companies()->orderBy('name')->pluck('name','id')->prepend('All Companies','');
        return view('contacts.create',compact('companies','contact'));
    }

    public function store(Request $request)
    {
      $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'address' => 'required',
        'company_id' => 'required|exists:companies,id',
      ]);
      $request->user()->contacts()->create($request->all());

      return redirect()->route('contacts.index')->with('message',"Contact has been added succesfully.");

    }

    public function edit(Contact $contact)
    {

      $companies =auth()->user()->companies()->orderBy('name')->pluck('name','id')->prepend('All Companies','');
      return view('contacts.edit',compact('companies','contact'));
    }

    public function update(Contact $contact, Request $request)
    {
      $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'address' => 'required',
        'company_id' => 'required|exists:companies,id',
      ]);
      $contact->update($request->all());

      return redirect()->route('contacts.index')->with('message',"Contact has been updated succesfully.");

    }

    public function show(Contact $contact)
    {
        return view('contacts.show',compact('contact'));
    }

    public function destroy(Contact $contact)
    {
      
      $contact->delete();

      return back()->with('message',"Contact has been deleted succesfully.");
    }
}
