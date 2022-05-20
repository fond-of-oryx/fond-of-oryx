<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ConcreteProductApi\Business\Model\ConcreteProductApi;
use FondOfOryx\Zed\ConcreteProductApi\Business\Validator\ConcreteProductApiValidator;
use FondOfOryx\Zed\ConcreteProductApi\ConcreteProductApiDependencyProvider;
use FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToProductFacadeInterface;
use FondOfOryx\Zed\ConcreteProductApi\Dependency\QueryContainer\ConcreteProductApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ConcreteProductApi\Persistence\ConcreteProductApiRepository;
use Spryker\Zed\Kernel\Container;

class ConcreteProductApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ConcreteProductApi\Dependency\QueryContainer\ConcreteProductApiToApiQueryContainerInterface
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ConcreteProductApi\Persistence\ConcreteProductApiRepository
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToProductFacadeInterface
     */
    protected $productFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Business\ConcreteProductApiBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(ConcreteProductApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ConcreteProductApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productFacadeMock = $this->getMockBuilder(ConcreteProductApiToProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ConcreteProductApiBusinessFactory();
        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateConcreteProductApi(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ConcreteProductApiDependencyProvider::QUERY_CONTAINER_API],
                [ConcreteProductApiDependencyProvider::FACADE_PRODUCT],
            )->willReturnOnConsecutiveCalls(
                $this->apiQueryContainerMock,
                $this->productFacadeMock,
            );

        static::assertInstanceOf(ConcreteProductApi::class, $this->factory->createConcreteProductApi());
    }

    /**
     * @return void
     */
    public function testCreateConcreteProductApiValidator(): void
    {
        static::assertInstanceOf(
            ConcreteProductApiValidator::class,
            $this->factory->createConcreteProductApiValidator(),
        );
    }
}
