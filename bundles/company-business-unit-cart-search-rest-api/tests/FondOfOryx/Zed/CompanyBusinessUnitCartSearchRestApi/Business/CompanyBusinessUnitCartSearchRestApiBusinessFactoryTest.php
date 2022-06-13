<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Expander\QueryJoinCollectionExpander;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepository;

class CompanyBusinessUnitCartSearchRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\CompanyBusinessUnitCartSearchRestApiBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitCartSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyBusinessUnitCartSearchRestApiBusinessFactory();
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateQueryJoinCollectionExpander(): void
    {
        static::assertInstanceOf(
            QueryJoinCollectionExpander::class,
            $this->factory->createQueryJoinCollectionExpander(),
        );
    }
}
