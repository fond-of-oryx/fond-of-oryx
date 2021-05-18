<?php

namespace FondOfOryx\Zed\OneTimePassword\Business;

use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordBase64Encoder;
use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGenerator;
use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGenerator;
use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGeneratorInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Resetter\OneTimePasswordResetter;
use FondOfOryx\Zed\OneTimePassword\Business\Resetter\OneTimePasswordResetterInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Sender\OneTimePasswordSender;
use FondOfOryx\Zed\OneTimePassword\Business\Sender\OneTimePasswordSenderInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordDependencyProvider;
use Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator;
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
            $this->createHybridPasswordGenerator(),
            $this->getEntityManager(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePassword\Business\Resetter\OneTimePasswordResetterInterface
     */
    public function createOneTimePasswordResetter(): OneTimePasswordResetterInterface
    {
        return new OneTimePasswordResetter(
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGeneratorInterface
     */
    public function createOneTimePasswordLinkGenerator(): OneTimePasswordLinkGeneratorInterface
    {
        return new OneTimePasswordLinkGenerator(
            $this->createOneTimePasswordGenerator(),
            $this->createOneTimePasswordEncoder(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordBase64Encoder
     */
    protected function createOneTimePasswordEncoder(): OneTimePasswordEncoderInterface
    {
        return new OneTimePasswordBase64Encoder();
    }

    /**
     * @return \Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator
     */
    protected function createHybridPasswordGenerator(): HybridPasswordGenerator
    {
        return new HybridPasswordGenerator();
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface
     */
    protected function getOneTimePasswordEmailConnectorFacade(): OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface
    {
        return $this->getProvidedDependency(OneTimePasswordDependencyProvider::FACADE_ONE_TIME_PASSWORD_EMAIL_CONNECTOR);
    }
}
