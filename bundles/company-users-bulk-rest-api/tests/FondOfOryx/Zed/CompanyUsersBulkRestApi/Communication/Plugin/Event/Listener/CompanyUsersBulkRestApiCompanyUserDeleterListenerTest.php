<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin\Event\Listener;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiConstants;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiFacade;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUsersBulkRestApiCompanyUserDeleterListenerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin\Event\Listener\CompanyUsersBulkRestApiCompanyUserDeleterListener
     */
    protected CompanyUsersBulkRestApiCompanyUserDeleterListener $listener;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkRestApiFacade|MockObject $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestCompanyUsersBulkItemCollectionTransfer|MockObject $restCompanyUsersBulkItemCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(CompanyUsersBulkRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersBulkItemCollectionTransferMock = $this->getMockBuilder(RestCompanyUsersBulkItemCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->listener = new CompanyUsersBulkRestApiCompanyUserDeleterListener();
        $this->listener->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testHandle(): void
    {
        $this->facadeMock
            ->expects(static::atLeastOnce())
            ->method('deleteCompanyUserBulkMode')
            ->with($this->restCompanyUsersBulkItemCollectionTransferMock);

        $this->listener->handle($this->restCompanyUsersBulkItemCollectionTransferMock, CompanyUsersBulkRestApiConstants::BULK_UNASSIGN);
    }
}
