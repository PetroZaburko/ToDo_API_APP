<?php


namespace App\Actions;


use App\Http\Requests\AttachmentsRequest;
use App\Models\Attachment;
use Illuminate\Support\Arr;

class StoreTaskAttachmentsAction
{
    protected $files;

    public function __construct(AttachmentsRequest $request)
    {
        $this->files = Arr::pluck($request->file('attachments'), 'file');
    }

    public function store($task_id)
    {
        foreach ($this->files as $file) {
            $attachment = $file;
            $file = $attachment->store('/uploads', 'attachments');
            Attachment::create([
                'file' => $file,
                'task_id' => $task_id
            ]);
        }
    }


}
