<?php declare(strict_types=1);

namespace Shopware\Mail\Collection;

use Shopware\Api\Entity\EntityCollection;
use Shopware\Mail\Struct\MailTranslationBasicStruct;

class MailTranslationBasicCollection extends EntityCollection
{
    /**
     * @var MailTranslationBasicStruct[]
     */
    protected $elements = [];

    public function get(string $uuid): ? MailTranslationBasicStruct
    {
        return parent::get($uuid);
    }

    public function current(): MailTranslationBasicStruct
    {
        return parent::current();
    }

    public function getMailUuids(): array
    {
        return $this->fmap(function (MailTranslationBasicStruct $mailTranslation) {
            return $mailTranslation->getMailUuid();
        });
    }

    public function filterByMailUuid(string $uuid): MailTranslationBasicCollection
    {
        return $this->filter(function (MailTranslationBasicStruct $mailTranslation) use ($uuid) {
            return $mailTranslation->getMailUuid() === $uuid;
        });
    }

    public function getLanguageUuids(): array
    {
        return $this->fmap(function (MailTranslationBasicStruct $mailTranslation) {
            return $mailTranslation->getLanguageUuid();
        });
    }

    public function filterByLanguageUuid(string $uuid): MailTranslationBasicCollection
    {
        return $this->filter(function (MailTranslationBasicStruct $mailTranslation) use ($uuid) {
            return $mailTranslation->getLanguageUuid() === $uuid;
        });
    }

    protected function getExpectedClass(): string
    {
        return MailTranslationBasicStruct::class;
    }
}
