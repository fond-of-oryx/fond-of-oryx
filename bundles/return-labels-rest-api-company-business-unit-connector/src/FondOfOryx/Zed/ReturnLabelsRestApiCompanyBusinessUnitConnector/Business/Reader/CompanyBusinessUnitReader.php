<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Repository\ReturnLabelsRestApiCompanyBusinessUnitRepositoryInterface;

class CompanyBusinessUnitReader implements CompanyBusinessUnitReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Repository\ReturnLabelsRestApiCompanyBusinessUnitRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Repository\ReturnLabelsRestApiCompanyBusinessUnitRepositoryInterface
     */
    public function __construct(ReturnLabelsRestApiCompanyBusinessUnitRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getByRestReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ?CompanyBusinessUnitTransfer
    {
        $idCustomer = $restReturnLabelRequestTransfer->getCustomer()->getIdCustomer();

        if ($idCustomer === null) {
            return null;
        }

        return $this->repository->getCompanyBusinessUnitByIdCustomer($idCustomer);
    }
}
