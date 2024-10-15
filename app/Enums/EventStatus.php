<?php

namespace App\Enums;

enum EventStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case CANCELLED = 'cancelled';
}
