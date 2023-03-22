<?php

namespace FondOfOryx\Zed\CompanyDeleter\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Company\Business\CompanyFacadeInterface;

class CompanyDeleterToCompanyFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeBridge
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterToCompanyFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testDelete()
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('delete');

        $this->facadeMock->delete($this->companyTransferMock);
    }
}
