<?php

namespace FondOfOryx\Glue\PayoneRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestPayoneCreditCardDataResponseAttributesTransfer;
use SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer;

interface RestCreditCardDataResponseAttributesMapperInterface
{
    /**
     * @param \SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer $creditCardCheckContainer
     * @return \Generated\Shared\Transfer\RestPayoneCreditCardDataResponseAttributesTransfer
     */
    public function mapCreditCardDataContainerToResponseAttributesTransfer(
        CreditCardCheckContainer $creditCardCheckContainer
    ): RestPayoneCreditCardDataResponseAttributesTransfer;
}
