<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanySearchRestApi\Business\Reader\CompanyReaderInterface;
use Generated\Shared\Transfer\CompanyListTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanySearchRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\Business\CompanySearchRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanySearchRestApiBusinessFactory|MockObject $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\Business\Reader\CompanyReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyReaderInterface|MockObject $companyReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyListTransfer
     */
    protected MockObject|CompanyListTransfer $companyListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\Business\CompanySearchRestApiFacade
     */
    protected CompanySearchRestApiFacade $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanySearchRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyReaderMock = $this->getMockBuilder(CompanyReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanySearchRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindCompanies(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyReader')
            ->willReturn($this->companyReaderMock);

        $this->companyReaderMock->expects(static::atLeastOnce())
            ->method('findByCompanyList')
            ->with($this->companyListTransferMock)
            ->willReturn($this->companyListTransferMock);

        static::assertEquals(
            $this->companyListTransferMock,
            $this->facade->findCompanies($this->companyListTransferMock),
        );
    }
}
