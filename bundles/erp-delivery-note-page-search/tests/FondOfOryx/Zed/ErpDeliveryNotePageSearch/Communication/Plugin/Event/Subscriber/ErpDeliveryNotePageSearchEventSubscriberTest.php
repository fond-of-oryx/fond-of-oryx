<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Event\Subscriber;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;

class ErpDeliveryNotePageSearchEventSubscriberTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Event\Subscriber\ErpDeliveryNotePageSearchEventSubscriber
     */
    protected $erpDeliveryNotePageSearchEventSubscriber;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    protected $eventCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ErpDeliveryNotePageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventCollectionMock = $this->getMockBuilder(EventCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchEventSubscriber = new ErpDeliveryNotePageSearchEventSubscriber();
        $this->erpDeliveryNotePageSearchEventSubscriber->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents()
    {
        $this->assertInstanceOf(
            EventCollectionInterface::class,
            $this->erpDeliveryNotePageSearchEventSubscriber->getSubscribedEvents($this->eventCollectionMock),
        );
    }
}
