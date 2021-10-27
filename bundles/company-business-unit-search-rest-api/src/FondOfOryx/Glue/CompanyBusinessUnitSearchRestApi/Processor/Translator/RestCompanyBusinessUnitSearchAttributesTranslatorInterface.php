<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator;

use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer;

interface RestCompanyBusinessUnitSearchAttributesTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer $restCompanyBusinessUnitSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer
     */
    public function translate(
        RestCompanyBusinessUnitSearchAttributesTransfer $restCompanyBusinessUnitSearchAttributesTransfer,
        string $locale
    ): RestCompanyBusinessUnitSearchAttributesTransfer;
}
