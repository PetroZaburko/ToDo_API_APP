<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'task_id'
    ];

    public function task()
    {
        return $this->belongsTo(Attachment::class);
    }

    public function delete()
    {
        Storage::disk('attachments')->delete($this->file);
        return parent::delete();
    }
}
