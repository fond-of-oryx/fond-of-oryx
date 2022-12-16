<?php

namespace FondOfOryx\Glue\PayoneRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestPayoneCreditCardDataResponseAttributesTransfer;
use SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer;

class RestCreditCardDataResponseAttributesMapper implements RestCreditCardDataResponseAttributesMapperInterface
{
    /**
     * @param \SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer $creditCardCheckContainer
     * @return \Generated\Shared\Transfer\RestPayoneCreditCardDataResponseAttributesTransfer
     */
    public function mapCreditCardDataContainerToResponseAttributesTransfer(
        CreditCardCheckContainer $creditCardCheckContainer
    ): RestPayoneCreditCardDataResponseAttributesTransfer {
        return (new RestPayoneCreditCardDataResponseAttributesTransfer())
            ->fromArray($creditCardCheckContainer->toArray(), true)
            ->setPortalId($creditCardCheckContainer->getPortalid())
            ->setResponseType($creditCardCheckContainer->getResponseType() === null ? 'JSON' : $creditCardCheckContainer->getResponseType())
            ->setStoreCardData($creditCardCheckContainer->getStorecarddata())
            ->setJsonData($creditCardCheckContainer->toJson());
    }
}
