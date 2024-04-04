<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'area', 'price', 'type', 'floors',
        'rooms', 'bathrooms', 'featured', 'category_id', 'address_id',
        'heating_id', 'seller_id',
    ];


    public static function retrieve($id = null, $keywords = null, $category = null, $type = null, $page = 1){
        $query = Property::where("properties.active", true)
                ->join("categories as c", "properties.category_id", "=", "c.id")
                ->join("heatings as h", "properties.heating_id", "=", "h.id")
                ->join("users as u", "properties.seller_id", "=", "u.id")
                ->join("addresses as a", "properties.address_id", "=", "a.id")
                ->join("cities as ci", "a.city_id", "=", "ci.id")
                ->join("countries as co", "a.country_id", "=", "co.id")
                ->join("properties_images as im", "properties.id", "=", "im.property_id")
                ->join("images as i", "im.image_id", "=", "i.id")
                ->select(
                    'properties.id',
                    'properties.title',
                    'properties.description',
                    'properties.area',
                    'properties.price',
                    'properties.type',
                    'properties.floors',
                    'properties.rooms',
                    'properties.bathrooms',
                    'properties.featured',
                    'c.name as category',
                    'c.id as categoryId',
                    'h.name as heating',
                    'u.name as seller',
                    'i.name as image',
                    DB::raw("CONCAT(a.street, ' ' , a.number, ', ', ci.name, ', ', co.name) as address")
                )->orderByDesc('properties.id');;

        if (isset($id) && $id > 0){
            return $query->find($id);
        }

        if (!empty($category) && $category > 0){
            $query->where('c.id', '=', $category);
        }

        if (!empty($type) && ($type === "1" || $type === "2")){
            $type === "1" ? $type = "For Rent" : $type = "For Sale";
            $query->where('properties.type', '=', $type);
        }

        if (!empty($keywords) && preg_match('/^[a-zA-Z]+$/', $keywords)) {
            $query->where('properties.title', 'like', "%{$keywords}%");
        }

        return $query->paginate(9, ['*'], 'page', $page);
    }
}
