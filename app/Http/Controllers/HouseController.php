<?php

namespace App\Http\Controllers;

use App\Amenity;
use App\House;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $houses = House::where('lang', request('lang'))->orderBy('created_at','desc')->with('image')->get();

        return ['success' => true, 'data' => $houses];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return array
     */
    public function store()
    { 
        $validData = request()->validate([
            "name" =>'required',
            "description" =>'required',
            "lang" => 'required'
        ]);

        $house = auth()->user()->house()->create($validData);

        return ['success' => true, 'data' => $house];
    }

    /**
     * Display the specified resource.
     *
     * @param House $house
     * @return array
     */
    public function show(House $house)
    {
        $house->load(['image', 'amenity']);
        return ['success' => true, 'data' => $house];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param House $house
     * @return void
     */
    public function update(House $house)
    {

        $house->update(request()->except(['image', 'active']));

        return response()->json(['success'=> true], 200);

    }

    public function getAmenities(){

        return response()->json(['success' => true, 'data' => Amenity::all()], 200);
    }

    public function updateHouseAmenities(House $house, Amenity $amenity){
        if (! $house->amenity->contains($amenity->id)) {
            $house->amenity()->attach($amenity->id);
        } else {
            $house->amenity()->detach($amenity->id);
        }

        return response()->json(['success' => true], 200);
    }

    public function uploadImages(House $house){


        request()->validate(['file' => 'image']);

        $images = Collection::wrap(request()->file('file'));


        $images->each(function ($image) use ($house) {

            $path = "/img/houses/{$house->id}/";
            $imageName = Str::random();
            $original = "{$imageName}.". $image->getClientOriginalExtension();

            $image->move(public_path($path), $original);

            $house->image()->create(['url' => $path.$original]);
        });

        return response()->json(['success' => true, 'data' => 'ok'], 200);

    }


    public function removeImage(House $house, Image $image){

        $image->delete();

        return response()->json(['success'=> true], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param House $house
     * @return array
     */
    public function updateActive(Request $request, House $house)
    {

        $house = House::where('id', $request->id)->update(['active' => $request->active]);

        return ['success' => true, 'data' => $house];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param House $house
     * @return array
     * @throws \Exception
     */
    public function destroy(House $house)
    {
        $house->delete();

        return ['success' => true];

    }
}
