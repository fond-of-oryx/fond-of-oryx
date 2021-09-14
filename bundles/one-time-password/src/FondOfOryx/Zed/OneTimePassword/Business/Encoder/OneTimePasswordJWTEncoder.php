<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Encoder;

use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOauthFacadeInterface;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordJWTEncoder implements OneTimePasswordEncoderInterface
{
    protected const GRANT_TYPE_PASSWORD = 'password';

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOauthFacadeInterface
     */
    protected $oauthFacade;

    /**
     * @param \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOauthFacadeInterface $oauthFacade
     */
    public function __construct(OneTimePasswordToOauthFacadeInterface $oauthFacade)
    {
        $this->oauthFacade = $oauthFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return string|null
     */
    public function encode(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): ?string
    {
        $customer = $oneTimePasswordResponseTransfer->getCustomerTransfer();

        $oauthRequestTransfer = (new OauthRequestTransfer())
            ->setUsername($customer->getEmail())
            ->setPassword($oneTimePasswordResponseTransfer->getOneTimePasswordPlain())
            ->setGrantType(self::GRANT_TYPE_PASSWORD);

        $oauthResponseTransfer = $this->oauthFacade->processAccessTokenRequest($oauthRequestTransfer);

        if (!$oauthResponseTransfer->getIsValid()) {
            return null;
        }

        return $oauthResponseTransfer->getAccessToken();
    }
}
