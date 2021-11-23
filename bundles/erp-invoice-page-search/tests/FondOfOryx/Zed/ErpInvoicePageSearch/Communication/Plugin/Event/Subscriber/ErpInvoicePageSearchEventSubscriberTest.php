<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event\Subscriber;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;

class ErpInvoicePageSearchEventSubscriberTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event\Subscriber\ErpInvoicePageSearchEventSubscriber
     */
    protected $erpInvoicePageSearchEventSubscriber;

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

        $this->configMock = $this->getMockBuilder(ErpInvoicePageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventCollectionMock = $this->getMockBuilder(EventCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchEventSubscriber = new ErpInvoicePageSearchEventSubscriber();
        $this->erpInvoicePageSearchEventSubscriber->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents()
    {
        $this->assertInstanceOf(
            EventCollectionInterface::class,
            $this->erpInvoicePageSearchEventSubscriber->getSubscribedEvents($this->eventCollectionMock),
        );
    }
}
