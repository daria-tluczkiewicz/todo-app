<div class="priority-selector">
  <p class="priority-text">Priorytet</p>
  @foreach(\App\PriorityOptions::cases() as $priority)
    <input
      type="radio"
      name="priority-{{ $taskId }}"
      id="priority-{{ $priority->value . '-' . $taskId }}"
      value="{{ $priority->value }}"
      data-name="priority"
      class="live-update"
      @checked($priority->value === $selectedPriority)
    >
    <label for="priority-{{ $taskId }}">
      {{ $priority->getPolishTranslations() }}
    </label>
  @endforeach
</div>
