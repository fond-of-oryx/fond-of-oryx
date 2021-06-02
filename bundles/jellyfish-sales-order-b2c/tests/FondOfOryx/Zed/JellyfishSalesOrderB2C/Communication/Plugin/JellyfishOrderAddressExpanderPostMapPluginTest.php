<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderB2C\Communication\Plugin;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class JellyfishOrderAddressExpanderPostMapPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderB2C\Communication\Plugin\JellyfishOrderAddressExpanderPostMapPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    protected $jellyAddressTransfer;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderAddress|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderAddressMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyAddressTransfer = new JellyfishOrderAddressTransfer();

        $this->salesOrderAddressMock = $this->getMockBuilder(SpySalesOrderAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new JellyfishOrderAddressExpanderPostMapPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->salesOrderAddressMock->expects($this->once())->method('getFirstName')->willReturn('Hans');
        $this->salesOrderAddressMock->expects($this->once())->method('getLastName')->willReturn('Wurst');

        $this->jellyAddressTransfer->setName1('Hans');
        $this->jellyAddressTransfer->setName2('Wurst');

        $this->jellyAddressTransfer = $this->plugin->expand($this->jellyAddressTransfer, $this->salesOrderAddressMock);

        $this->assertInstanceOf(JellyfishOrderAddressTransfer::class, $this->jellyAddressTransfer);
        $this->assertNull($this->jellyAddressTransfer->getName1());
        $this->assertNull($this->jellyAddressTransfer->getName2());
    }
}
