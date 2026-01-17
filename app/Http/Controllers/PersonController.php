<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\person;

class personController extends Controller
{
    public function index()
    {
        $persons = person::all();
        return view('persons.index', compact('persons'));
    }

    public function create()
    {
        return view('person.create');
    }

    public function store(Request $request)
    {

    }

    public function edit(person $person)
    {
        
    }

    public function update(Request $request, person $person)
    {

    }

    public function destroy(person $person)
    {
        $person->delete();
        return redirect()->route('persons.index')->with('success', 'person deleted successfully.');
    }
}
