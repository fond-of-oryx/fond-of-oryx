<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\Communication\Plugin\CompanyUsersBulkRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\Persistence\CompanyUsersBulkRestApiDebtorConnectorRepository;
use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyResolverPreDataExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\Communication\Plugin\CompanyUsersBulkRestApi\CompanyDebtorNumberResolverPreDataExpanderPlugin
     */
    protected CompanyDebtorNumberResolverPreDataExpanderPlugin $plugin;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\Persistence\CompanyUsersBulkRestApiDebtorConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkRestApiDebtorConnectorRepository|MockObject $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkPreparationCollectionTransfer|MockObject $companyUsersBulkPreparationCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyCollectionTransfer|MockObject $companyCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyTransfer|MockObject $companyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkPreparationTransfer|MockObject $companyUsersBulkPreparationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersBulkItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestCompanyUsersBulkItemTransfer|MockObject $restCompanyUsersBulkItemTransfer;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestCompanyUsersBulkItemCompanyTransfer|MockObject $restCompanyUsersBulkItemCompanyTransfer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->repositoryMock = $this->getMockBuilder(CompanyUsersBulkRestApiDebtorConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUsersBulkPreparationCollectionTransferMock = $this->getMockBuilder(CompanyUsersBulkPreparationCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyCollectionTransferMock = $this->getMockBuilder(CompanyCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUsersBulkPreparationTransferMock = $this->getMockBuilder(CompanyUsersBulkPreparationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersBulkItemTransfer = $this->getMockBuilder(RestCompanyUsersBulkItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersBulkItemCompanyTransfer = $this->getMockBuilder(RestCompanyUsersBulkItemCompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyDebtorNumberResolverPreDataExpanderPlugin();
        $this->plugin->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->repositoryMock
            ->expects(static::atLeastOnce())
            ->method('findCompaniesByDebtorNumbers')
            ->willReturn($this->companyCollectionTransferMock);

        $this->companyUsersBulkPreparationCollectionTransferMock
            ->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->companyUsersBulkPreparationTransferMock]);

        $this->companyUsersBulkPreparationTransferMock
            ->expects(static::atLeastOnce())
            ->method('getCompany')
            ->willReturn(null);

        $this->companyUsersBulkPreparationTransferMock
            ->expects(static::atLeastOnce())
            ->method('getItem')
            ->willReturn($this->restCompanyUsersBulkItemTransfer);

        $this->restCompanyUsersBulkItemTransfer
            ->expects(static::atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->restCompanyUsersBulkItemCompanyTransfer);

        $this->restCompanyUsersBulkItemCompanyTransfer
            ->expects(static::atLeastOnce())
            ->method('getDebtorNumber')
            ->willReturn('dn');

        $this->companyTransferMock
            ->expects(static::atLeastOnce())
            ->method('getDebtorNumber')
            ->willReturn('dn');

        $this->companyCollectionTransferMock
            ->expects(static::atLeastOnce())
            ->method('getCompanies')
            ->willReturn([$this->companyTransferMock]);

        $this->plugin->expand($this->companyUsersBulkPreparationCollectionTransferMock);
    }
}
