<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
  protected $table = 'task_history';

  protected $fillable = [
    'task_id',
    'action',
    'change_type',
    'changed_from',
    'changed_to',
  ];

  public function task(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Task::class);
  }
}
