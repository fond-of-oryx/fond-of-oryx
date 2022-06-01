<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Injector;

use FondOfOryx\Zed\NoPaymentCreditMemo\Communication\Plugin\Oms\Command\NoPaymentRefundCommandPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Dependency\Injector\AbstractDependencyInjector;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandCollectionInterface;
use Spryker\Zed\Oms\OmsDependencyProvider;

class OmsDependencyInjector extends AbstractDependencyInjector
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function injectBusinessLayerDependencies(Container $container)
    {
        $container = parent::injectBusinessLayerDependencies($container);
        $container = $this->injectCommands($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function injectCommands(Container $container)
    {
        $container->extend(OmsDependencyProvider::COMMAND_PLUGINS, function (CommandCollectionInterface $commandCollection) {
            $commandCollection->add(new NoPaymentRefundCommandPlugin(), 'NoPayment/Refund');

            return $commandCollection;
        });

        return $container;
    }
}
