<x-layout>
    @include('tasks.create')
  <section class="todo">
    <h1>Twoja lista todo:</h1>
    <div class="task-filter">
      <h1>Filtrowanie listy zadań</h1>
      <form action="/tasks/filter" method="GET" class="filter-form">
        <!-- Priority Filter -->
        <div class="filter-group">
          <label for="priority" class="filter-label">Priorytet</label>
          <select name="priority" id="priority" class="filter-select">
            <option value="">Wybierz priorytet</option>
            <option value="high">Wysoki</option>
            <option value="medium">Średni</option>
            <option value="low">Niski</option>
          </select>
        </div>
        <!-- Status Filter -->
        <div class="filter-group">
          <label for="status" class="filter-label">Status</label>
          <select name="status" id="status" class="filter-select">
            <option value="">Wybierz status</option>
            @foreach(\App\TaskStatuses::cases() as $status)
              <option value="{{ $status }}">{{ $status->getPolishTranslations() }}</option>
            @endforeach
          </select>
        </div>
        <!-- Due Date Filter -->
        <div class="filter-group">
          <label for="date_due" class="filter-label">Termin</label>
          <input type="date" name="date_due" id="date_due" class="filter-input">
        </div>
        <!-- Submit Button -->
        <div class="filter-group">
          <button type="submit" class="filter-button">Filtruj</button>
          <a href="/" type="button" class="remove-filters-button">Usuń filtry</a>
        </div>
      </form>
    </div>
    <div class="tasks-list">
      @foreach($userTasks as $task)
      <div data-task-id="{{ $task->id }}" class="task {{ $task->priority }}">
        <div class="header">
          <h2 contenteditable="true" data-name="title">{{ $task->title }}</h2>
          <button class="button delete">Usuń</button>
        </div>
        <p contenteditable="true" data-name="content" class="task-content">{{ $task->content }}</p>
        <div class="footer">
          <select class="live-update" data-name="status">
            @foreach(\App\TaskStatuses::cases() as $status)
              <option value="{{ $status }}" @selected($task->status === $status->value)>{{ $status->getPolishTranslations() }}</option>
            @endforeach
          </select>
          <x-priority-selector
            taskId="{{ $task->id }}"
            selectedPriority="{{ $task->priority }}"
          ></x-priority-selector>
          <div class="due">
            <label for="due-{{ $task->id }}">Termin</label>
            <input
              type="date"
              class="live-update"
              data-name="date_due"
              id="due-{{ $task->id }}"
              name="due-{{ $task->id }}"
              value="{{ $task->date_due->format('Y-m-d') }}"
            >
          </div>
          <div class="button share">Udostępnij</div>
        </div>
        <div class="error-message"></div>
      </div>
    @endforeach
    </div>
    <div class="share-task-dialog" id="shareTaskDialog">
      <span>Twój link do udostępnienia zadania:</span>
      <div class="link-container">
        <a id="shareTaskLink"></a>
        <button id="copyShareTaskDialog">Kopiuj link</button>
      </div>
      <button id="closeShareTaskDialog">Zamknij</button>
    </div>
  </section>
</x-layout>

