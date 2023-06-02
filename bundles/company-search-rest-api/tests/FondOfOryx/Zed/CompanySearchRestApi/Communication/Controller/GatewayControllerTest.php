<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanySearchRestApi\Business\CompanySearchRestApiFacade;
use Generated\Shared\Transfer\CompanyListTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CompanySearchRestApi\Business\CompanySearchRestApiFacade&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanySearchRestApiFacade|MockObject $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\CompanyListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyListTransfer $companyListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\Communication\Controller\GatewayController
     */
    protected GatewayController $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanySearchRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected AbstractFacade $abstractFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $abstractFacade
             */
            public function __construct(AbstractFacade $abstractFacade)
            {
                $this->abstractFacade = $abstractFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->abstractFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testSearchCompaniesAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findCompanies')
            ->with($this->companyListTransferMock)
            ->willReturn($this->companyListTransferMock);

        static::assertEquals(
            $this->companyListTransferMock,
            $this->gatewayController->searchCompaniesAction($this->companyListTransferMock),
        );
    }
}
