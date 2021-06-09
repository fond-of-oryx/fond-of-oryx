<?php

namespace FondOfOryx\Yves\Prepayment\Dependency\Injector;

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use FondOfOryx\Yves\Prepayment\Plugin\PrepaymentHandlerPlugin;
use FondOfOryx\Yves\Prepayment\Plugin\PrepaymentSubFormPlugin;
use Spryker\Shared\Kernel\ContainerInterface;
use Spryker\Yves\Checkout\CheckoutDependencyProvider;
use Spryker\Yves\Kernel\Container;
use Spryker\Yves\Kernel\Dependency\Injector\DependencyInjectorInterface;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection;
use Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginCollection;

class CheckoutDependencyInjector implements DependencyInjectorInterface
{
    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Shared\Kernel\ContainerInterface|\Spryker\Yves\Kernel\Container
     */
    public function inject(Container $container)
    {
        $container = $this->injectPaymentSubForms($container);
        $container = $this->injectPaymentMethodHandler($container);

        return $container;
    }

    /**
     * @param \Spryker\Shared\Kernel\ContainerInterface $container
     *
     * @return \Spryker\Shared\Kernel\ContainerInterface
     */
    protected function injectPaymentSubForms(ContainerInterface $container)
    {
        $container->extend(CheckoutDependencyProvider::PAYMENT_SUB_FORMS, function (SubFormPluginCollection $paymentSubForms) {
            $paymentSubForms->add(new PrepaymentSubFormPlugin());

            return $paymentSubForms;
        });

        return $container;
    }

    /**
     * @param \Spryker\Shared\Kernel\ContainerInterface $container
     *
     * @return \Spryker\Shared\Kernel\ContainerInterface
     */
    protected function injectPaymentMethodHandler(ContainerInterface $container)
    {
        $container->extend(CheckoutDependencyProvider::PAYMENT_METHOD_HANDLER, function (StepHandlerPluginCollection $paymentMethodHandler) {
            $prepaymentHandlerPlugin = new PrepaymentHandlerPlugin();

            $paymentMethodHandler->add($prepaymentHandlerPlugin, PrepaymentConstants::PREPAYMENT_PROPERTY_PATH);

            return $paymentMethodHandler;
        });

        return $container;
    }
}
