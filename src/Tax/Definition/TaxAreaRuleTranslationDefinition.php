<?php declare(strict_types=1);

namespace Shopware\Tax\Definition;

use Shopware\Api\Entity\EntityDefinition;
use Shopware\Api\Entity\EntityExtensionInterface;
use Shopware\Api\Entity\Field\FkField;
use Shopware\Api\Entity\Field\ManyToOneAssociationField;
use Shopware\Api\Entity\Field\StringField;
use Shopware\Api\Entity\FieldCollection;
use Shopware\Api\Write\Flag\PrimaryKey;
use Shopware\Api\Write\Flag\Required;
use Shopware\Shop\Definition\ShopDefinition;
use Shopware\Tax\Collection\TaxAreaRuleTranslationBasicCollection;
use Shopware\Tax\Collection\TaxAreaRuleTranslationDetailCollection;
use Shopware\Tax\Event\TaxAreaRuleTranslation\TaxAreaRuleTranslationWrittenEvent;
use Shopware\Tax\Repository\TaxAreaRuleTranslationRepository;
use Shopware\Tax\Struct\TaxAreaRuleTranslationBasicStruct;
use Shopware\Tax\Struct\TaxAreaRuleTranslationDetailStruct;

class TaxAreaRuleTranslationDefinition extends EntityDefinition
{
    /**
     * @var FieldCollection
     */
    protected static $primaryKeys;

    /**
     * @var FieldCollection
     */
    protected static $fields;

    /**
     * @var EntityExtensionInterface[]
     */
    protected static $extensions = [];

    public static function getEntityName(): string
    {
        return 'tax_area_rule_translation';
    }

    public static function getFields(): FieldCollection
    {
        if (self::$fields) {
            return self::$fields;
        }

        self::$fields = new FieldCollection([
            (new FkField('tax_area_rule_uuid', 'taxAreaRuleUuid', TaxAreaRuleDefinition::class))->setFlags(new PrimaryKey(), new Required()),
            (new FkField('language_uuid', 'languageUuid', ShopDefinition::class))->setFlags(new PrimaryKey(), new Required()),
            (new StringField('name', 'name'))->setFlags(new Required()),
            new ManyToOneAssociationField('taxAreaRule', 'tax_area_rule_uuid', TaxAreaRuleDefinition::class, false),
            new ManyToOneAssociationField('language', 'language_uuid', ShopDefinition::class, false),
        ]);

        foreach (self::$extensions as $extension) {
            $extension->extendFields(self::$fields);
        }

        return self::$fields;
    }

    public static function getRepositoryClass(): string
    {
        return TaxAreaRuleTranslationRepository::class;
    }

    public static function getBasicCollectionClass(): string
    {
        return TaxAreaRuleTranslationBasicCollection::class;
    }

    public static function getWrittenEventClass(): string
    {
        return TaxAreaRuleTranslationWrittenEvent::class;
    }

    public static function getBasicStructClass(): string
    {
        return TaxAreaRuleTranslationBasicStruct::class;
    }

    public static function getTranslationDefinitionClass(): ?string
    {
        return null;
    }

    public static function getDetailStructClass(): string
    {
        return TaxAreaRuleTranslationDetailStruct::class;
    }

    public static function getDetailCollectionClass(): string
    {
        return TaxAreaRuleTranslationDetailCollection::class;
    }
}
