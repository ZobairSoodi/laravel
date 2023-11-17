<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Agency::paginate(10);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'logo' => 'image|mimes:png,jpg,jpeg',
            'website' => 'string',
        ]);

        $image_path = $request->file('logo')->store('image', 'public');

        $new_agency = Agency::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $image_path
        ]);

        return response()->json($new_agency, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Agency $agency)
    {
        return response()->json($agency);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agency $agency)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'logo' => 'image|mimes:png,jpg,jpeg',
            'website' => 'string',
        ]);

        $image_path = $request->file('logo')->store('image', 'public');

        $agency_updated = $agency->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $image_path
        ]);

        return response()->json($agency_updated, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agency $agency)
    {
        $agency->delete();
        return response()->json(NULL);
    }
}
