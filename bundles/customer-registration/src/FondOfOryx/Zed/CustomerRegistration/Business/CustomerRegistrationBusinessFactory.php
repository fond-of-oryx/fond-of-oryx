<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business;

use FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGenerator;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGeneratorInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\EmailVerificationLinkGenerator;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\EmailVerificationLinkGeneratorInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGenerator;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Processor\CustomerRegistrationProcessor;
use FondOfOryx\Zed\CustomerRegistration\Business\Processor\CustomerRegistrationProcessorInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Sender\WelcomeMailSender;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\GdprStep;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\GdprStepInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\RegistrationStep;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\RegistrationStepInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\VerificationStep;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\VerificationStepInterface;
use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationDependencyProvider;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig getConfig()
 */
class CustomerRegistrationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Processor\CustomerRegistrationProcessorInterface
     */
    public function createCustomerRegistrationProcessor(): CustomerRegistrationProcessorInterface
    {
        return new CustomerRegistrationProcessor($this->getCustomerRegistrationProcessorPlugins());
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Steps\RegistrationStepInterface
     */
    public function createRegistrationStep(): RegistrationStepInterface
    {
        return new RegistrationStep(
            $this->createPasswordGenerator(),
            $this->createCustomerReferenceGenerator(),
            $this->getCustomerFacade(),
            $this->getLocaleFacade(),
            new NativePasswordHasher(null, null, 12),
            $this->getEntityManager(),
            $this->getCustomerRegistrationPostPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Steps\GdprStepInterface
     */
    public function createGdprStep(): GdprStepInterface
    {
        return new GdprStep(
            $this->getRepository(),
            $this->getEntityManager(),
            $this->getGdprPreConditionPlugins(),
            $this->getGdprPostPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Steps\VerificationStepInterface
     */
    public function createMailVerificationStep(): VerificationStepInterface
    {
        return new VerificationStep(
            $this->getRepository(),
            $this->getEntityManager(),
            $this->getMailVerificationPreConditionPlugins(),
            $this->getMailVerificationPostPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGeneratorInterface
     */
    public function createCustomerReferenceGenerator(): CustomerReferenceGeneratorInterface
    {
        return new CustomerReferenceGenerator(
            $this->getSequenceNumberFacade(),
            $this->getStoreFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Generator\EmailVerificationLinkGeneratorInterface
     */
    public function createEmailVerificationLinkGenerator(): EmailVerificationLinkGeneratorInterface
    {
        return new EmailVerificationLinkGenerator(
            $this->getConfig(),
            $this->getEmailVerificationLinkExtenderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Sender\WelcomeMailSender
     */
    public function createWelcomeMail(): WelcomeMailSender
    {
        return new WelcomeMailSender(
            $this->getMailfacade(),
            $this->getOneTimePasswordFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface
     */
    public function createPasswordGenerator(): PasswordGeneratorInterface
    {
        return new PasswordGenerator($this->getUtilTextService());
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface
     */
    protected function getSequenceNumberFacade(): CustomerRegistrationToSequenceNumberFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_SEQUENCE_NUMBER);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface
     */
    protected function getStoreFacade(): CustomerRegistrationToStoreFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface
     */
    protected function getCustomerFacade(): CustomerRegistrationToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface
     */
    protected function getLocaleFacade(): CustomerRegistrationToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface
     */
    protected function getMailfacade(): CustomerRegistrationToMailFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_MAIL);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface
     */
    protected function getOneTimePasswordFacade(): CustomerRegistrationToOneTimePasswordFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_ONE_TIME_PASSWORD);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface
     */
    protected function getUtilTextService(): CustomerRegistrationToUtilTextServiceInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::SERVICE_UTIL_TEXT_SERVICE);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPluginInterface>
     */
    protected function getCustomerRegistrationProcessorPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::PLUGINS_CUSTOMER_REGISTRATION_PROCESSOR);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getCustomerRegistrationPostPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::PLUGINS_CUSTOMER_REGISTRATION_POST);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected function getGdprPreConditionPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::PLUGINS_GDPR_PRE);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getGdprPostPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::PLUGINS_GDPR_POST);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected function getMailVerificationPreConditionPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::PLUGINS_MAIL_VERIFICATION_PRE);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getMailVerificationPostPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::PLUGINS_MAIL_VERIFICATION_POST);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\EmailVerificationLinkExpanderPluginInterface>
     */
    protected function getEmailVerificationLinkExtenderPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::PLUGINS_EMAIL_VERIFICATION_LINK_EXTENDER);
    }
}
