<?php

namespace FondOfOryx\Yves\AvailabilityAlert;

use FondOfOryx\Client\AvailabilityAlert\AvailabilityAlertClientInterface;
use FondOfOryx\Yves\AvailabilityAlert\Dependency\Client\AvailabilityAlertToLocaleClientInterface;
use FondOfOryx\Yves\AvailabilityAlert\Dependency\Client\AvailabilityAlertToStoreClientInterface;
use FondOfOryx\Yves\AvailabilityAlert\Form\DataProvider\SubscriptionFormDataProvider;
use FondOfOryx\Yves\AvailabilityAlert\Form\SubscriptionForm;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractFactory;

class AvailabilityAlertFactory extends AbstractFactory
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createSubscriptionForm($idProductAbstract)
    {
        $dataProvider = $this->createSubscriptionFormDataProvider();

        $form = $this->getFormFactory()->create(
            $this->getSubscriptionFormType(),
            $dataProvider->getData($idProductAbstract),
            $dataProvider->getOptions(),
        );

        return $form;
    }

    /**
     * @return \FondOfOryx\Yves\AvailabilityAlert\Form\DataProvider\SubscriptionFormDataProvider
     */
    public function createSubscriptionFormDataProvider()
    {
        return new SubscriptionFormDataProvider();
    }

    /**
     * @return \Symfony\Component\Form\FormFactory
     */
    protected function getFormFactory()
    {
        return $this->getProvidedDependency(ApplicationConstants::FORM_FACTORY);
    }

    /**
     * @return string
     */
    protected function getSubscriptionFormType()
    {
        return SubscriptionForm::class;
    }

    /**
     * @return \FondOfOryx\Client\AvailabilityAlert\AvailabilityAlertClientInterface
     */
    public function getAvailabilityAlertClient(): AvailabilityAlertClientInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::CLIENT_AVAILABILITY_ALERT);
    }

    /**
     * @return \FondOfOryx\Yves\AvailabilityAlert\Dependency\Client\AvailabilityAlertToStoreClientInterface
     */
    public function getStoreClient(): AvailabilityAlertToStoreClientInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::CLIENT_STORE);
    }

    /**
     * @return \FondOfOryx\Yves\AvailabilityAlert\Dependency\Client\AvailabilityAlertToLocaleClientInterface
     */
    public function getLocaleClient(): AvailabilityAlertToLocaleClientInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::CLIENT_LOCALE);
    }

    /**
     * @return array<\FondOfOryx\Yves\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionRequestExpanderPlugin>
     */
    public function getAvailabilityAlertSubscriptionRequestExpanderPlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_REQUEST_EXPANDER);
    }
}
