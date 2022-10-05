<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Auth;

class StoreTaskRequest extends ValidationRequest
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
            'title'         => ['required', 'max:50'],
            'description'   => ['min:5'],
            'importance'    => ['boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['user_id' => Auth::id()]);
    }

}
