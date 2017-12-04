<?php declare(strict_types=1);

namespace Shopware\Mail\Event\MailAttachment;

use Shopware\Context\Struct\TranslationContext;
use Shopware\Framework\Event\NestedEvent;
use Shopware\Framework\Event\NestedEventCollection;
use Shopware\Mail\Collection\MailAttachmentDetailCollection;
use Shopware\Mail\Event\Mail\MailBasicLoadedEvent;
use Shopware\Media\Event\Media\MediaBasicLoadedEvent;
use Shopware\Shop\Event\Shop\ShopBasicLoadedEvent;

class MailAttachmentDetailLoadedEvent extends NestedEvent
{
    const NAME = 'mail_attachment.detail.loaded';

    /**
     * @var TranslationContext
     */
    protected $context;

    /**
     * @var MailAttachmentDetailCollection
     */
    protected $mailAttachments;

    public function __construct(MailAttachmentDetailCollection $mailAttachments, TranslationContext $context)
    {
        $this->context = $context;
        $this->mailAttachments = $mailAttachments;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getContext(): TranslationContext
    {
        return $this->context;
    }

    public function getMailAttachments(): MailAttachmentDetailCollection
    {
        return $this->mailAttachments;
    }

    public function getEvents(): ?NestedEventCollection
    {
        $events = [];
        if ($this->mailAttachments->getMails()->count() > 0) {
            $events[] = new MailBasicLoadedEvent($this->mailAttachments->getMails(), $this->context);
        }
        if ($this->mailAttachments->getMedia()->count() > 0) {
            $events[] = new MediaBasicLoadedEvent($this->mailAttachments->getMedia(), $this->context);
        }
        if ($this->mailAttachments->getShops()->count() > 0) {
            $events[] = new ShopBasicLoadedEvent($this->mailAttachments->getShops(), $this->context);
        }

        return new NestedEventCollection($events);
    }
}
