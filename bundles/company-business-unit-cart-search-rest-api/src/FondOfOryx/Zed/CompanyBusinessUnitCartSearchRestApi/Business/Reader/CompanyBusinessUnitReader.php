<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader;

use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\CompanyBusinessUnitUuidFilterInterface;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepositoryInterface;

class CompanyBusinessUnitReader implements CompanyBusinessUnitReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilterInterface
     */
    protected $idCustomerFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\CompanyBusinessUnitUuidFilterInterface
     */
    protected $companyBusinessUnitUuidFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilterInterface $idCustomerFilter
     * @param \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\CompanyBusinessUnitUuidFilterInterface $companyBusinessUnitUuidFilter
     * @param \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepositoryInterface $repository
     */
    public function __construct(
        IdCustomerFilterInterface $idCustomerFilter,
        CompanyBusinessUnitUuidFilterInterface $companyBusinessUnitUuidFilter,
        CompanyBusinessUnitCartSearchRestApiRepositoryInterface $repository
    ) {
        $this->idCustomerFilter = $idCustomerFilter;
        $this->companyBusinessUnitUuidFilter = $companyBusinessUnitUuidFilter;
        $this->repository = $repository;
    }

    /**
     * @param array $filterFieldTransfers
     *
     * @return int|null
     */
    public function getIdByFilterFields(array $filterFieldTransfers): ?int
    {
        $idCustomer = null;
        $companyBusinessUnitUuid = null;

        foreach ($filterFieldTransfers as $fieldTransfer) {
            if ($idCustomer === null) {
                $idCustomer = $this->idCustomerFilter->filterByFilterField($fieldTransfer);

                continue;
            }

            if ($companyBusinessUnitUuid === null) {
                $companyBusinessUnitUuid = $this->companyBusinessUnitUuidFilter->filterByFilterField($fieldTransfer);
            }
        }

        if ($idCustomer === null || $companyBusinessUnitUuid === null) {
            return null;
        }

        return $this->repository->getIdCompanyBusinessUnitByIdCustomerAndCompanyBusinessUnitUuid(
            $idCustomer,
            $companyBusinessUnitUuid,
        );
    }
}
