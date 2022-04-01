<?php

namespace FondOfOryx\Zed\GiftCardApi\Communication\Plugin\Api;

use FondOfOryx\Zed\GiftCardApi\GiftCardApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\GiftCardApi\GiftCardApiConfig getConfig()
 */
class GiftCardApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return GiftCardApiConfig::RESOURCE_GIFT_CARD;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}
