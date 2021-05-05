<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

interface ReturnLabelRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ?CompanyUnitAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getCompanyBusinessUnitByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ?CompanyBusinessUnitTransfer;

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getCompanyByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ?CompanyTransfer;
}
