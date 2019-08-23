<?php

namespace App\Listener;



use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{

    private $cacheManager;

    private $helper;

    /**
     * ImageCacheSubscriber constructor.
     * @param CacheManager $manager
     * @param UploaderHelper $
     */
    public function __construct(CacheManager $manager, UploaderHelper $helper)
    {
        $this->cacheManager = $manager;
        $this->helper = $helper;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return[
            'preRemove',
            'preUpdate'
        ];
    }


    public function preRemove(PreFlushEventArgs $eventArgs)
    {

    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        dump($args->getEntity());
        dump($args->getObject());
    }
}
