<?php


namespace App\Actions;


use App\Http\Requests\AttachmentsRequest;
use App\Models\Attachment;

class StoreTaskAttachmentsAction
{
    protected $request;

    public function __construct(AttachmentsRequest $request)
    {
        $this->request = $request;
    }

    public function store($task_id)
    {
        foreach ($this->request->file('attachments') as $file) {
            $attachment = $file['file'];
            $file = $attachment->store('/uploads', 'attachments');
            Attachment::create([
                'file' => $file,
                'task_id' => $task_id
            ]);
        }
    }


}
