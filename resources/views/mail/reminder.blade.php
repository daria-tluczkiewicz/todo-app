<body>
  <div class="container">
    <h1>Przypomnienie o Zadaniu</h1>
    <p>Szanowny/a {{ $task->user->name }},</p>
    <p>Przypominamy, że termin realizacji poniższego zadania upływa jutro</p>
    <div class="task-details">
      <p><span class="label">Tytuł zadania:</span> {{ $task->title }}</p>
      <p><span class="label">Opis:</span> {{ $task->content }}</p>
      <p><span class="label">Priorytet:</span> {{ ucfirst($task->priority) }}</p>
      <p><span class="label">Status:</span> {{ ucfirst($task->status) }}</p>
      <p><span class="label">Termin wykonania:</span> {{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</p>
    </div>
    <div class="footer">
      <p>Pozdrawiamy,</p>
      <p>Zespół Twojej Aplikacji do Zarządzania Zadaniami</p>
      <p><a href="{{ url('/') }}">Przejdź do Panelu</a></p>
    </div>
  </div>
</body>
