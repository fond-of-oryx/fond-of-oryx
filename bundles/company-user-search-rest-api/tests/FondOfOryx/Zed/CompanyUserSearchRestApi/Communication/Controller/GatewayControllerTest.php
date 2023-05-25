<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Business\CompanyUserSearchRestApiFacade;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CompanyUserSearchRestApi\Business\CompanyUserSearchRestApiFacade&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserSearchRestApiFacade|MockObject $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\CompanyUserListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyUserListTransfer $companyUserListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\Communication\Controller\GatewayController
     */
    protected GatewayController $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyUserSearchRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
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
            ->method('findCompanyUsers')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->companyUserListTransferMock);

        static::assertEquals(
            $this->companyUserListTransferMock,
            $this->gatewayController->searchCompanyUserAction($this->companyUserListTransferMock),
        );
    }
}
