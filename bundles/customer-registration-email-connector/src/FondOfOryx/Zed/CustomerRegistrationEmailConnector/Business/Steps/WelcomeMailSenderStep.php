<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Steps;

use Exception;
use FondOfOryx\Zed\CustomerRegistration\Business\Steps\AbstractStep;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class WelcomeMailSenderStep extends AbstractStep implements WelcomeMailSenderStepInterface
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
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface
     */
    protected $welcomeMailSender;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface $welcomeMailSender
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface> $preStepPlugins
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface> $postStepPlugins
     */
    public function __construct(
        WelcomeMailSenderInterface $welcomeMailSender,
        array $preStepPlugins,
        array $postStepPlugins
    ) {
        $this->preStepPlugins = $preStepPlugins;
        $this->postStepPlugins = $postStepPlugins;
        $this->welcomeMailSender = $welcomeMailSender;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function sendWelcomeMail(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        if ($this->checkPreConditions($customerRegistrationRequestTransfer) === false) {
            return $this->executePostStepPlugins($customerRegistrationRequestTransfer);
        }

        $bag = $customerRegistrationRequestTransfer->getBagOrFail();
        $customerTransfer = $bag->getCustomer();

        if ($customerTransfer === null || $bag->getEmailVerificationLink() === null) {
            return $customerRegistrationRequestTransfer;
        }

        try {
            $this->welcomeMailSender->sendWelcomeMail($customerTransfer, $bag->getEmailVerificationLink());
            $bag->setMessage('Verification Link successfully sent!')
                ->setIsWelcomeMailSent(true);
        } catch (Exception $exception) {
            $bag->setMessage('Could not send verification Link!')
                ->setIsWelcomeMailSent(false);
        }

        return $this->executePostStepPlugins($customerRegistrationRequestTransfer->setBag($bag));
    }
}
