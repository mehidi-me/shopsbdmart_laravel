<?php

namespace App\Http\Resources\V2;
use App\Models\Review;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductMiniCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'slug' => $data->slug,
                    'name' => $data->name,
                    'thumbnail_image' => api_asset($data->thumbnail_img),
                    'base_price' => format_price(homeBasePrice($data->id)),
                    'stroked_price' => home_base_price($data->id),
                    'main_price' => home_discounted_base_price($data->id),
                    'has_discount' => homeBasePrice($data->id) != homeDiscountedBasePrice($data->id),
                    'rating' => (double) $data->rating,
                    'sales' => (integer) $data->num_of_sale,
                    'rating_count' => (integer) Review::where(['product_id' => $data->id])->where(['status' => 1])->count(),
                    'links' => [
                        'details' => route('products.show', $data->id),
                    ]
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
