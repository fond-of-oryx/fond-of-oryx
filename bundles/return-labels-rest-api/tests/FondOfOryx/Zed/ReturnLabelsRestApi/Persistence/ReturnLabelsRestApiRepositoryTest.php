<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Codeception\Test\Unit;
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

        $this->repository = new ReturnLabelsRestApiRepository();
        $this->repository->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetIdCompanyUnitAddressByCompanyUnitAddressUuidReturnNull(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressQuery')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('select')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('filterByUuid')
            ->with('company-unit-address-uuid')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $response = $this->repository->getIdCompanyUnitAddressByCompanyUnitAddressUuid('company-unit-address-uuid');

        static::assertEquals(null, $response);
    }

    /**
     * @return void
     */
    public function testGetIdCompanyUnitAddressByCompanyUnitAddressUuidReturnInt(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressQuery')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('select')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('filterByUuid')
            ->with('company-unit-address-uuid')
            ->willReturn($this->spyCompanyUnitAddressQueryMock);

        $this->spyCompanyUnitAddressQueryMock->expects(static::atLeastOnce())
            ->method('findOne')
            ->willReturn(42);

        $response = $this->repository->getIdCompanyUnitAddressByCompanyUnitAddressUuid('company-unit-address-uuid');

        static::assertEquals(42, $response);
    }
}
