<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutorInterface;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager\ProportionalGiftCardValueManagerInterface;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Validator\HasRedeemedGiftCardValidatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValue\GiftCardProportionalValueDependencyProvider;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManager;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepository;
use Spryker\Zed\Kernel\Container;

class GiftCardProportionalValueBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $repositoryMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock =
            $this->getMockBuilder(GiftCardProportionalValueEntityManager::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->repositoryMock =
            $this->getMockBuilder(GiftCardProportionalValueRepository::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->containerMock =
            $this->getMockBuilder(Container::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->factory = new GiftCardProportionalValueBusinessFactory();
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateHasRedeemedGiftCardValidator(): void
    {
        $this->assertInstanceOf(HasRedeemedGiftCardValidatorInterface::class, $this->factory->createHasRedeemedGiftCardValidator());
    }

    /**
     * @return void
     */
    public function testCreateManager(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [GiftCardProportionalValueDependencyProvider::PLUGINS_PROPORTIONAL_VALUE_CALCULATION],
            )
            ->willReturnOnConsecutiveCalls(
                [],
            );

        $this->assertInstanceOf(ProportionalGiftCardValueManagerInterface::class, $this->factory->createManager());
    }

    /**
     * @return void
     */
    public function testCreateProportionalValueCalculatorPluginExecutor(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [GiftCardProportionalValueDependencyProvider::PLUGINS_PROPORTIONAL_VALUE_CALCULATION],
            )
            ->willReturnOnConsecutiveCalls(
                [],
            );

        $this->assertInstanceOf(ProportionalValueCalculatorPluginExecutorInterface::class, $this->factory->createProportionalValueCalculatorPluginExecutor());
    }
}
