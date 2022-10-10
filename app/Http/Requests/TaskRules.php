<?php


namespace App\Http\Requests;


use Illuminate\Support\Str;

trait TaskRules
{
    protected function taskRules()
    {
        return [
            'title'                 => ['required', 'min:3', 'max:50'],
            'description'           => ['min:5'],
            'importance'            => ['boolean'],
            "attachments"           => ['array'],
            'attachments.*.file'    => ['file', 'image'],
        ];
    }

    protected function prepareFileKeys($fileKey)
    {
        $result = [];

        if (!empty($this->input($fileKey))) {
            foreach ($this->input($fileKey) as $key => $value) {
                $ext = explode(';base64', $value['file']);
                $ext = explode('/', $ext[0]);
                $ext = $ext[1];
                $result["$fileKey.$key.file"] =  Str::random(10) . "." . $ext;
            }
        }
        return $result;
    }

}
