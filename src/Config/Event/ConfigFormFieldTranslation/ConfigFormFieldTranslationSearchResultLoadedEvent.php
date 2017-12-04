<?php declare(strict_types=1);

namespace Shopware\Config\Event\ConfigFormFieldTranslation;

use Shopware\Config\Struct\ConfigFormFieldTranslationSearchResult;
use Shopware\Context\Struct\TranslationContext;
use Shopware\Framework\Event\NestedEvent;

class ConfigFormFieldTranslationSearchResultLoadedEvent extends NestedEvent
{
    const NAME = 'config_form_field_translation.search.result.loaded';

    /**
     * @var ConfigFormFieldTranslationSearchResult
     */
    protected $result;

    public function __construct(ConfigFormFieldTranslationSearchResult $result)
    {
        $this->result = $result;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getContext(): TranslationContext
    {
        return $this->result->getContext();
    }
}
