<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['required'],
            'unitmodel_id' => ['required'],
            'plant_type_id' => ['required'],
            'asset_category_id' => ['required'],
            'unitstatus_id' => ['required'],
            'current_project_id' => ['required'],
        ];
    }
}
