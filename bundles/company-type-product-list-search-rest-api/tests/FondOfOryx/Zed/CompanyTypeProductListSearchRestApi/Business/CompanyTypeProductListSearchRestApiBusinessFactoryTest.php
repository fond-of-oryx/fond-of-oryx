<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander\SearchProductListQueryExpander;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiRepository;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyTypeProductListSearchRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyTypeProductListSearchRestApiRepository $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\CompanyTypeProductListSearchRestApiBusinessFactory
     */
    protected CompanyTypeProductListSearchRestApiBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyTypeProductListSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyTypeProductListSearchRestApiBusinessFactory();
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateSearchProductListQueryExpander(): void
    {
        static::assertInstanceOf(
            SearchProductListQueryExpander::class,
            $this->factory->createSearchProductListQueryExpander(),
        );
    }
}
