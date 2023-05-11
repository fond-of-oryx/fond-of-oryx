<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade\InactiveQuoteItemFilterToMessengerFacadeInterface;
use FondOfOryx\Zed\InactiveQuoteItemFilter\InactiveQuoteItemFilterDependencyProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class InactiveQuoteItemFilterCommunicationFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade\InactiveQuoteItemFilterToMessengerFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected InactiveQuoteItemFilterToMessengerFacadeInterface|MockObject $messengerFacadeMock;

    /**
     * @var \FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\InactiveQuoteItemFilterCommunicationFactory
     */
    protected InactiveQuoteItemFilterCommunicationFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->messengerFacadeMock = $this->getMockBuilder(InactiveQuoteItemFilterToMessengerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new InactiveQuoteItemFilterCommunicationFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetMessengerFacade(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(InactiveQuoteItemFilterDependencyProvider::FACADE_MESSENGER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(InactiveQuoteItemFilterDependencyProvider::FACADE_MESSENGER)
            ->willReturn($this->messengerFacadeMock);

        static::assertEquals(
            $this->messengerFacadeMock,
            $this->factory->getMessengerFacade(),
        );
    }
}
