<div data-task-id="{{ $task->id }}" class="task {{ $task->priority }}">
  <div class="header">
    <h2 data-name="title">{{ $task->title }}</h2>
  </div>
  @if(isset($task->content))
    <p data-name="content" class="task-content">{{ $task->content }}</p>
  @endif
  <div class="footer">
    @if(isset($task->status))
      <div>
        <span>Status:</span>
        <span>{{ \App\TaskStatuses::from($task->status)->getPolishTranslations() }}</span>
      </div>
    @endif
    @if(isset($task->status))
      <div>
        <span>Priorytet:</span>
        <span>{{ \App\PriorityOptions::from($task->priority)->getPolishTranslations() }}</span>
      </div>
    @endif
    @if(isset($task->status))
      <div>
        <span>Termin:</span>
        <span>{{ $task->date_due->format('Y-m-d') }}</span>
      </div>
    @endif
  </div>
</div>
