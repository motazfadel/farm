<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Models\App_Notification;
use App\Http\Resources\InvoicetypeResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        $maintenances = array();
        foreach ($this->resource as $maintenance) {
            $maintenances[] = array(
        
            'id' => $maintenance->id,
            'total' => $maintenance->total,
            'created_at' => $maintenance->created_at,
            'user_name' =>  new InvoicetypeResource($maintenance->user),

        );
    }
        return $maintenances;
    }
}
