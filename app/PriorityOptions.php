<?php

namespace App;

enum PriorityOptions: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function getPolishTranslations(): string
    {
      return match($this) {
        self::LOW => 'Niski',
        self::MEDIUM => 'Średni',
        self::HIGH => 'Wysoki'
      };
    }
};
