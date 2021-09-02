<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacade;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class AddAvailabilityDataToQuoteItemQuoteChangeObserverPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Communication\Plugin\AddAvailabilityDataToQuoteItemQuoteChangeObserverPlugin
     */
    protected $toTest;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->facadeMock = $this->getMockBuilder(AvailabilityCartDataExtenderFacade::class)->disableOriginalConstructor()->getMock();

        $this->toTest = new class ($this->facadeMock) extends AddAvailabilityDataToQuoteItemQuoteChangeObserverPlugin {
            /**
             * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface
             */
            protected $facadeMock;

            /**
             * @param \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface $facadeMock
             */
            public function __construct(AvailabilityCartDataExtenderFacadeInterface $facadeMock)
            {
                $this->facadeMock = $facadeMock;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->facadeMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testCheckChanges(): void
    {
        $this->facadeMock->expects(static::once())->method('addAvailabilityInformationOnQuoteItems');

        $this->toTest->checkChanges($this->quoteTransferMock, $this->quoteTransferMock);
    }
}
