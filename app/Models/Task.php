<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'end_date',
        'importance',
        'status',
    ];

    public function __construct(array $attributes = [])
    {
        $this->user_id = Auth::id();
        parent::__construct($attributes);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }

    public function scopeOfUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function delete()
    {
        $this->attachments()->delete();
        return parent::delete();
    }
}
