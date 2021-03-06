<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovingRequest extends FormRequest
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
            'ipa_date' => ['required'],
            'from_project_id' => ['required'],
            'to_project_id' => ['required'],
            'tujuan_row_1' => ['required'],
            'cc_row_1' => ['required'],
        ];
    }
}
