<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CartSearchRestApi\Business\CartSearchRestApiFacade;
use Generated\Shared\Transfer\QuoteListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Business\CartSearchRestApiFacade|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $quoteListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CartSearchRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $cartSearchRestApiFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->cartSearchRestApiFacade = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->cartSearchRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testFindQuotesAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findQuotes')
            ->with($this->quoteListTransferMock)
            ->willReturn($this->quoteListTransferMock);

        static::assertEquals(
            $this->quoteListTransferMock,
            $this->gatewayController->findQuotesAction($this->quoteListTransferMock),
        );
    }
}
