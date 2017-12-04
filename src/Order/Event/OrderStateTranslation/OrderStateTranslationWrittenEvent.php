<?php declare(strict_types=1);

namespace Shopware\Order\Event\OrderStateTranslation;

use Shopware\Api\Write\WrittenEvent;
use Shopware\Order\Definition\OrderStateTranslationDefinition;

class OrderStateTranslationWrittenEvent extends WrittenEvent
{
    const NAME = 'order_state_translation.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getDefinition(): string
    {
        return OrderStateTranslationDefinition::class;
    }
}
