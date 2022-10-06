<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelMixins\Request\ConvertsBase64ToFiles;

class AttachmentsRequest extends FormRequest
{
    use ConvertsBase64ToFiles;

    protected function base64FileKeys()
    {
        $result = [];
        foreach ($this->input('attachments') as $key => $value) {
            $ext = explode(';base64',$value['file']);
            $ext = explode('/',$ext[0]);
            $ext = $ext[1];
            $result["attachments.$key.file"] =  Str::random(10) . $key ."." . $ext;
        }
        return $result;
    }

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
            "attachments"    => ['array'],
            'attachments.*.file' => ['file', 'image'],
        ];
    }
}
