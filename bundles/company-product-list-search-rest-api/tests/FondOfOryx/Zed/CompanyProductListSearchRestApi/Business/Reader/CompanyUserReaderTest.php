<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence\CompanyProductListSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|IdCustomerFilterInterface $idCustomerFilterMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUuidFilterInterface|MockObject $companyUuidFilterMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence\CompanyProductListSearchRestApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyProductListSearchRestApiRepositoryInterface $repositoryMock;

    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReader
     */
    protected CompanyUserReader $companyUserReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->idCustomerFilterMock = $this->getMockBuilder(IdCustomerFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUuidFilterMock = $this->getMockBuilder(CompanyUuidFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyProductListSearchRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->companyUserReader = new CompanyUserReader(
            $this->idCustomerFilterMock,
            $this->companyUuidFilterMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetIdByFilterFields(): void
    {
        $idCustomer = 1;
        $companyUuid = '02107536-f5b4-4e5c-9ba7-b4fe1c221c4d';
        $companyUserId = 5;

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCustomer);

        $this->companyUuidFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($companyUuid);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUserByIdCustomerAndCompanyUuid')
            ->with($idCustomer, $companyUuid)
            ->willReturn($companyUserId);

        static::assertEquals(
            $companyUserId,
            $this->companyUserReader->getIdByFilterFields($this->filterFieldTransferMocks),
        );
    }

    /**
     * @return void
     */
    public function testGetIdByFilterFieldsWithoutIdCustomer(): void
    {
        $idCustomer = null;

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCustomer);

        $this->companyUuidFilterMock->expects(static::never())
            ->method('filter');

        $this->repositoryMock->expects(static::never())
            ->method('getIdCompanyUserByIdCustomerAndCompanyUuid');

        static::assertEquals(
            null,
            $this->companyUserReader->getIdByFilterFields($this->filterFieldTransferMocks),
        );
    }

    /**
     * @return void
     */
    public function testGetIdByFilterFieldsWithoutCompanyUuid(): void
    {
        $idCustomer = 1;
        $companyUuid = null;

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCustomer);

        $this->companyUuidFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($companyUuid);

        $this->repositoryMock->expects(static::never())
            ->method('getIdCompanyUserByIdCustomerAndCompanyUuid');

        static::assertEquals(
            null,
            $this->companyUserReader->getIdByFilterFields($this->filterFieldTransferMocks),
        );
    }
}
