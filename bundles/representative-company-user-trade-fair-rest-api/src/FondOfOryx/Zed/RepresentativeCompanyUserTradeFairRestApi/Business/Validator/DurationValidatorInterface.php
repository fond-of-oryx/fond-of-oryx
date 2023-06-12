<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;

interface DurationValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer $restRepresentativeCompanyUserTradeFairAttributesTransfer
     *
     * @return bool
     */
    public function validate(
        RestRepresentativeCompanyUserTradeFairAttributesTransfer $restRepresentativeCompanyUserTradeFairAttributesTransfer
    ): bool;
}
