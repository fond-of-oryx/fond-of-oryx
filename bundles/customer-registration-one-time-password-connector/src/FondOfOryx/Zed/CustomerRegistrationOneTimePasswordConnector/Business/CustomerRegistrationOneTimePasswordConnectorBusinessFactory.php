<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business;

use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps\OneTimePasswordStep;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps\OneTimePasswordStepInterface;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\CustomerRegistrationOneTimePasswordConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CustomerRegistrationOneTimePasswordConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps\OneTimePasswordStepInterface
     */
    public function createOneTimePasswordStep(): OneTimePasswordStepInterface
    {
        return new OneTimePasswordStep(
            $this->getOneTimePasswordFacade(),
            $this->getLocaleFacade(),
            $this->getOneTimePasswordPreConditionPlugins(),
            $this->getOneTimePasswordPostPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface
     */
    protected function getOneTimePasswordFacade(): CustomerRegistrationToOneTimePasswordFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationOneTimePasswordConnectorDependencyProvider::FACADE_ONE_TIME_PASSWORD);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface
     */
    protected function getLocaleFacade(): CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationOneTimePasswordConnectorDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected function getOneTimePasswordPreConditionPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationOneTimePasswordConnectorDependencyProvider::PLUGINS_ONE_TIME_PASSWORD_PRE);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getOneTimePasswordPostPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationOneTimePasswordConnectorDependencyProvider::PLUGINS_ONE_TIME_PASSWORD_POST);
    }
}
