<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Orm\Zed\Company\Persistence\SpyCompany;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRole;
use Propel\Runtime\Collection\ObjectCollection;

class CompanyRoleMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapper;
     */
    protected $mapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\CompanyRole\Persistence\SpyCompanyRole
     */
    protected $spyCompanyRole;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Company\Persistence\SpyCompany
     */
    protected $spyCompany;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->spyCompanyRole = $this->getMockBuilder(SpyCompanyRole::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCompany = $this->getMockBuilder(SpyCompany::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new CompanyRoleMapper();
    }

    /**
     * @return void
     */
    public function testMapEntityToTransfer(): void
    {
        $this->spyCompanyRole->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->spyCompanyRole->expects(static::atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->spyCompany);

        $this->spyCompany->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('uuid');

        static::assertInstanceOf(
            CompanyRoleTransfer::class,
            $this->mapper->mapEntityToTransfer($this->spyCompanyRole),
        );
    }

    /**
     * @return void
     */
    public function testMapEntityCollectionToTransfers()
    {
        static::assertIsArray($this->mapper->mapEntityCollectionToTransfers(new ObjectCollection()));
    }
}
