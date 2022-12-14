<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps;

use FondOfOryx\Zed\CustomerRegistration\Business\Steps\AbstractStep;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;

class OneTimePasswordStep extends AbstractStep implements OneTimePasswordStepInterface
{
    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected $preStepPlugins;

    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected $postStepPlugins;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface
     */
    protected $oneTimePasswordFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface $oneTimePasswordFacade
     * @param \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface $localeFacade
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface> $preStepPlugins
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface> $postStepPlugins
     */
    public function __construct(
        CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface $oneTimePasswordFacade,
        CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface $localeFacade,
        array $preStepPlugins,
        array $postStepPlugins
    ) {
        $this->preStepPlugins = $preStepPlugins;
        $this->postStepPlugins = $postStepPlugins;
        $this->oneTimePasswordFacade = $oneTimePasswordFacade;
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function sendLoginLink(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        $bag = $this->getBag($customerRegistrationRequestTransfer);

        if ($this->checkPreConditions($customerRegistrationRequestTransfer) === false) {
            return $customerRegistrationRequestTransfer->setBag($bag->setIsVerified(false));
        }

        $otpResponse = $this->oneTimePasswordFacade->requestLoginLink($bag->getCustomerOrFail(), $this->createOneTimePasswordAttributes($customerRegistrationRequestTransfer));
        $bag->setMessage('could not send login link!')
            ->setIsLoginLinkSent($otpResponse->getIsSuccess())
            ->setOneTimePasswordResponse($otpResponse);
        if ($otpResponse->getIsSuccess()) {
            $bag->setMessage('login link was sent successful!');
        }

        return $this->executePostStepPlugins($customerRegistrationRequestTransfer->setBag($bag));
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer|null
     */
    protected function resolveLocale(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): ?LocaleTransfer
    {
        $language = $customerRegistrationRequestTransfer->getAttributesOrFail()->getLanguage();
        $locale = null;

        if ($language !== null) {
            $locale = $this->localeFacade->getLocale($language);
        }

        if ($locale === null) {
            $locale = $this->localeFacade->getCurrentLocale();
        }

        return $locale;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer
     */
    protected function createOneTimePasswordAttributes(
        CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
    ): OneTimePasswordAttributesTransfer {
        return (new OneTimePasswordAttributesTransfer())
            ->setLocale($this->resolveLocale($customerRegistrationRequestTransfer))
            ->setCallbackUrl($customerRegistrationRequestTransfer->getAttributes()->getCallbackUrl());
    }
}
