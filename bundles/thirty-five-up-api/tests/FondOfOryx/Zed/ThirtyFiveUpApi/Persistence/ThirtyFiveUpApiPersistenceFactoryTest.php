<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeBridge;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeBridge;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerBridge;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapperInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\ThirtyFiveUpApiDependencyProvider;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderQuery;
use Spryker\Zed\Kernel\Container;

class ThirtyFiveUpApiPersistenceFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiPersistenceFactory
     */
    protected $factory;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpQueryBuilderContainerMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpFacadeMock;

    /**
     * @var \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderQueryMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpFacadeMock = $this->getMockBuilder(ThirtyFiveUpApiToThirtyFiveUpFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpQueryContainerMock = $this->getMockBuilder(ThirtyFiveUpApiToApiFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpQueryBuilderContainerMock = $this->getMockBuilder(ThirtyFiveUpApiToApiQueryBuilderContainerBridge::class)->disableOriginalConstructor()->getMock();
        $this->orderQueryMock = $this->getMockBuilder(FooThirtyFiveUpOrderQuery::class)->disableOriginalConstructor()->getMock();

        $this->factory = new ThirtyFiveUpApiPersistenceFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateTransferMapper(): void
    {
        $this->assertInstanceOf(
            TransferMapperInterface::class,
            $this->factory->createTransferMapper(),
        );
    }

    /**
     * @return void
     */
    public function testGetThirtyFiveUpOrderQuery(): void
    {
        $this->containerMock->method('has')->willReturn(true);
        $this->containerMock->method('get')->with(ThirtyFiveUpApiDependencyProvider::QUERY_THIRTY_FIVE_UP_ORDER)->willReturn($this->orderQueryMock);

        $this->assertInstanceOf(FooThirtyFiveUpOrderQuery::class, $this->factory->getThirtyFiveUpOrderQuery());
    }

    /**
     * @return void
     */
    public function testGetQueryBuilderContainer(): void
    {
        $this->containerMock->method('has')->willReturn(true);
        $this->containerMock->method('get')->with(ThirtyFiveUpApiDependencyProvider::QUERY_BUILDER_CONTAINER_API)->willReturn($this->thirtyFiveUpQueryBuilderContainerMock);

        $this->assertInstanceOf(ThirtyFiveUpApiToApiQueryBuilderContainerInterface::class, $this->factory->getQueryBuilderContainer());
    }

    /**
     * @return void
     */
    public function testGetThirtyFiveUpFacade(): void
    {
        $this->containerMock->method('has')->willReturn(true);
        $this->containerMock->method('get')->with(ThirtyFiveUpApiDependencyProvider::FACADE_THIRTY_FIVE_UP)->willReturn($this->thirtyFiveUpFacadeMock);

        $this->assertInstanceOf(ThirtyFiveUpApiToThirtyFiveUpFacadeInterface::class, $this->factory->getThirtyFiveUpFacade());
    }
}
