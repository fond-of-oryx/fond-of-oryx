<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Injector;

use Closure;
use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishCreditMemo\Communication\Plugin\Oms\Command\JellyfishExportCommandPlugin;
use FondOfOryx\Zed\JellyfishCreditMemo\Communication\Plugin\Oms\Condition\IsExportedConditionPlugin;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandCollection;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\ConditionCollection;
use Spryker\Zed\Oms\OmsDependencyProvider;

class OmsDependencyInjectorTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandCollectionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $commandCollectionMock;

    /**
     * @var \Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionCollectionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $conditionCollectionMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Injector\OmsDependencyInjector
     */
    protected $injector;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)->disableOriginalConstructor()->getMock();
        $this->commandCollectionMock = $this->getMockBuilder(CommandCollection::class)->disableOriginalConstructor()->getMock();
        $this->conditionCollectionMock = $this->getMockBuilder(ConditionCollection::class)->disableOriginalConstructor()->getMock();

        $this->injector = new OmsDependencyInjector();
    }

    /**
     * @return void
     */
    public function testInjectBusinessLayerDependencies(): void
    {
        $self = $this;
        $this->commandCollectionMock->expects(static::once())->method('add')->willReturnCallback(static function (AbstractPlugin $plugin, string $name) use ($self) {
            static::assertSame($name, 'JellyfishCreditMemo/Export');
            static::assertInstanceOf(JellyfishExportCommandPlugin::class, $plugin);

            return $self->commandCollectionMock;
        });
        $this->conditionCollectionMock->expects(static::once())->method('add')->willReturnCallback(static function (AbstractPlugin $plugin, string $name) use ($self) {
            static::assertSame($name, 'JellyfishCreditMemo/IsExported');
            static::assertInstanceOf(IsExportedConditionPlugin::class, $plugin);

            return $self->conditionCollectionMock;
        });

        $this->containerMock->expects(static::exactly(2))->method('extend')->willReturnCallback(static function (string $name, Closure $closure) use ($self) {
            static::assertInstanceOf(Closure::class, $closure);
            if ($name === OmsDependencyProvider::COMMAND_PLUGINS) {
                static::assertSame(OmsDependencyProvider::COMMAND_PLUGINS, $name);
                $closure($self->commandCollectionMock);
            } else {
                static::assertSame(OmsDependencyProvider::CONDITION_PLUGINS, $name);
                $closure($self->conditionCollectionMock);
            }

            return $self->containerMock;
        });
        $this->injector->injectBusinessLayerDependencies($this->containerMock);
    }
}
