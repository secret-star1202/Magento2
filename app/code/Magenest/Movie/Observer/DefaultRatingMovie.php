<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;

class DefaultRatingMovie implements ObserverInterface
{
    private $_modelMovieFactory;

    public function __construct(
        \Magenest\Movie\Model\MovieFactory $modelMovieFactory
    ) {
        $this->_modelMovieFactory = $modelMovieFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $idMovie = $observer->getId();
        $movieModel = $this->_modelMovieFactory->create()->load($idMovie);
        $movieModel->setRating(0);
        $movieModel->save();
    }
}
