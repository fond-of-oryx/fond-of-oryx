<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyProductListApiToCompanyProductListConnectorFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompnyProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $companyProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $companyProductListConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface
     */
    protected $dependencyFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyProductListRelationTransferMock = $this
            ->getMockBuilder(CompanyProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListConnectorFacadeMock = $this
            ->getMockBuilder(CompanyProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyFacade = new CompanyProductListApiToCompanyProductListConnectorFacadeBridge(
            $this->companyProductListConnectorFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistCompanyProductListRelation(): void
    {
        $this->dependencyFacade->persistCompanyProductListRelation($this->companyProductListRelationTransferMock);
    }
}
