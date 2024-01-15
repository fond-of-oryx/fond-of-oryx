<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfImpala\Zed\CompanyUserReference\Business\CompanyUserReferenceFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfImpala\Zed\CompanyUserReference\Business\CompanyUserReferenceFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyUserReferenceFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyUserReferenceById(): void
    {
        $companyUserReference = 'FOO--CU-1';

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getCompanyByCompanyUserReference')
            ->with($companyUserReference)
            ->willReturn($this->companyTransferMock);

        static::assertEquals(
            $this->companyTransferMock,
            $this->bridge->getCompanyByCompanyUserReference($companyUserReference),
        );
    }
}
