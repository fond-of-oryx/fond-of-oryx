<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander\RestProductListUpdateRequestExpander;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepository;

class CompanyTypeProductListsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\CompanyTypeProductListsRestApiBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyTypeProductListsRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyTypeProductListsRestApiBusinessFactory();
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateExpander(): void
    {
        static::assertInstanceOf(
            RestProductListUpdateRequestExpander::class,
            $this->factory->createRestProductListUpdateRequestExpander(),
        );
    }
}
