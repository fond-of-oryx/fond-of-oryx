<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Communication\Plugin\Oms\Command;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishGiftCard\Business\JellyfishGiftCardFacade;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class ExportGiftCardCommandPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\JellyfishGiftCardFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderItemEntityMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject
     */
    protected $readOnlyArrayObjectMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Communication\Plugin\Oms\Command\ExportGiftCardCommandPlugin
     */
    protected $plugin;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(JellyfishGiftCardFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemEntityMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->readOnlyArrayObjectMock = $this->getMockBuilder(ReadOnlyArrayObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->facadeMock) extends ExportGiftCardCommandPlugin {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $jellyfishGiftCardFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $jellyfishGiftCardFacade
             */
            public function __construct(AbstractFacade $jellyfishGiftCardFacade)
            {
                $this->jellyfishGiftCardFacade = $jellyfishGiftCardFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->jellyfishGiftCardFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testRun(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('exportGiftCard')
            ->with($this->salesOrderItemEntityMock, $this->readOnlyArrayObjectMock);

        static::assertEquals([], $this->plugin->run($this->salesOrderItemEntityMock, $this->readOnlyArrayObjectMock));
    }
}
