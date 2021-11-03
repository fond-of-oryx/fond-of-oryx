<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator;

use Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer;

interface RestCompanyRoleSearchAttributesTranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer $restCompanyRoleSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer
     */
    public function translate(
        RestCompanyRoleSearchAttributesTransfer $restCompanyRoleSearchAttributesTransfer,
        string $locale
    ): RestCompanyRoleSearchAttributesTransfer;
}
