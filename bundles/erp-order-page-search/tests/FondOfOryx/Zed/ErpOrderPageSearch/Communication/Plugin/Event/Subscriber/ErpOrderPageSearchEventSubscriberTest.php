<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\Subscriber;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;

class ErpOrderPageSearchEventSubscriberTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\Subscriber\ErpOrderPageSearchEventSubscriber
     */
    protected $erpOrderPageSearchEventSubscriber;

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

        $this->configMock = $this->getMockBuilder(ErpOrderPageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventCollectionMock = $this->getMockBuilder(EventCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchEventSubscriber = new ErpOrderPageSearchEventSubscriber();
        $this->erpOrderPageSearchEventSubscriber->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents()
    {
        $this->assertInstanceOf(
            EventCollectionInterface::class,
            $this->erpOrderPageSearchEventSubscriber->getSubscribedEvents($this->eventCollectionMock),
        );
    }
}
