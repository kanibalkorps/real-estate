<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PropertyController extends Controller
{
    public function getProperties(Request $request, $keywords = null, $category = null, $type = null) {
        if (!$request->ajax()) {
            return redirect()->route('properties.index');
        }

        $page = $request->query("page", 1); //from query string

        if ($keywords || $category || $type || $page){
            $propertiesPaginator = Property::retrieve(null, $keywords, $category, $type, $page);

            $totalPages = $propertiesPaginator->lastPage();
        }
        else {
            $propertiesPaginator = Property::retrieve();

            $totalPages = $propertiesPaginator->lastPage();
        }

        $response = [
            'items' => $propertiesPaginator->items(),
            'totalPages' => $totalPages,
        ];

        return json_encode($response);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propertiesPaginator = Property::retrieve();
        $categories = Category::pluck("name", "id");
        $types = Property::distinct()->pluck("type");

        return view("pages.properties.index", ["properties" => $propertiesPaginator,
                                                    "categories" => $categories,
                                                     "types" => $types]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!isset($id) || $id <= 0){
            return redirect()->route("404");
        }

        $property = Property::find($id);

        if (!$property) {
            return redirect()->route("404");
        }

        $property = Property::retrieve($id);

        return view("pages.properties.show", ["property" => $property]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
