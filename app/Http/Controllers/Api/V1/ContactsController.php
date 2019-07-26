<?php

namespace App\Http\Controllers\Api\V1;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactsRequest;
use App\Http\Requests\Admin\UpdateContactsRequest;
use Yajra\DataTables\DataTables;

class ContactsController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function show($id)
    {
        return Contact::findOrFail($id);
    }

    public function update(UpdateContactsRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        

        return $contact;
    }

    public function store(StoreContactsRequest $request)
    {
        $contact = Contact::create($request->all());
        

        return $contact;
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return '';
    }
}
