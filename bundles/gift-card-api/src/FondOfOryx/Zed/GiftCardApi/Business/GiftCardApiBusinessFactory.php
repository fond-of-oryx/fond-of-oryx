<?php

namespace FondOfOryx\Zed\GiftCardApi\Business;

use FondOfOryx\Zed\GiftCardApi\Business\Model\GiftCardApi;
use FondOfOryx\Zed\GiftCardApi\Business\Model\GiftCardApiInterface;
use FondOfOryx\Zed\GiftCardApi\Business\Model\Validator\GiftCardApiValidator;
use FondOfOryx\Zed\GiftCardApi\Business\Model\Validator\GiftCardApiValidatorInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardApi\GiftCardApiConfig getConfig()
 * @method \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepository getRepository()
 */
class GiftCardApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardApi\Business\Model\GiftCardApiInterface
     */
    public function createGiftCardApi(): GiftCardApiInterface
    {
        return new GiftCardApi(
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardApi\Business\Model\Validator\GiftCardApiValidatorInterface
     */
    public function createGiftCardApiValidator(): GiftCardApiValidatorInterface
    {
        return new GiftCardApiValidator();
    }
}
