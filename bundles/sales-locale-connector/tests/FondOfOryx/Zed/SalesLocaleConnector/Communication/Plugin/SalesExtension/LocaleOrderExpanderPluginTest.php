<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Communication\Plugin\SalesExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorFacade;
use Generated\Shared\Transfer\OrderTransfer;

class LocaleOrderExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorFacade
     */
    protected $salesLocaleConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\OrderTransfer
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfSpryker\Zed\SalesLocaleConnector\Communication\Plugin\SalesExtension\LocaleOrderExpanderPlugin
     */
    protected $localeOrderExpanderPlugin;

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

        $this->localeOrderExpanderPlugin = new LocaleOrderExpanderPlugin();
        $this->localeOrderExpanderPlugin->setFacade($this->salesLocaleConnectorFacadeMock);
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
            $this->localeOrderExpanderPlugin->hydrate($this->orderTransferMock)
        );
    }
}
