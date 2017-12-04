<?php declare(strict_types=1);

namespace Shopware\Listing\Struct;

use Shopware\Shop\Struct\ShopBasicStruct;

class ListingSortingTranslationDetailStruct extends ListingSortingTranslationBasicStruct
{
    /**
     * @var ListingSortingBasicStruct
     */
    protected $listingSorting;

    /**
     * @var ShopBasicStruct
     */
    protected $language;

    public function getListingSorting(): ListingSortingBasicStruct
    {
        return $this->listingSorting;
    }

    public function setListingSorting(ListingSortingBasicStruct $listingSorting): void
    {
        $this->listingSorting = $listingSorting;
    }

    public function getLanguage(): ShopBasicStruct
    {
        return $this->language;
    }

    public function setLanguage(ShopBasicStruct $language): void
    {
        $this->language = $language;
    }
}
