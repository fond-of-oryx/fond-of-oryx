<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator;

use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer;

interface RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer $restCompanyBusinessUnitAddressSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer
     */
    public function translate(
        RestCompanyBusinessUnitAddressSearchAttributesTransfer $restCompanyBusinessUnitAddressSearchAttributesTransfer,
        string $locale
    ): RestCompanyBusinessUnitAddressSearchAttributesTransfer;
}
