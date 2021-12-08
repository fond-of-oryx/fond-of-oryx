<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Company\Business\CompanyFacadeInterface;

class CompanyProductListConnectorGuiToCompanyFacadeBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Company\Business\CompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyFacadeBridge
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new CompanyProductListConnectorGuiToCompanyFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyById(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getCompanyById')
            ->with($this->companyTransferMock)
            ->willReturn($this->companyTransferMock);

        static::assertEquals(
            $this->companyTransferMock,
            $this->facadeBridge->getCompanyById($this->companyTransferMock),
        );
    }
}
