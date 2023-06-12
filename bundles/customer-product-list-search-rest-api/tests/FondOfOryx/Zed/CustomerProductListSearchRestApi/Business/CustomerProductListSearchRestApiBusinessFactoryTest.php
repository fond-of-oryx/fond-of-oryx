<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Expander\SearchProductListQueryExpander;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\CustomerProductListSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceInterface;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence\CustomerProductListSearchRestApiRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class CustomerProductListSearchRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence\CustomerProductListSearchRestApiRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerProductListSearchRestApiRepository $repositoryMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerProductListSearchRestApiToUtilEncodingServiceInterface|MockObject $utilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\CustomerProductListSearchRestApiBusinessFactory
     */
    protected CustomerProductListSearchRestApiBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerProductListSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilEncodingServiceMock = $this->getMockBuilder(CustomerProductListSearchRestApiToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CustomerProductListSearchRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateSearchProductListQueryExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CustomerProductListSearchRestApiDependencyProvider::SERVICE_UTIL_ENCODING)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CustomerProductListSearchRestApiDependencyProvider::SERVICE_UTIL_ENCODING)
            ->willReturn($this->utilEncodingServiceMock);

        static::assertInstanceOf(
            SearchProductListQueryExpander::class,
            $this->factory->createSearchProductListQueryExpander(),
        );
    }
}
