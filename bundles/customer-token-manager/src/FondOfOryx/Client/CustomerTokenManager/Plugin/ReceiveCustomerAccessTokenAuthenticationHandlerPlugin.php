<?php

namespace FondOfOryx\Client\CustomerTokenManager\Plugin;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OauthAccessTokenValidationRequestTransfer;
use Spryker\Client\CustomerExtension\Dependency\Plugin\AccessTokenAuthenticationHandlerPluginInterface;
use Spryker\Client\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Client\CustomerTokenManager\CustomerTokenManagerFactory getFactory()
 */
class ReceiveCustomerAccessTokenAuthenticationHandlerPlugin extends AbstractPlugin implements AccessTokenAuthenticationHandlerPluginInterface
{
    /**
     * @var string
     */
    protected const CUSTOMER_REFERENCE = 'customer_reference';

    /**
     * @inheriDoc
     *
     * @param string $accessToken
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function getCustomerByAccessToken(string $accessToken): CustomerResponseTransfer
    {
        $authAccessTokenValidationRequestTransfer = (new OauthAccessTokenValidationRequestTransfer())
            ->setAccessToken($accessToken);

        $authAccessTokenValidationResponseTransfer = $this->getFactory()
            ->getOauthCLient()
            ->validateOauthAccessToken($authAccessTokenValidationRequestTransfer);

        if ($authAccessTokenValidationResponseTransfer->getIsValid() === false) {
            return (new CustomerResponseTransfer())->setIsSuccess(false);
        }

        $tokenData = $this->getFactory()->getOauthService()->extractAccessTokenData($accessToken);
        $identifier = json_decode($tokenData->getOauthUserId(), true);
        $reference = $identifier[static::CUSTOMER_REFERENCE];

        $customerTransfer = (new CustomerTransfer())->setCustomerReference($reference);

        return $this->getFactory()
            ->getCustomerClient()
            ->findCustomerByReference($customerTransfer);
    }
}
