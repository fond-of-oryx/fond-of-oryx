<?php

namespace FondOfOryx\Service\CrossEngage;

use FondOfOryx\Service\CrossEngage\Model\Validator\HoneypotValidator;
use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;
use Spryker\Shared\Kernel\Store;

class CrossEngageDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CROSSENGAGE_FORM_VALIDATOR = 'CROSSENGAGE_FORM_VALIDATOR';

    /**
     * @var string
     */
    public const INSTANCE_STORE = 'INSTANCE_STORE';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container)
    {
        $container = $this->addFormValidator($container);
        $container = $this->addStoreInstance($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function addFormValidator(Container $container): Container
    {
        $container[static::CROSSENGAGE_FORM_VALIDATOR] = function () {
            return $this->registerFormValidator();
        };

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function addStoreInstance(Container $container): Container
    {
        $container[static::INSTANCE_STORE] = function () {
            return Store::getInstance();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Service\CrossEngage\Model\Validator\HoneypotValidator>
     */
    protected function registerFormValidator(): array
    {
        return [
            new HoneypotValidator(),
        ];
    }
}
