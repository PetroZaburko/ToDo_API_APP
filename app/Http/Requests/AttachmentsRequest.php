<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ProtoneMedia\LaravelMixins\Request\ConvertsBase64ToFiles;

class AttachmentsRequest extends FormRequest
{
    use ConvertsBase64ToFiles;

    protected function base64FileKeys()
    {
        return [
            'attachments' => 'test123.jpg',
        ];
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
            'attachments.file' => ['file', 'image']
//            "attachments"    => ['array'],
//            "attachments"    => ['array'],
//            "attachments.file"  => ['string'],
        ];
    }
}
