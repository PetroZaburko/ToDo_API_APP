<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelMixins\Request\ConvertsBase64ToFiles;

class StoreTaskRequest extends ValidationRequest
{

    use ConvertsBase64ToFiles { prepareForValidation as protected prepareForValidationTrait; }

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
            'title'                 => ['required', 'min:3', 'max:50'],
            'description'           => ['min:5'],
            'importance'            => ['boolean'],
            "attachments"           => ['array'],
            'attachments.*.file'    => ['file', 'image'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['user_id' => Auth::id()]);
        return $this->prepareForValidationTrait();
    }

    protected function base64FileKeys()
    {
        $result = [];

        if (!empty($this->input('attachments'))) {
            foreach ($this->input('attachments') as $key => $value) {
                $ext = explode(';base64', $value['file']);
                $ext = explode('/', $ext[0]);
                $ext = $ext[1];
                $result["attachments.$key.file"] =  Str::random(10) . "." . $ext;
            }
        }
        return $result;
    }

}
