<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacade;
use FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpBusinessFactory getFactory()
 */
class ThirtyFiveUpOrderExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales\ThirtyFiveUpOrderExpanderPlugin
     */
    protected $plugin;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\SpySalesOrderEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderEntityTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(ThirtyFiveUpFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderEntityTransferMock = $this->getMockBuilder(SpySalesOrderEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderTransferMock = $this->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->facadeMock) extends ThirtyFiveUpOrderExpanderPlugin {
            /**
             * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface
             */
            public $facade;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface $thirtyFiveUpFacade
             */
            public function __construct(ThirtyFiveUpFacadeInterface $thirtyFiveUpFacade)
            {
                $this->facade = $thirtyFiveUpFacade;
            }

            /**
             * @return \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface|\Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->facade;
            }
        };
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects($this->once())->method('createThirtyFiveUpOrderFromQuote')->willReturn($this->quoteTransferMock);
        $this->quoteTransferMock->expects($this->once())->method('getThirtyFiveUpOrder')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->thirtyFiveUpOrderTransferMock->expects($this->once())->method('getId')->willReturn(1);
        $this->spySalesOrderEntityTransferMock->expects($this->once())->method('setFkFooThirtyFiveUpOrder');
        $this->plugin->expand($this->spySalesOrderEntityTransferMock, $this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandNo35UpOrder(): void
    {
        $this->facadeMock->expects($this->once())->method('createThirtyFiveUpOrderFromQuote')->willReturn($this->quoteTransferMock);
        $this->quoteTransferMock->expects($this->once())->method('getThirtyFiveUpOrder');
        $this->spySalesOrderEntityTransferMock->expects($this->never())->method('setFkFooThirtyFiveUpOrder');
        $this->plugin->expand($this->spySalesOrderEntityTransferMock, $this->quoteTransferMock);
    }
}
