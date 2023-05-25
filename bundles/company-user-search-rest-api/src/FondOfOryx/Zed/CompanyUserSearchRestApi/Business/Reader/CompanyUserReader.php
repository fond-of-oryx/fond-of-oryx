<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader;

use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

class CompanyUserReader implements CompanyUserReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepositoryInterface
     */
    protected CompanyUserSearchRestApiRepositoryInterface $repository;

    /**
     * @var array<\FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\SearchCompanyUserQueryExpanderPluginInterface>
     */
    protected array $searchCompanyUserQueryExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepositoryInterface $repository
     * @param array $searchCompanyUserQueryExpanderPlugins
     */
    public function __construct(
        CompanyUserSearchRestApiRepositoryInterface $repository,
        array $searchCompanyUserQueryExpanderPlugins = []
    ) {
        $this->repository = $repository;
        $this->searchCompanyUserQueryExpanderPlugins = $searchCompanyUserQueryExpanderPlugins;
    }

 /**
  * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
  *
  * @return \Generated\Shared\Transfer\CompanyUserListTransfer
  */
    public function findByCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer
    {
        $companyUserListTransfer = $this->executeSearchCompanyUserQueryExpanderPlugins($companyUserListTransfer);

        return $this->repository->searchCompanyUser($companyUserListTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    protected function executeSearchCompanyUserQueryExpanderPlugins(
        CompanyUserListTransfer $companyUserListTransfer
    ): CompanyUserListTransfer {
        $queryJoinCollectionTransfer = new QueryJoinCollectionTransfer();
        $filterTransfers = $companyUserListTransfer->getFilterFields()->getArrayCopy();

        foreach ($this->searchCompanyUserQueryExpanderPlugins as $searchCompanyUserQueryExpanderPlugin) {
            if (!$searchCompanyUserQueryExpanderPlugin->isApplicable($filterTransfers)) {
                continue;
            }

            $queryJoinCollectionTransfer = $searchCompanyUserQueryExpanderPlugin->expand(
                $filterTransfers,
                $queryJoinCollectionTransfer,
            );
        }

        return $companyUserListTransfer->setQueryJoins($queryJoinCollectionTransfer);
    }
}
