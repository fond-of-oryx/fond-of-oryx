<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\RepresentativeCompanyUserRestApiFacade;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\RepresentativeCompanyUserRestApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRepresentativeCompanyUserResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRepresentativeCompanyUserRequestTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserResponseTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserRequestTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected AbstractFacade $representativeCompanyUserRestApiFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->representativeCompanyUserRestApiFacade = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->representativeCompanyUserRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testAddRepresentationAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('addRepresentation')
            ->with($this->restRepresentativeCompanyUserRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserResponseTransferMock);

        static::assertEquals(
            $this->restRepresentativeCompanyUserResponseTransferMock,
            $this->gatewayController->addRepresentationAction(
                $this->restRepresentativeCompanyUserRequestTransferMock,
            ),
        );
    }
}
