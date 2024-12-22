<?php

namespace App\View\Components;

use App\Models\Task;
use App\PriorityOptions;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PrioritySelector extends Component
{
  private $selectedPriority;
  private string $taskId;

    public function __construct($selectedPriority = null, $taskId = null)
    {
        $this->selectedPriority = $selectedPriority?? PriorityOptions::LOW;;
        $this->taskId = $taskId?? Task::max('id') + 1;
    }

    public function render(): View|Closure|string
    {
        return view('components.priority-selector', with(['selectedPriority' => $this->selectedPriority, 'taskId' => $this->taskId]));
    }
}
