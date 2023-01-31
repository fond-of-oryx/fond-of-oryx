<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Communication\Plugin\Api;

use FondOfOryx\Shared\ThirtyFiveUpApi\ThirtyFiveUpApiConstants;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\ApiExtension\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory getFactory()
 */
class ThirtyFiveUpApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ThirtyFiveUpApiConstants::RESOURCE_THIRTY_FIVE_UP_ORDERS_API;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFacade()->validate($apiRequestTransfer);
    }
}
