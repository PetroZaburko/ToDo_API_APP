<?php

namespace App\Http\Requests;

use ProtoneMedia\LaravelMixins\Request\ConvertsBase64ToFiles;

class FillTaskRequest extends ValidationRequest
{
    use TaskRules, ConvertsBase64ToFiles { prepareForValidation as protected prepareForValidationTrait; }
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
        $test =  array_merge(
            ['tasks' => ['array']],
            $this->prependKeysWith($this->taskRules(), 'tasks.*.')
        );

        return $test;
    }

    protected function base64FileKeys()
    {
        $result = [];
        foreach ($this->input('tasks') as $key => $value) {
            $attachments = $this->prepareFileKeys("tasks.$key.attachments");
            $result = array_merge($result, $attachments);
        }
//        dd($result);

        return $result;
    }


    protected function prependKeysWith($array, $prefix)
    {
        return array_combine(array_map(function($key) use ($prefix) { return $prefix . $key; }, array_keys($array)), $array);
    }
}
