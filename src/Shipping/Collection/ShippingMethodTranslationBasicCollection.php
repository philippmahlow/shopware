<?php declare(strict_types=1);

namespace Shopware\Shipping\Collection;

use Shopware\Api\Entity\EntityCollection;
use Shopware\Shipping\Struct\ShippingMethodTranslationBasicStruct;

class ShippingMethodTranslationBasicCollection extends EntityCollection
{
    /**
     * @var ShippingMethodTranslationBasicStruct[]
     */
    protected $elements = [];

    public function get(string $uuid): ? ShippingMethodTranslationBasicStruct
    {
        return parent::get($uuid);
    }

    public function current(): ShippingMethodTranslationBasicStruct
    {
        return parent::current();
    }

    public function getShippingMethodUuids(): array
    {
        return $this->fmap(function (ShippingMethodTranslationBasicStruct $shippingMethodTranslation) {
            return $shippingMethodTranslation->getShippingMethodUuid();
        });
    }

    public function filterByShippingMethodUuid(string $uuid): ShippingMethodTranslationBasicCollection
    {
        return $this->filter(function (ShippingMethodTranslationBasicStruct $shippingMethodTranslation) use ($uuid) {
            return $shippingMethodTranslation->getShippingMethodUuid() === $uuid;
        });
    }

    public function getLanguageUuids(): array
    {
        return $this->fmap(function (ShippingMethodTranslationBasicStruct $shippingMethodTranslation) {
            return $shippingMethodTranslation->getLanguageUuid();
        });
    }

    public function filterByLanguageUuid(string $uuid): ShippingMethodTranslationBasicCollection
    {
        return $this->filter(function (ShippingMethodTranslationBasicStruct $shippingMethodTranslation) use ($uuid) {
            return $shippingMethodTranslation->getLanguageUuid() === $uuid;
        });
    }

    protected function getExpectedClass(): string
    {
        return ShippingMethodTranslationBasicStruct::class;
    }
}
