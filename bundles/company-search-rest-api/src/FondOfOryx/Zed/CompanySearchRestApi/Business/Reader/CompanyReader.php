<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Business\Reader;

use FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepositoryInterface
     */
    protected CompanySearchRestApiRepositoryInterface $repository;

    /**
     * @var array<\FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\SearchCompanyQueryExpanderPluginInterface>
     */
    protected array $searchCompanyQueryExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepositoryInterface $repository
     * @param array $searchCompanyQueryExpanderPlugins
     */
    public function __construct(
        CompanySearchRestApiRepositoryInterface $repository,
        array $searchCompanyQueryExpanderPlugins = []
    ) {
        $this->repository = $repository;
        $this->searchCompanyQueryExpanderPlugins = $searchCompanyQueryExpanderPlugins;
    }

 /**
  * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
  *
  * @return \Generated\Shared\Transfer\CompanyListTransfer
  */
    public function findByCompanyList(CompanyListTransfer $companyListTransfer): CompanyListTransfer
    {
        $companyListTransfer = $this->executeSearchCompanyQueryExpanderPlugins($companyListTransfer);

        return $this->repository->searchCompanies($companyListTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    protected function executeSearchCompanyQueryExpanderPlugins(
        CompanyListTransfer $companyListTransfer
    ): CompanyListTransfer {
        $queryJoinCollectionTransfer = new QueryJoinCollectionTransfer();
        $filterTransfers = $companyListTransfer->getFilterFields()->getArrayCopy();

        foreach ($this->searchCompanyQueryExpanderPlugins as $searchCompanyQueryExpanderPlugin) {
            if (!$searchCompanyQueryExpanderPlugin->isApplicable($filterTransfers)) {
                continue;
            }

            $queryJoinCollectionTransfer = $searchCompanyQueryExpanderPlugin->expand(
                $filterTransfers,
                $queryJoinCollectionTransfer,
            );
        }

        return $companyListTransfer->setQueryJoins($queryJoinCollectionTransfer);
    }
}
