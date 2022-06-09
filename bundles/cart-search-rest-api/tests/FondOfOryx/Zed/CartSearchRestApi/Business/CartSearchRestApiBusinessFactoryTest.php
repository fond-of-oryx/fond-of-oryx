<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CartSearchRestApi\Business\Reader\QuoteReader;
use FondOfOryx\Zed\CartSearchRestApi\CartSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CartSearchRestApi\Dependency\Facade\CartSearchRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepository;
use FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface;
use Spryker\Zed\Kernel\Container;

class CartSearchRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Dependency\Facade\CartSearchRestApiToQuoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $searchQuoteQueryExpanderPluginMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Business\CartSearchRestApiBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CartSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(CartSearchRestApiToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchQuoteQueryExpanderPluginMock = $this->getMockBuilder(SearchQuoteQueryExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CartSearchRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CartSearchRestApiDependencyProvider::FACADE_QUOTE],
                [CartSearchRestApiDependencyProvider::PLUGINS_SEARCH_QUOTE_QUERY_EXPANDER],
            )->willReturnOnConsecutiveCalls(
                $this->quoteFacadeMock,
                [
                    $this->searchQuoteQueryExpanderPluginMock,
                ],
            );

        static::assertInstanceOf(
            QuoteReader::class,
            $this->factory->createQuoteReader(),
        );
    }
}
