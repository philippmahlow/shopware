<?php declare(strict_types=1);

namespace Shopware\Media\Struct;

use Shopware\Media\Collection\MediaAlbumTranslationBasicCollection;
use Shopware\Media\Collection\MediaBasicCollection;

class MediaAlbumDetailStruct extends MediaAlbumBasicStruct
{
    /**
     * @var MediaAlbumBasicStruct|null
     */
    protected $parent;

    /**
     * @var MediaBasicCollection
     */
    protected $media;

    /**
     * @var MediaAlbumTranslationBasicCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->media = new MediaBasicCollection();

        $this->translations = new MediaAlbumTranslationBasicCollection();
    }

    public function getParent(): ?MediaAlbumBasicStruct
    {
        return $this->parent;
    }

    public function setParent(?MediaAlbumBasicStruct $parent): void
    {
        $this->parent = $parent;
    }

    public function getMedia(): MediaBasicCollection
    {
        return $this->media;
    }

    public function setMedia(MediaBasicCollection $media): void
    {
        $this->media = $media;
    }

    public function getTranslations(): MediaAlbumTranslationBasicCollection
    {
        return $this->translations;
    }

    public function setTranslations(MediaAlbumTranslationBasicCollection $translations): void
    {
        $this->translations = $translations;
    }
}
