<?php

namespace FondOfOryx\Zed\CompanUserAchive\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserArchive\Business\CompanyUserArchiveBusinessFactory;
use FondOfOryx\Zed\CompanyUserArchive\Business\CompanyUserArchiveFacade;
use FondOfOryx\Zed\CompanyUserArchive\Business\Writer\CompanyUserArchiveWriterInterface;
use Generated\Shared\Transfer\CompanyUserArchiveTransfer;

class CompanyUserArchiveFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserArchive\Business\CompanyUserArchiveBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserArchive\Business\Writer\CompanyUserArchiveWriterInterface
     */
    protected $companyUserArchiveWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserArchiveTransfer
     */
    protected $companyUserArchiveTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserArchive\Business\CompanyUserArchiveFacadeInterface
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this
            ->getMockBuilder(CompanyUserArchiveBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserArchiveWriterMock = $this
            ->getMockBuilder(CompanyUserArchiveWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserArchiveTransferMock = $this->getMockBuilder(CompanyUserArchiveTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyUserArchiveFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserArchive(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserArchiveWriter')
            ->willReturn($this->companyUserArchiveWriterMock);

        $this->companyUserArchiveWriterMock->expects(static::atLeastOnce())
            ->method('createCompanyUserArchive')
            ->with($this->companyUserArchiveTransferMock)
            ->willReturn($this->companyUserArchiveTransferMock);

        static::assertInstanceOf(
            CompanyUserArchiveTransfer::class,
            $this->facade->createCompanyUserArchive($this->companyUserArchiveTransferMock),
        );
    }
}
