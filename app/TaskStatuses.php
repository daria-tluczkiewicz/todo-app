<?php

namespace App;

enum TaskStatuses: string
{
    case TODO = 'todo';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';

    public function getPolishTranslations(): string
    {
      return match ($this) {
        self::TODO => 'Do zrobienia',
        self::IN_PROGRESS => 'W realizacji',
        self::DONE => 'Wykonano',
      };
    }

    public static function default(): string
    {
      return self::TODO->value;
    }
}
