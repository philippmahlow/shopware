<?php declare(strict_types=1);

namespace Shopware\Order\Definition;

use Shopware\Api\Entity\EntityDefinition;
use Shopware\Api\Entity\EntityExtensionInterface;
use Shopware\Api\Entity\Field\BoolField;
use Shopware\Api\Entity\Field\DateField;
use Shopware\Api\Entity\Field\IntField;
use Shopware\Api\Entity\Field\OneToManyAssociationField;
use Shopware\Api\Entity\Field\StringField;
use Shopware\Api\Entity\Field\TranslatedField;
use Shopware\Api\Entity\Field\TranslationsAssociationField;
use Shopware\Api\Entity\Field\UuidField;
use Shopware\Api\Entity\FieldCollection;
use Shopware\Api\Write\Flag\PrimaryKey;
use Shopware\Api\Write\Flag\Required;
use Shopware\Mail\Definition\MailDefinition;
use Shopware\Order\Collection\OrderStateBasicCollection;
use Shopware\Order\Collection\OrderStateDetailCollection;
use Shopware\Order\Event\OrderState\OrderStateWrittenEvent;
use Shopware\Order\Repository\OrderStateRepository;
use Shopware\Order\Struct\OrderStateBasicStruct;
use Shopware\Order\Struct\OrderStateDetailStruct;

class OrderStateDefinition extends EntityDefinition
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
        return 'order_state';
    }

    public static function getFields(): FieldCollection
    {
        if (self::$fields) {
            return self::$fields;
        }

        self::$fields = new FieldCollection([
            (new UuidField('uuid', 'uuid'))->setFlags(new PrimaryKey(), new Required()),
            (new StringField('name', 'name'))->setFlags(new Required()),
            (new StringField('type', 'type'))->setFlags(new Required()),
            (new TranslatedField(new StringField('description', 'description')))->setFlags(new Required()),
            new IntField('position', 'position'),
            new BoolField('has_mail', 'hasMail'),
            new DateField('created_at', 'createdAt'),
            new DateField('updated_at', 'updatedAt'),
            new OneToManyAssociationField('mails', MailDefinition::class, 'order_state_uuid', false, 'uuid'),
            new OneToManyAssociationField('orders', OrderDefinition::class, 'order_state_uuid', false, 'uuid'),
            new OneToManyAssociationField('orderDeliveries', OrderDeliveryDefinition::class, 'order_state_uuid', false, 'uuid'),
            (new TranslationsAssociationField('translations', OrderStateTranslationDefinition::class, 'order_state_uuid', false, 'uuid'))->setFlags(new Required()),
        ]);

        foreach (self::$extensions as $extension) {
            $extension->extendFields(self::$fields);
        }

        return self::$fields;
    }

    public static function getRepositoryClass(): string
    {
        return OrderStateRepository::class;
    }

    public static function getBasicCollectionClass(): string
    {
        return OrderStateBasicCollection::class;
    }

    public static function getWrittenEventClass(): string
    {
        return OrderStateWrittenEvent::class;
    }

    public static function getBasicStructClass(): string
    {
        return OrderStateBasicStruct::class;
    }

    public static function getTranslationDefinitionClass(): ?string
    {
        return OrderStateTranslationDefinition::class;
    }

    public static function getDetailStructClass(): string
    {
        return OrderStateDetailStruct::class;
    }

    public static function getDetailCollectionClass(): string
    {
        return OrderStateDetailCollection::class;
    }
}
