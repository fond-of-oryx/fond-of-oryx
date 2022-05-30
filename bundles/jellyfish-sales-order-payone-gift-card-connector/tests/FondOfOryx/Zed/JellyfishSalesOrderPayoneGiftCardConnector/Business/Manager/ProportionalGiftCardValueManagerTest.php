<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

class ProportionalGiftCardValueManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManager
     */
    protected $manager;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $proportionalValueConnectorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $proportionalGiftCardValueTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderTransferMock = $this
            ->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->proportionalValueConnectorFacadeMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->proportionalGiftCardValueTransferMock = $this
            ->getMockBuilder(ProportionalGiftCardValueTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->manager = new ProportionalGiftCardValueManager($this->proportionalValueConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testPersistProportionalGiftCardValuesFromExport(): void
    {
        $giftCardBalances = new ArrayObject();
        $giftCardBalances->append($this->proportionalGiftCardValueTransferMock);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCardBalances')
            ->willReturn($giftCardBalances);

        $this->proportionalValueConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('findOrCreateProportionalGiftCardValue')
            ->with($this->proportionalGiftCardValueTransferMock)
            ->willReturn($this->proportionalGiftCardValueTransferMock);

        $this->manager->persistProportionalGiftCardValuesFromExport($this->jellyfishOrderTransferMock);
    }
}
