<?php declare(strict_types=1);

namespace Shopware\Product\Event\ProductMedia;

use Shopware\Context\Struct\TranslationContext;
use Shopware\Framework\Event\NestedEvent;
use Shopware\Framework\Event\NestedEventCollection;
use Shopware\Media\Event\Media\MediaBasicLoadedEvent;
use Shopware\Product\Collection\ProductMediaDetailCollection;
use Shopware\Product\Event\Product\ProductBasicLoadedEvent;

class ProductMediaDetailLoadedEvent extends NestedEvent
{
    const NAME = 'product_media.detail.loaded';

    /**
     * @var TranslationContext
     */
    protected $context;

    /**
     * @var ProductMediaDetailCollection
     */
    protected $productMedia;

    public function __construct(ProductMediaDetailCollection $productMedia, TranslationContext $context)
    {
        $this->context = $context;
        $this->productMedia = $productMedia;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getContext(): TranslationContext
    {
        return $this->context;
    }

    public function getProductMedia(): ProductMediaDetailCollection
    {
        return $this->productMedia;
    }

    public function getEvents(): ?NestedEventCollection
    {
        $events = [];
        if ($this->productMedia->getProducts()->count() > 0) {
            $events[] = new ProductBasicLoadedEvent($this->productMedia->getProducts(), $this->context);
        }
        if ($this->productMedia->getMedia()->count() > 0) {
            $events[] = new MediaBasicLoadedEvent($this->productMedia->getMedia(), $this->context);
        }

        return new NestedEventCollection($events);
    }
}
