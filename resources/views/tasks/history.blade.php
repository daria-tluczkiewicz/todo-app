<x-layout>
  <section class="history">
    <h2>Historia</h2>
    @foreach($taskHistory as $task)
      <div class="task-history">
        <div class="task-history-header">
          <span>Nazwa zadania: </span>
          <span>{{$task->title}}</span>
        </div>
        <div class="task-history-changes">
          @foreach($task->history as $history)
            <div class="change {{$history->change_type}}">
              @if($history->change_type === 'priority')
                <p>Zaktualizowano priorytet</p>
                <p class="changed-from">Z: {{ \App\PriorityOptions::from($history->changed_from)->getPolishTranslations() }}</p>
                <p class="changed-to">Na: {{ \App\PriorityOptions::from($history->changed_to)->getPolishTranslations() }}</p>
              @elseif($history->change_type === 'status')
                <p>Zaktualizowano status</p>
                <p class="changed-from">Z: {{ \App\TaskStatuses::from($history->changed_from)->getPolishTranslations() }}</p>
                <p class="changed-to">Na: {{ \App\TaskStatuses::from($history->changed_to)->getPolishTranslations() }}</p>
              @elseif($history->change_type === 'date_due')
                <p>Zaktualizowano termin</p>
                <p class="changed-from">Z: {{ substr($history->changed_from, 0, 10) }}</p>
                <p class="changed-to">Na: {{ substr($history->changed_to, 0, 10)}}</p>
              @elseif($history->change_type === 'title')
                  <p>Zaktualizowano tytuł</p>
                <p class="changed-from">Z: {{ $history->changed_from }}</p>
                <p class="changed-to">Na: {{ $history->changed_to}}</p>
              @else
                <p>Zaktualizowano treść</p>
                <p class="changed-from">Z: {{ $history->changed_from }}</p>
                <p class="changed-to">Na: {{ $history->changed_to}}</p>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </section>
</x-layout>
