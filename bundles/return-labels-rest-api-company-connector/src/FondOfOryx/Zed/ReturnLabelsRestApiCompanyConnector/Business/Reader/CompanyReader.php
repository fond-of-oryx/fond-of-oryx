<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\ReturnLabelsRestApiCompanyConnectorRepositoryInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\ReturnLabelsRestApiCompanyConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\ReturnLabelsRestApiCompanyConnectorRepositoryInterface $repository
     */
    public function __construct(ReturnLabelsRestApiCompanyConnectorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getByRestReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ?CompanyTransfer {
        if ($restReturnLabelRequestTransfer->getCustomer() === null) {
            return null;
        }

        $companyUserReference = $restReturnLabelRequestTransfer->getCustomer()->getReference();
        $idCustomer = $restReturnLabelRequestTransfer->getCustomer()->getIdCustomer();

        if ($companyUserReference === null || $idCustomer === null) {
            return null;
        }

        return $this->repository->getCompanyByCompanyUserReferenceAndIdCustomer($companyUserReference, $idCustomer);
    }
}
