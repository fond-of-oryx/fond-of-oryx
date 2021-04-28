<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\Propel\Mapper\CompanyUnitAddressMapper;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;

class ReturnLabelsRestApiRepositoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCompanyUnitAddressQueryMock;

    /**
     * @var \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCompanyUnitAddressEntityMock;

    /**
     * @var FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressMapperMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ReturnLabelsRestApiPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCompanyUnitAddressQueryMock = $this->getMockBuilder(SpyCompanyUnitAddressQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCompanyUnitAddressEntityMock = $this->getMockBuilder(SpyCompanyUnitAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressMapperMock = $this->getMockBuilder(CompanyUnitAddressMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new ReturnLabelsRestApiRepository();
        $this->repository->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressByCompanyUnitAddressUuidReturnNull(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressQuery')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('filterByUuid')
            ->with('company-unit-address-uuid')
            ->willReturnSelf();

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('findOne')
            ->willReturn(null);

        $response = $this->repository->getCompanyUnitAddressByCompanyUnitAddressUuid('company-unit-address-uuid');

        static::assertEquals(null, $response);
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressByCompanyUnitAddressUuidReturnTransfer(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressQuery')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('filterByUuid')
            ->with('company-unit-address-uuid')
            ->willReturnSelf();

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('findOne')
            ->willReturn($this->spyCompanyUnitAddressEntityMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressMapper')
            ->willReturn($this->companyUnitAddressMapperMock);

        $this->companyUnitAddressMapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->willReturn($this->companyUnitAddressTransferMock);

        $companyUnitAddressTransfer = $this->repository->getCompanyUnitAddressByCompanyUnitAddressUuid('company-unit-address-uuid');

        static::assertInstanceOf(CompanyUnitAddressTransfer::class, $companyUnitAddressTransfer);
    }
}
