<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator;

use Generated\Shared\Transfer\RestCompanySearchAttributesTransfer;

interface RestCompanySearchAttributesTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanySearchAttributesTransfer $restCompanySearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchAttributesTransfer
     */
    public function translate(
        RestCompanySearchAttributesTransfer $restCompanySearchAttributesTransfer,
        string $locale
    ): RestCompanySearchAttributesTransfer;
}
