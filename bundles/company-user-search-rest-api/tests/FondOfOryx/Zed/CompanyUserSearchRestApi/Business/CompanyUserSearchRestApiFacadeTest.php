<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader\CompanyUserReaderInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserSearchRestApiFacadeTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CompanyUserSearchRestApi\Business\CompanyUserSearchRestApiBusinessFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserSearchRestApiBusinessFactory|MockObject $factoryMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader\CompanyUserReaderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserReaderInterface|MockObject $companyUserReaderMock;

    /**
     * @var (\Generated\Shared\Transfer\CompanyUserListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyUserListTransfer $companyUserListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\Business\CompanyUserSearchRestApiFacade
     */
    protected CompanyUserSearchRestApiFacade $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyUserSearchRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReaderMock = $this->getMockBuilder(CompanyUserReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyUserSearchRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindCompanyUsers(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserReader')
            ->willReturn($this->companyUserReaderMock);

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('findByCompanyUserList')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->companyUserListTransferMock);

        static::assertEquals(
            $this->companyUserListTransferMock,
            $this->facade->findCompanyUsers($this->companyUserListTransferMock),
        );
    }
}
