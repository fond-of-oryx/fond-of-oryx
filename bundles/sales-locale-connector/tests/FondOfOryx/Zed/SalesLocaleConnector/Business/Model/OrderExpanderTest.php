<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SalesLocaleConnector\Dependency\Facade\SalesLocaleConnectorToLocaleFacadeInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class OrderExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\SalesLocaleConnector\Dependency\Facade\SalesLocaleConnectorToLocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\OrderTransfer
     */
    protected $orderTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfSpryker\Zed\SalesLocaleConnector\Business\Model\OrderExpanderInterface
     */
    protected $orderExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->localeFacadeMock = $this->getMockBuilder(SalesLocaleConnectorToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderExpander = new OrderExpander($this->localeFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $fkLocale = 1;

        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getFkLocale')
            ->willReturn($fkLocale);

        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->localeFacadeMock->expects($this->atLeastOnce())
            ->method('getLocaleById')
            ->with($fkLocale)
            ->willReturn($this->localeTransferMock);

        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('setLocale')
            ->with($this->localeTransferMock)
            ->willReturn($this->orderTransferMock);

        $orderTransfer = $this->orderExpander->expand($this->orderTransferMock);

        $this->assertEquals($this->orderTransferMock, $orderTransfer);
    }

    /**
     * @return void
     */
    public function testExpandWithoutExistingFkLocale(): void
    {
        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getFkLocale')
            ->willReturn(null);

        $this->orderTransferMock->expects($this->never())
            ->method('getLocale');

        $this->localeFacadeMock->expects($this->never())
            ->method('getLocaleById');

        $this->orderTransferMock->expects($this->never())
            ->method('setLocale');

        $orderTransfer = $this->orderExpander->expand($this->orderTransferMock);

        $this->assertEquals($this->orderTransferMock, $orderTransfer);
    }

    /**
     * @return void
     */
    public function testExpandWithAlreadyExistingLocale(): void
    {
        $fkLocale = 1;

        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getFkLocale')
            ->willReturn($fkLocale);

        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeFacadeMock->expects($this->never())
            ->method('getLocaleById');

        $this->orderTransferMock->expects($this->never())
            ->method('setLocale');

        $orderTransfer = $this->orderExpander->expand($this->orderTransferMock);

        $this->assertEquals($this->orderTransferMock, $orderTransfer);
    }
}
