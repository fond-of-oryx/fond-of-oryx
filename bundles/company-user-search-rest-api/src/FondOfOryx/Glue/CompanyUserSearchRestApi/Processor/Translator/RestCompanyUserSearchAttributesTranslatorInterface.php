<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator;

use Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer;

interface RestCompanyUserSearchAttributesTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer $restCompanyUserSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer
     */
    public function translate(
        RestCompanyUserSearchAttributesTransfer $restCompanyUserSearchAttributesTransfer,
        string $locale
    ): RestCompanyUserSearchAttributesTransfer;
}
