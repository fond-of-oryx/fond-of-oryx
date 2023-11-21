<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Communication\ErpOrderCommunicationFactory;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCustomerFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class PurchaserErpOrderPreSavePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected MockObject|CustomerTransfer $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCustomerFacadeInterface
     */
    protected MockObject|ErpOrderToCustomerFacadeInterface $customerFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ErpOrderTransfer
     */
    protected MockObject|ErpOrderTransfer $erpOrderTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrder\Communication\ErpOrderCommunicationFactory
     */
    protected MockObject|ErpOrderCommunicationFactory $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave\PurchaserErpOrderPreSavePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->customerTransferMock = $this
            ->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerFacadeMock = $this
            ->getMockBuilder(ErpOrderToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTransferMock = $this
            ->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this
            ->getMockBuilder(ErpOrderCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new PurchaserErpOrderPreSavePlugin();
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testPreSave(): void
    {
        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('getPurchaserEmail')
            ->willReturn('john.doe@mail.com');

        $this->factoryMock->expects($this->atLeastOnce())
            ->method('getCustomerFacade')
            ->willReturn($this->customerFacadeMock);

        $this->customerFacadeMock->expects($this->atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(1);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getFirstName')
            ->willReturn('John');

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getLastName')
            ->willReturn('Doe');

        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('setPurchaserFirstName')
            ->willReturnSelf();

        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('setPurchaserLastName')
            ->willReturnSelf();

        $erpOrderTransferMock = $this->plugin->preSave($this->erpOrderTransferMock);

        $this->assertEquals($this->erpOrderTransferMock, $erpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testPreSaveWithNoPurchaserEmail(): void
    {
        $this->erpOrderTransferMock->expects($this->once())
            ->method('getPurchaserEmail')
            ->willReturn(null);

        $this->assertEquals(
            $this->erpOrderTransferMock,
            $this->plugin->preSave($this->erpOrderTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testPreSaveWithNoCustomerId(): void
    {
        $this->erpOrderTransferMock->expects($this->atLeastOnce())
            ->method('getPurchaserEmail')
            ->willReturn('john.doe@mail.com');

        $this->factoryMock->expects($this->atLeastOnce())
            ->method('getCustomerFacade')
            ->willReturn($this->customerFacadeMock);

        $this->customerFacadeMock->expects($this->atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(null);

        $this->assertEquals(
            $this->erpOrderTransferMock,
            $this->plugin->preSave($this->erpOrderTransferMock),
        );
    }
}
