<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magenest\Movie\Model\ResourceModel\MovieFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Save extends Action
{
    private $resultRedirect;
    private $movieFactory;

    public function __construct(
        Action\Context $context,
        MovieFactory $movieFactory,
        RedirectFactory $redirectFactory
    ) {
        parent::__construct($context);
        $this->movieFactory = $movieFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data["movie_id"]) ? $data["movie_id"] : null;

        $newData = [
            'name' => $data["name"],
            'rating' => $data["rating"],
            'description' => $data["description"],
        ];

        if (!isset($data["name"])) {
            $this->_redirect('movie/movie/index');
        }

        $newData = [
            'name' => $data['name'],
            'rating' => $data['rating'],
            'description' => $data['description'],
            'director_id' => $data['director_id'],
        ];

        $movie = $this->movieFactory->create();
        if ($id) {
            $movie->load($id);
        }

        try {
            $movie->addData($newData);
            $this->_eventManager->dispatch('save_movie', ['movie' => $movie]);
            $movie->save();
            return $this->resultRedirect->create()->setPath('movie/movie/index');
        } catch (\Exception $e) {
            return $this->resultRedirect->create()->setPath('movie/movie/add');
        }
    }
}
