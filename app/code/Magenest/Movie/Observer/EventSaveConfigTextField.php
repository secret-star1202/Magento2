<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class EventSaveConfigTextField implements ObserverInterface
{
    private $request;
    private $configWriter;

    /**
     * ConfigChange constructor.
     * @param RequestInterface $request
     * @param WriterInterface $configWriter
     */
    public function __construct(
        RequestInterface $request,
        WriterInterface $configWriter
    ) {
        $this->request = $request;
        $this->configWriter = $configWriter;
    }

    public function execute(EventObserver $observer)
    {
        $content = $this->request->getParam('groups')['general']['fields']['display_text']['value'];
        if ($content == "Ping") {
            $content = "Pong";
        }
        $this->configWriter->save('movie/general/display_text', $content);
    }
}
