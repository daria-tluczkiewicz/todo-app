<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static create(array $array)
 */
class Task extends Model
{
  protected $fillable = [
    'uuid',
    'user_id',
    'title',
    'content',
    'date_due',
    'priority',
    'status',
  ];

  protected $casts = [
    'date_due' => 'date',
    'date_done' => 'date',
  ];

  public function history(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(TaskHistory::class);
  }

  public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function shared(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(SharedTask::class);
  }
}
