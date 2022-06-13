<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Dependency\Injector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValue\Communication\Plugin\Oms\Command\GiftCardProportionalValueCalculatorCommandPlugin;
use FondOfOryx\Zed\GiftCardProportionalValue\Communication\Plugin\Oms\Condition\HasRedeemedGiftCardsConditionPlugin;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandCollectionInterface;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\ConditionCollectionInterface;
use Spryker\Zed\Oms\OmsDependencyProvider;

class OmsDependencyInjectorTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $containerMock;

    /**
     * @var \Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandCollectionInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $commandCollectionMock;

    /**
     * @var \Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\ConditionCollectionInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $conditionCollectionMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Dependency\Injector\OmsDependencyInjector
     */
    protected $injector;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock =
            $this->getMockBuilder(Container::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->commandCollectionMock =
            $this->getMockBuilder(CommandCollectionInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->conditionCollectionMock =
            $this->getMockBuilder(ConditionCollectionInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->injector = new OmsDependencyInjector();
    }

    /**
     * @return void
     */
    public function testInjectBusinessLayerDependencies(): void
    {
        $self = $this;
        $this->containerMock->expects(static::atLeastOnce())
            ->method('extend')
            ->willReturnCallback(static function (string $type, callable $callable) use ($self) {
                if ($type === OmsDependencyProvider::COMMAND_PLUGINS) {
                    $callable($self->commandCollectionMock);

                    return $callable;
                }

                $self->assertSame(OmsDependencyProvider::CONDITION_PLUGINS, $type);
                $callable($self->conditionCollectionMock);

                return $callable;
            });

        $this->commandCollectionMock->expects(static::atLeastOnce())
            ->method('add')
            ->willReturnCallback(static function (AbstractPlugin $plugin, string $name) use ($self) {
                $self->assertInstanceOf(GiftCardProportionalValueCalculatorCommandPlugin::class, $plugin);
                $self->assertSame('GiftCardProportionalValue/CalculateProportionalValues', $name);
            });

        $this->conditionCollectionMock->expects(static::atLeastOnce())
            ->method('add')
            ->willReturnCallback(static function (AbstractPlugin $plugin, string $name) use ($self) {
                $self->assertInstanceOf(HasRedeemedGiftCardsConditionPlugin::class, $plugin);
                $self->assertSame('GiftCardProportionalValue/HasRedeemedGiftCards', $name);
            });

        $this->injector->injectBusinessLayerDependencies($this->containerMock);
    }
}
