<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BoardModalRequest extends FormRequest
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
            'editName'  => 'nullable|between:3,16',
            'editTitle' => 'required|between:10,32',
            'editBody'  => 'required|between:10,200',
            'editImage' => 'image|max:1000'
        ];
    }

    protected function failedValidation($validator) {
        $validator->errors()->add('errorModal', Request::url());

        throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());
    }

    public function attributes()
    {
        return [
            'editName'  => 'name',
            'editTitle' => 'title',
            'editBody'  => 'body',
            'editImage' => 'image'
        ];
    }
}
