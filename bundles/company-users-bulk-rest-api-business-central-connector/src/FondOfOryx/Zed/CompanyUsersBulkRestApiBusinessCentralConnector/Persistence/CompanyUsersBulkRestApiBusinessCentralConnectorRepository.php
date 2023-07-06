<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Persistence;

use ArrayObject;
use FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Dependency\Facade\CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeInterface;
use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Persistence\CompanyUsersBulkRestApiBusinessCentralConnectorPersistenceFactory getFactory()
 */
class CompanyUsersBulkRestApiBusinessCentralConnectorRepository extends AbstractRepository implements CompanyUsersBulkRestApiBusinessCentralConnectorRepositoryInterface
{
    /**
     * @param array $debtorNumbers
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function findCompaniesByDebtorNumbers(array $debtorNumbers): CompanyCollectionTransfer
    {
        $collection = new CompanyCollectionTransfer();

        if (count($debtorNumbers) === 0) {
            return $collection;
        }
        $companyTransfers = $this->getCompanyTransfers($debtorNumbers);

        return $collection->setCompanies(new ArrayObject($companyTransfers));
    }

    /**
     * @param array $companyIds
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     */
    protected function getCompanyTransfers(array $debtorNumbers): array
    {
        $result = $this->getFactory()->getCompanyQuery()
            ->filterByDebtorNumber_In($debtorNumbers)
            ->select([SpyCompanyTableMap::COL_ID_COMPANY, SpyCompanyTableMap::COL_DEBTOR_NUMBER])
            ->find();

        $collection = [];
        foreach ($result->getData() as $companyData){
            $idCompany = $companyData[SpyCompanyTableMap::COL_ID_COMPANY];
            $debtorNumber = $companyData[SpyCompanyTableMap::COL_DEBTOR_NUMBER];
            $collection[$idCompany] = (new CompanyUsersBulkCompanyTransfer())
                ->setIdCompany($idCompany)
                ->setDebtorNumber($debtorNumber);
        }

        $collection = $this->getCompanyUsersBulkRestApiFacade()->appendCompanyBusinessUnitsToCompanyTransfers($collection);
        return $this->getCompanyUsersBulkRestApiFacade()->appendCompanyRolesToCompanyTransfers($collection);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Dependency\Facade\CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getCompanyUsersBulkRestApiFacade(): CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeInterface{
        return $this->getFactory()->getCompanyUsersBulkRestApiFacade();
    }
}
