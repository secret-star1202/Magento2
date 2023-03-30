<?php

namespace Magenest\Movie\Block;

use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory as DirectorCollectionFactory;
use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory as ActorCollectionFatory;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory as MovieCollectionFactory;
use Magento\Framework\View\Element\Template;

class Display extends Template
{
    protected $_directorCollectionFactory;
    protected $_actorCollectionFactory;
    protected $_movieCollectionFactory;

    public function __construct(
        Template\Context $context,
        DirectorCollectionFactory  $directorCollectionFactory,
        ActorCollectionFatory     $actorCollectionFactory,
        MovieCollectionFactory     $movieCollectionFactory
    ) {
        $this->_directorCollectionFactory = $directorCollectionFactory;
        $this->_actorCollectionFactory = $actorCollectionFactory;
        $this->_movieCollectionFactory = $movieCollectionFactory;

        parent::__construct($context);
    }

    public function getDirectorCollection()
    {
        $collection = $this->_directorCollectionFactory->create();
        return $collection->addFieldToSelect('*')->setPageSize(10);

    }

    public function getActorCollection()
    {
        $collection = $this->_actorCollectionFactory->create();
        return $collection->addFieldToSelect('*')->setPageSize(10);

    }

    public function getMovieCollection()
    {
        $collection = $this->_movieCollectionFactory->create();
        return $collection->addFieldToSelect('*')->setPageSize(10);
    }

}
