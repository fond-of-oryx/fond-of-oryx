<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps;

use FondOfOryx\Zed\CustomerRegistration\Business\Steps\AbstractStep;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

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
     * @param \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface $oneTimePasswordFacade
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface> $preStepPlugins
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface> $postStepPlugins
     */
    public function __construct(
        CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface $oneTimePasswordFacade,
        array $preStepPlugins,
        array $postStepPlugins
    ) {
        $this->preStepPlugins = $preStepPlugins;
        $this->postStepPlugins = $postStepPlugins;
        $this->oneTimePasswordFacade = $oneTimePasswordFacade;
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

        $otpResponse = $this->oneTimePasswordFacade->requestLoginLink($bag->getCustomerOrFail());
        $bag->setMessage('could not send login link!')
            ->setIsLoginLinkSent($otpResponse->getIsSuccess())
            ->setOneTimePasswordResponse($otpResponse);
        if ($otpResponse->getIsSuccess()) {
            $bag->setMessage('login link was sent successful!');
        }

        return $this->executePostStepPlugins($customerRegistrationRequestTransfer->setBag($bag));
    }
}
