<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\CalculationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionFacade;
use Generated\Shared\Transfer\CalculableObjectTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GiftCardRestrictionCalculationPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CalculableObjectTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $calculableObjectTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\CalculationExtension\GiftCardRestrictionCalculationPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->calculableObjectTransferMock = $this->getMockBuilder(CalculableObjectTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(GiftCardRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->facadeMock) extends GiftCardRestrictionCalculationPlugin {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $giftCardRestrictionFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $giftCardRestrictionFacade
             */
            public function __construct(AbstractFacade $giftCardRestrictionFacade)
            {
                $this->giftCardRestrictionFacade = $giftCardRestrictionFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            public function getFacade(): AbstractFacade
            {
                return $this->giftCardRestrictionFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('recalculate')
            ->with($this->calculableObjectTransferMock);

        $this->plugin->recalculate($this->calculableObjectTransferMock);
    }
}
