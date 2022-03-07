<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCustomerAddress\Communication\Plugin\JellyfishSalesOrderExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class CustomerAddressJellyfishOrderAddressExpanderPostMapPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderAddressTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderAddress|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderAddressMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCustomerAddress\Communication\Plugin\JellyfishSalesOrderExtension\CustomerAddressJellyfishOrderAddressExpanderPostMapPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderAddressTransferMock = $this->getMockBuilder(JellyfishOrderAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderAddressMock = $this->getMockBuilder(SpySalesOrderAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerAddressJellyfishOrderAddressExpanderPostMapPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $fkResourceCustomerAddress = 1;

        $this->spySalesOrderAddressMock->expects(static::atLeastOnce())
            ->method('getFkResourceCustomerAddress')
            ->willReturn($fkResourceCustomerAddress);

        $this->jellyfishOrderAddressTransferMock->expects(static::atLeastOnce())
            ->method('setId')
            ->with($fkResourceCustomerAddress)
            ->willReturn($this->jellyfishOrderAddressTransferMock);

        static::assertEquals(
            $this->jellyfishOrderAddressTransferMock,
            $this->plugin->expand(
                $this->jellyfishOrderAddressTransferMock,
                $this->spySalesOrderAddressMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutFkResourceCustomerAddress(): void
    {
        $fkResourceCustomerAddress = null;

        $this->spySalesOrderAddressMock->expects(static::atLeastOnce())
            ->method('getFkResourceCustomerAddress')
            ->willReturn($fkResourceCustomerAddress);

        $this->jellyfishOrderAddressTransferMock->expects(static::never())
            ->method('setId');

        static::assertEquals(
            $this->jellyfishOrderAddressTransferMock,
            $this->plugin->expand(
                $this->jellyfishOrderAddressTransferMock,
                $this->spySalesOrderAddressMock,
            ),
        );
    }
}
