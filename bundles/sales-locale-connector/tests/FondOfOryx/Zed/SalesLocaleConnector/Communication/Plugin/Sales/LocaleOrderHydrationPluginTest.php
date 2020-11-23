<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Communication\Plugin\Sales;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorFacade;
use Generated\Shared\Transfer\OrderTransfer;

class LocaleOrderHydrationPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorFacade
     */
    protected $salesLocaleConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\OrderTransfer
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\SalesLocaleConnector\Communication\Plugin\Sales\LocaleOrderHydrationPlugin
     */
    protected $localeOrderHydrationPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->salesLocaleConnectorFacadeMock = $this->getMockBuilder(SalesLocaleConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeOrderHydrationPlugin = new LocaleOrderHydrationPlugin();
        $this->localeOrderHydrationPlugin->setFacade($this->salesLocaleConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testHydrate(): void
    {
        $this->salesLocaleConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('expandOrder')
            ->with($this->orderTransferMock)
            ->willReturn($this->orderTransferMock);

        $this->assertEquals(
            $this->orderTransferMock,
            $this->localeOrderHydrationPlugin->hydrate($this->orderTransferMock)
        );
    }
}
