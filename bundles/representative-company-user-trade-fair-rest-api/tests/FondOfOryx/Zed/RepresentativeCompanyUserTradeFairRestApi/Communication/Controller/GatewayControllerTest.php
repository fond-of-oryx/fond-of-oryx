<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\RepresentativeCompanyUserTradeFairRestApiFacade;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer
     */
    protected RestRepresentativeCompanyUserTradeFairRequestTransfer|MockObject $restRepresentativeCompanyUserTradeFairRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairResponseTransfer $restRepresentativeCompanyUserTradeFairResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\RepresentativeCompanyUserTradeFairRestApiFacade
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiFacade $facadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Communication\Controller\GatewayController
     */
    protected GatewayController $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected AbstractFacade $representativeCompanyUserTradeFairRestApiFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->representativeCompanyUserTradeFairRestApiFacade = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->representativeCompanyUserTradeFairRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testAddTradeFairRepresentationAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('addTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $responseTransfer = $this->gatewayController->addTradeFairRepresentationAction(
            $this->restRepresentativeCompanyUserTradeFairRequestTransferMock,
        );
        static::assertEquals(
            $this->restRepresentativeCompanyUserTradeFairResponseTransferMock,
            $responseTransfer,
        );
    }

    /**
     * @return void
     */
    public function testGetTradeFairRepresentationAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $responseTransfer = $this->gatewayController->getTradeFairRepresentationAction(
            $this->restRepresentativeCompanyUserTradeFairRequestTransferMock,
        );
        static::assertEquals(
            $this->restRepresentativeCompanyUserTradeFairResponseTransferMock,
            $responseTransfer,
        );
    }

    /**
     * @return void
     */
    public function testPatchTradeFairRepresentationAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('updateTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $responseTransfer = $this->gatewayController->patchTradeFairRepresentationAction(
            $this->restRepresentativeCompanyUserTradeFairRequestTransferMock,
        );
        static::assertEquals(
            $this->restRepresentativeCompanyUserTradeFairResponseTransferMock,
            $responseTransfer,
        );
    }

    /**
     * @return void
     */
    public function testDeleteTradeFairRepresentationAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('deleteTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $responseTransfer = $this->gatewayController->deleteTradeFairRepresentationAction(
            $this->restRepresentativeCompanyUserTradeFairRequestTransferMock,
        );
        static::assertEquals(
            $this->restRepresentativeCompanyUserTradeFairResponseTransferMock,
            $responseTransfer,
        );
    }
}
