<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Communication\Plugin\CompanyUser;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserArchive\Business\CompanyUserArchiveFacade;
use Generated\Shared\Transfer\CompanyUserArchiveTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

class CompanyUserArchiveCompanyUserPreDeletePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserArchive\Business\CompanyUserArchiveFacade|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserArchiveTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserArchiveTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserArchive\Communication\Plugin\CompanyUser\CompanyUserArchiveCompanyUserPreDeletePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyUserArchiveFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserArchiveTransferMock = $this->getMockBuilder(CompanyUserArchiveTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserArchiveCompanyUserPreDeletePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPreDelete(): void
    {
        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createCompanyUserArchive');

        $this->plugin->preDelete($this->companyUserTransferMock);
    }
}
