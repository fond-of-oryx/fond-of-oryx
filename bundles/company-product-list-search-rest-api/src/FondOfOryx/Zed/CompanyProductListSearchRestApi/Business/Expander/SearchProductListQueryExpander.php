<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander;

use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Communication\Plugin\PermissionExtension\SeeCompanyProductListsPermissionPlugin;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCompanyTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Propel\Runtime\ActiveQuery\Criteria;

class SearchProductListQueryExpander implements SearchProductListQueryExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface
     */
    protected CompanyUuidFilterInterface $companyUuidFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReaderInterface
     */
    protected CompanyUserReaderInterface $companyUserReader;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface
     */
    protected CompanyProductListSearchRestApiToPermissionFacadeInterface $permissionFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface $companyUuidFilter
     * @param \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReaderInterface $companyUserReader
     * @param \FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface $permissionFacade
     */
    public function __construct(
        CompanyUuidFilterInterface $companyUuidFilter,
        CompanyUserReaderInterface $companyUserReader,
        CompanyProductListSearchRestApiToPermissionFacadeInterface $permissionFacade
    ) {
        $this->companyUuidFilter = $companyUuidFilter;
        $this->companyUserReader = $companyUserReader;
        $this->permissionFacade = $permissionFacade;
    }

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    public function expand(
        array $filterFieldTransfers,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): QueryJoinCollectionTransfer {
        $companyUuid = $this->companyUuidFilter->filter($filterFieldTransfers);

        if ($companyUuid === null) {
            return $queryJoinCollectionTransfer;
        }

        $queryWhereConditionTransfer = (new QueryWhereConditionTransfer())
            ->setColumn(SpyCompanyTableMap::COL_UUID)
            ->setComparison(Criteria::EQUAL)
            ->setValue($companyUuid);

        $idCompanyUser = $this->companyUserReader->getIdByFilterFields($filterFieldTransfers);

        if ($idCompanyUser === null || !$this->permissionFacade->can(SeeCompanyProductListsPermissionPlugin::KEY, $idCompanyUser)) {
            $queryWhereConditionTransfer = (new QueryWhereConditionTransfer())
                ->setColumn(SpyCompanyTableMap::COL_ID_COMPANY)
                ->setComparison(Criteria::EQUAL)
                ->setValue('-1');
        }

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyProductListTableMap::COL_ID_PRODUCT_LIST])
                ->setRight([SpyProductListCompanyTableMap::COL_FK_PRODUCT_LIST]),
        )->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyProductListCompanyTableMap::COL_FK_COMPANY])
                ->setRight([SpyCompanyTableMap::COL_ID_COMPANY])
                ->addQueryWhereCondition($queryWhereConditionTransfer),
        );
    }
}
