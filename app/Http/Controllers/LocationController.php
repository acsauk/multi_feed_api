<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    public function show(Location $location)
    {
        return $location;
    }

    public function store(Request $request)
    {
      $location = Location::create([
        'name' => $request->input('name'),
        'latitude' => $request->input('latitude'),
        'longitude' => $request->input('longitude'),
        'address' => $request->input('address'),
        'category' => $request->input('category'),
        'link' => $request->input('link'),
        'rating' => $request->input('rating'),
        'image' => $request->input('image'),
        'price' => $request->input('price')
      ]);

      return response()->json($location, 201);
    }
}
