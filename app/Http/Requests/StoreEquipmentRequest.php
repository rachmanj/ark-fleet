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
            'unit_no'   => ['required', 'unique:equipments,unit_no'],
            'description'   => ['required'],
            'model_id'   => ['required'],
            'category_id'   => ['required'],
            'unitstatus_id'   => ['required'],
            'current_project_id'   => ['required'],
        ];
    }
}
