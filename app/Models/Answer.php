<?php

namespace App\Models;

use Conner\Likeable\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  use HasFactory, Likeable;

  protected $fillable = [
    'user_id',
    'discussion_id',
    'answer',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function discussion()
  {
    return $this->belongsTo(Discussion::class);
  }
}
