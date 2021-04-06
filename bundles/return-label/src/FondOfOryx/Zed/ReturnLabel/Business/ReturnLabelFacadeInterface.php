<?php


namespace FondOfOryx\Zed\ReturnLabel\Business;


use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface ReturnLabelFacadeInterface
{
    public function requestReturnLabel(CompanyUnitAddressTransfer $companyUnitAddressTransfer);
}
