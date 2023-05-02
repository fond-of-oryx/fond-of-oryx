<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander\MailExpander;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeInterface;
use FondOfOryx\Zed\FallbackLocaleMailProxy\FallbackLocaleMailProxyDependencyProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class FallbackLocaleMailProxyBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|FallbackLocaleMailProxyToStoreFacadeInterface $storeFacadeBridgeMock;

    /**
     * @var \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\FallbackLocaleMailProxyBusinessFactory
     */
    protected FallbackLocaleMailProxyBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeBridgeMock = $this->getMockBuilder(FallbackLocaleMailProxyToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new FallbackLocaleMailProxyBusinessFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateMailExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(FallbackLocaleMailProxyDependencyProvider::FACADE_STORE)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(FallbackLocaleMailProxyDependencyProvider::FACADE_STORE)
            ->willReturn($this->storeFacadeBridgeMock);

        static::assertInstanceOf(
            MailExpander::class,
            $this->factory->createMailExpander(),
        );
    }
}
