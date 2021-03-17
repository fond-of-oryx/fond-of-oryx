<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacade;
use FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpBusinessFactory getFactory()
 */
class PatchThirtyFiveUpOrderAfterSalesOrderWasSavedOrderPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales\PatchThirtyFiveUpOrderAfterSalesOrderWasSavedOrderPostSavePlugin
     */
    protected $plugin;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\SaveOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $saveOrderTransferMock;

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

        $this->saveOrderTransferMock = $this->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderTransferMock = $this->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->facadeMock) extends PatchThirtyFiveUpOrderAfterSalesOrderWasSavedOrderPostSavePlugin {
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
    public function testExecute(): void
    {
        $this->facadeMock->expects($this->once())->method('addAndSaveOrderDataFromSaveOrderTransfer');
        $this->quoteTransferMock->expects($this->once())->method('getThirtyFiveUpOrder')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $return = $this->plugin->execute($this->saveOrderTransferMock, $this->quoteTransferMock);

        $this->assertInstanceOf(SaveOrderTransfer::class, $return);
    }

    /**
     * @return void
     */
    public function testExecuteNo35UpOrder(): void
    {
        $this->facadeMock->expects($this->never())->method('addAndSaveOrderDataFromSaveOrderTransfer');
        $this->quoteTransferMock->expects($this->once())->method('getThirtyFiveUpOrder');
        $return = $this->plugin->execute($this->saveOrderTransferMock, $this->quoteTransferMock);

        $this->assertInstanceOf(SaveOrderTransfer::class, $return);
    }
}
