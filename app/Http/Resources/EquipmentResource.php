<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'unit_code' => $this->unit_no,
            'project' => $this->current_project->project_code,
            'plant_group' => $this->plant_group->name,
            'model' => $this->unitmodel->model_no,
        ];
    }
}
