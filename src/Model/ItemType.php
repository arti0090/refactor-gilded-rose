<?php

declare(strict_types=1);

namespace App\Model;

interface ItemType
{
    public const DEFAULT_ITEM_TYPE = 'default';
    public const LEGENDARY_ITEM_TYPE = 'legendary';
    public const APPRECIATING_ITEM_TYPE = 'appreciating';
    public const EVENT_PASS_ITEM_TYPE = 'event_pass';
}
