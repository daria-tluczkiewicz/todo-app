<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Todo App</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
  <body>
  <nav>
    <ul>
      <li><a href="/">Lista zadań</a></li>
      <li><a href="/tasks/history">Historia zmian</a></li>
      <li><a href="/logout">Wyloguj</a></li>
    </ul>
  </nav>
    <main class="main">
      @csrf
      {{ $slot }}
    </main>
  </body>
</html>
