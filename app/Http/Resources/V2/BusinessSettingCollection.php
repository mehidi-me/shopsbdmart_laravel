<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BusinessSettingCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $value = $data->value;
                if($data->type == 'meta_image'){
                    $value = api_asset($data->value);
                }
                if($data->type == 'system_logo_white'){
                    $value = api_asset($data->value);
                }
                 if($data->type == 'site_icon'){
                    $value = api_asset($data->value);
                }
                return [
                    'type' => $data->type,
                    'value' => $value
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
