<?php

namespace Magenest\Movie\Block;

use Magenest\Movie\Model\DirectorFactory;
use Magenest\Movie\Model\ActorFactory;
use Magenest\Movie\Model\MovieFactory;

use Magento\Framework\View\Element\Template;

class Display extends Template
{
    protected $_directorFactory;
    protected $_actorFactory;
    protected $_movieFactory;

    public function __construct(Template\Context $context, DirectorFactory $directorFactory, ActorFactory $actorFactory, MovieFactory $movieFactory)
    {
        $this->_directorFactory = $directorFactory;
        $this->_actorFactory = $actorFactory;
        $this->_movieFactory = $movieFactory;
        parent::__construct($context);
    }

    public function getDirectorCollection()
    {
        $director = $this->_directorFactory->create();
        return $director->getCollection()->addFieldToSelect('*')->setPageSize(10)->load();
    }

    public function getActorCollection()
    {
        $actor = $this->_actorFactory->create();
        return $actor->getCollection()->addFieldToSelect('*')->setPageSize(10)->load();
    }

    public function getMovieCollection()
    {
        $actor = $this->_movieFactory->create();
        return $actor->getCollection()->addFieldToSelect('*')->setPageSize(10)->load();
    }
}
