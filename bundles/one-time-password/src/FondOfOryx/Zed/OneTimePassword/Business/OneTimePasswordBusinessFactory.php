<?php

namespace FondOfOryx\Zed\OneTimePassword\Business;

use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGenerator;
use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Sender\OneTimePasswordSender;
use FondOfOryx\Zed\OneTimePassword\Business\Sender\OneTimePasswordSenderInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordDependencyProvider;
use Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig getConfig()
 */
class OneTimePasswordBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\OneTimePassword\Business\Sender\OneTimePasswordSenderInterface
     */
    public function createOneTimePasswordSender(): OneTimePasswordSenderInterface
    {
        return new OneTimePasswordSender(
            $this->createOneTimePasswordGenerator(),
            $this->getOneTimePasswordEmailConnectorFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface
     */
    public function createOneTimePasswordGenerator(): OneTimePasswordGeneratorInterface
    {
        return new OneTimePasswordGenerator(
            $this->createComputerPasswordGenerator(),
            $this->getEntityManager(),
            $this->getConfig()
        );
    }

    /**
     * @return \Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator
     */
    protected function createComputerPasswordGenerator(): HumanPasswordGenerator
    {
        return new HumanPasswordGenerator();
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface
     */
    protected function getOneTimePasswordEmailConnectorFacade(): OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface
    {
        return $this->getProvidedDependency(OneTimePasswordDependencyProvider::FACADE_ONE_TIME_PASSWORD_EMAIL_CONNECTOR);
    }
}
