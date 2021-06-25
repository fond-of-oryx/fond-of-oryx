<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\JellyfishThirtyFiveUpCommunicationFactory;
use FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade\JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridge;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class JellyfishThirtyFiveUpOrderExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\Plugin\JellyfishThirtyFiveUpOrderExpanderPlugin
     */
    protected $plugin;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyOrderTransferMock;

    /**
     * @var \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\JellyfishThirtyFiveUpCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade\JellyfishThirtyFiveUpToThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->salesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderMock = $this->getMockBuilder(ThirtyFiveUpOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(JellyfishThirtyFiveUpCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderTransferMock = $this->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->factoryMock) extends JellyfishThirtyFiveUpOrderExpanderPlugin {
            /**
             * @var \FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\JellyfishThirtyFiveUpCommunicationFactory
             */
            protected $factory;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\JellyfishThirtyFiveUpCommunicationFactory $factory
             */
            public function __construct(JellyfishThirtyFiveUpCommunicationFactory $factory)
            {
                $this->factory = $factory;
            }

            /**
             * @return \Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory
             */
            protected function getFactory(): AbstractCommunicationFactory
            {
                return $this->factory;
            }
        };
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->salesOrderMock->expects($this->once())->method('getThirtyFiveUpOrder')->willReturn($this->thirtyFiveUpOrderMock);
        $this->factoryMock->expects($this->once())->method('getThirtyFiveUpFacade')->willReturn($this->facadeMock);
        $this->facadeMock->expects($this->once())->method('convertThirtyFiveUpOrderEntityToTransfer')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->jellyOrderTransferMock->expects($this->once())->method('setThirtyFiveUpOrder');

        $this->plugin->expand($this->jellyOrderTransferMock, $this->salesOrderMock);
    }

    /**
     * @return void
     */
    public function testExpandNo35UpOrder(): void
    {
        $this->salesOrderMock->expects($this->once())->method('getThirtyFiveUpOrder');
        $this->factoryMock->expects($this->never())->method('getThirtyFiveUpFacade');
        $this->facadeMock->expects($this->never())->method('convertThirtyFiveUpOrderEntityToTransfer');
        $this->jellyOrderTransferMock->expects($this->never())->method('setThirtyFiveUpOrder');

        $this->plugin->expand($this->jellyOrderTransferMock, $this->salesOrderMock);
    }
}
