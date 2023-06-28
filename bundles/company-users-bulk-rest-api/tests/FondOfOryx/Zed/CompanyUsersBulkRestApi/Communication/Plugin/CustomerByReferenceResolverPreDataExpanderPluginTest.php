<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepository;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;
use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCustomerTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerByReferenceResolverPreDataExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeBridge
     */
    protected CustomerByReferenceResolverPreDataExpanderPlugin $plugin;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkRestApiRepository|MockObject $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkPreparationCollectionTransfer|MockObject $companyUsersBulkPreparationCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerCollectionTransfer|MockObject $customerCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkPreparationTransfer|MockObject $companyUsersBulkPreparationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersBulkItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestCompanyUsersBulkItemTransfer|MockObject $restCompanyUsersBulkItemTransfer;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersBulkItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestCompanyUsersBulkItemCustomerTransfer|MockObject $restCompanyUsersBulkItemCustomerTransfer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->repositoryMock = $this->getMockBuilder(CompanyUsersBulkRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUsersBulkPreparationCollectionTransferMock = $this->getMockBuilder(CompanyUsersBulkPreparationCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerCollectionTransferMock = $this->getMockBuilder(CustomerCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUsersBulkPreparationTransferMock = $this->getMockBuilder(CompanyUsersBulkPreparationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersBulkItemTransfer = $this->getMockBuilder(RestCompanyUsersBulkItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersBulkItemCustomerTransfer = $this->getMockBuilder(RestCompanyUsersBulkItemCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerByReferenceResolverPreDataExpanderPlugin();
        $this->plugin->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->repositoryMock
            ->expects(static::atLeastOnce())
            ->method('findCustomerByReferences')
            ->willReturn($this->customerCollectionTransferMock);

        $this->companyUsersBulkPreparationCollectionTransferMock
            ->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->companyUsersBulkPreparationTransferMock]);

        $this->companyUsersBulkPreparationTransferMock
            ->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->companyUsersBulkPreparationTransferMock
            ->expects(static::atLeastOnce())
            ->method('getItem')
            ->willReturn($this->restCompanyUsersBulkItemTransfer);

        $this->restCompanyUsersBulkItemTransfer
            ->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->restCompanyUsersBulkItemCustomerTransfer);

        $this->restCompanyUsersBulkItemCustomerTransfer
            ->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn('ref');

        $this->customerTransferMock
            ->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn('ref');

        $this->customerCollectionTransferMock
            ->expects(static::atLeastOnce())
            ->method('getCustomers')
            ->willReturn([$this->customerTransferMock]);

        $this->plugin->expand($this->companyUsersBulkPreparationCollectionTransferMock);
    }
}
