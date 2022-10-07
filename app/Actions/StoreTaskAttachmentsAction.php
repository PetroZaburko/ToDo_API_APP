<?php


namespace App\Actions;

use App\Models\Attachment;

class StoreTaskAttachmentsAction
{

    public function store($files, $task_id)
    {
        foreach ($files as $file) {
            $attachment = $file['file'];
            $file = $attachment->store('/uploads', 'attachments');
            Attachment::create([
                'file'      => $file,
                'task_id'   => $task_id
            ]);
        }
    }

}
