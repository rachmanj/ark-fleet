<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'equipment_id' => ['required'],
            'document_type_id' => ['required'],
            'document_no' => ['required'],
            'document_date' => ['required'],
            'supplier_id' => ['integer'],
            'amount' => ['integer'],
            'due_date' => ['date'],
            'remarks' => ['string']
        ];
    }
}
