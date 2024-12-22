<section class="create_task">
  <div class="container">
  <h2>Dodaj nowe zadanie</h2>
  @if ($errors->any())
    <div class="error-message">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="{{ route('task.create') }}" method="POST" id="createTaskForm">
    @csrf
    <input type="hidden" name="date_added" value="{{ today()->format('Y-m-d')}}">
    <input type="hidden" name="status" value="{{ \App\TaskStatuses::default() }}">
    <div class="form-group">
      <label for="title">Nazwa</label>
      <input type="text" name="title" id="title" value="{{ old('title') }}" required>
    </div>
    <div class="form-group">
      <label for="content">Opis</label>
      <textarea name="content" id="content" rows="4">{{ old('content') }}</textarea>
    </div>
    <div class="form-group">
      <label for="date_due">Termin</label>
      <input type="date" min="{{ today() }}" name="date_due" id="date_due" value="{{ old('date_due') }}" required>
    </div>
    <div class="form-group">
      <x-priority-selector selectedPriority="{{ old('priority') }}"></x-priority-selector>
    </div>
    <button type="submit" class="btn">Dodaj zadanie</button>
  </form>
</div>
</section>
