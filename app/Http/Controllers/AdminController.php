<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Heating;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // USERS
    public function storeUser(UserRequest $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $validatedData = $request->validated();
            $validatedPassword = $validator->validated(); //array
            $validatedData["password"] = bcrypt($validatedPassword["password"]);

            User::create($validatedData);

            toastr()->success('User created successfully.', 'Success');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());

            toastr()->error('An error occurred while creating the user. Please try again later.', 'Error');
            return redirect()->back()->withInput();
        }
    }

    public function createUser(){
        $roles = DB::table("roles")->pluck("name", "id");

        return view("pages.admin.users.create", ["roles" => $roles]);

    }

    public function destroyUser($id){
        $user = User::where("active", true)->find($id);

        if (!$user) {
            toastr()->error("The provided ID doesn't exist on our system.", "Error");
            return redirect()->back();
        }

        try {
            $user->active = false;
            $user->save();

            toastr()->success("Successfully deleted the selected user.", "Success");
            return redirect()->route("admin.users.index");
        }
        catch (\Exception $e) {
            Log::error("error: " . $e->getMessage());

            toastr()->error("An error occurred while trying to delete the user.", "Error");
            return redirect()->back();
        }
    }

    public function updateUser(UserRequest $request, $id){
        try {
            $user = User::where("active", true)->findOrFail($id);

            $validatedData = $request->validated();

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->role_id = $validatedData['role_id'];
            $user->save();

            toastr()->success('User updated successfully.', 'Success');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());

            toastr()->error('An error occurred while updating the user. Please try again later.', 'Error');
            return redirect()->back()->withInput();
        }

    }

    public function editUser($id){
        $user = User::where("active", true)->findOrFail($id);
        $roles = DB::table("roles")->pluck("name", "id");

        return view("pages.admin.users.edit", ["user" => $user, "roles" => $roles]);
    }

    public function getAllUsers(){
        $usersPaginator = User::where("active", true)->paginate(3);
        $firstUser = $usersPaginator->first();

        $keys = $firstUser ? array_keys($firstUser->getAttributes()) : [];

        return view("pages.admin.users.index", ["users" => $usersPaginator, "keys" => $keys]);
    }
    // END USERS


    // PROPERTIES
    public function destroyProperty($id){
        $property = Property::find($id);
        if (!$property) {
            toastr()->error("The provided ID doesn't exist on our system.", "Error");
            return redirect()->back();
        }

        try {
            DB::beginTransaction();
            DB::table("properties_images")->where('property_id', $id)->delete();

            $property->delete();
            DB::commit();

            toastr()->success("Successfully deleted the selected property.", "Success");
            return redirect()->route("admin.properties.index");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("error: " . $e->getMessage());

            toastr()->error("An error occurred while trying to delete the property.", "Error");
            return redirect()->back();
        }
    }

    public function storeProperty(PropertyRequest $request) {
        try {
            $validatedData = $request->validated();

            $type = $validatedData['type'] == '1' ? 'For Rent' : 'For Sale';

            $property = Property::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'area' => $validatedData['area'],
                'price' => $validatedData['price'],
                'floors' => $validatedData['floors'],
                'rooms' => $validatedData['rooms'],
                'bathrooms' => $validatedData['bathrooms'],
                'category_id' => $validatedData['category_id'],
                'heating_id' => $validatedData['heating_id'],
                'seller_id' => $validatedData['seller_id'],
                'type' => $type,
                'featured' => $request->boolean('featured-c'),
                'address_id' => rand(1, 10)
            ]);

            $imageId = rand(1, 6);
            $propertyId = $property->id;

            DB::table('properties_images')->insert([
                'property_id' => $propertyId,
                'image_id' => $imageId,
            ]);

            DB::commit();

            toastr()->success('Property created successfully.', 'Success');
            return redirect()->route('admin.properties.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating property: ' . $e->getMessage());

            toastr()->error('An error occurred while creating the property. Please try again later.', 'Error');
            return redirect()->back()->withInput();
        }
    }

    public function createProperty(){
        $categories = Category::pluck("name", "id");
        $types = Property::distinct()->pluck("type");
        $users = User::distinct("email")->where("active", true)->pluck("name", "id");
        $heating = Heating::pluck("name", "id");

        return view("pages.admin.properties.create", [
            "categories" => $categories,
            "types" => $types,
            "users" => $users,
            "heating" => $heating
        ]);
    }

    public function updateProperty(PropertyRequest $request, string $id){
        $property = Property::findOrFail($id);
        $data = $request->all();
//        dd($data);
        try {
            foreach ($data as $key => $value) {
                if ($key === "featured-c"){
                    $key = "featured";
                }

                if (array_key_exists($key, $property->toArray()) && $property[$key] !== $value) {
                    if ($key === "type")
                    {
                        $value == 1 ? $value = "For Rent" : $value = "For Sale";
                    }

                    $property[$key] = $value;
                }
            }

            $property->save();
            toastr()->success('Property updated successfully.', 'Success', ['timeOut' => 5000]);
            return redirect()->route('admin.properties.index');
        }
        catch (\Exception $e){
            Log::error("error: " . $e->getMessage());
            toastr()->error('Property updating failed.', 'Error', ['timeOut' => 5000]);
            return redirect()->back()->withInput();
        }
    }

    public function editProperty($id){
        if ($id > 0){
            $property = Property::retrieve($id);
        }

        $categories = Category::pluck("name", "id");
        $types = Property::distinct()->pluck("type");
        $users = User::distinct("email")->where("active", true)->pluck("name", "id");
        $heating = Heating::pluck("name", "id");
//        $additionals = User::distinct("email")->pluck("name");

        return view("pages.admin.properties.edit", ["property" => $property,
                                                            "categories" => $categories,
                                                            "types" => $types,
                                                            "users" => $users,
                                                            "heating" => $heating]);
    }

    public function getAllProperties(Request $request){
        $page = $request->query("page", 1); //from query string

        $propertiesPaginator = Property::retrieve(null, "0", "0", "0", $page);
        $firstProperty = $propertiesPaginator->first();

        $keys = $firstProperty ? array_keys($firstProperty->getAttributes()) : []; // column names

        return view("pages.admin.properties.index", ["properties" => $propertiesPaginator,
                                                           "keys" => $keys]);
    }
    // END PROPERTIES

    // LOGS
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dashboard
        $logsPaginator = \App\Models\Log::paginate(9);
        $firstLog = $logsPaginator->first();

        $keys = $firstLog ? array_keys($firstLog->getAttributes()) : [];

        return view("pages.admin.index", ["logs" => $logsPaginator, "keys" => $keys]);
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
        //
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
