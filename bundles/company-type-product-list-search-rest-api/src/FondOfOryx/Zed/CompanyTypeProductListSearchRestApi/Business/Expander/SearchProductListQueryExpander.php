<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander;

use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilterInterface;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCustomerTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Propel\Runtime\ActiveQuery\Criteria;

class SearchProductListQueryExpander implements SearchProductListQueryExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilterInterface
     */
    protected ForeignCustomerReferenceFilterInterface $foreignCustomerReferenceFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface
     */
    protected IdCustomerFilterInterface $idCustomerFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiRepositoryInterface
     */
    protected CompanyTypeProductListSearchRestApiRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilterInterface $foreignCustomerReferenceFilter
     * @param \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface $idCustomerFilter
     * @param \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiRepositoryInterface $repository
     */
    public function __construct(
        ForeignCustomerReferenceFilterInterface $foreignCustomerReferenceFilter,
        IdCustomerFilterInterface $idCustomerFilter,
        CompanyTypeProductListSearchRestApiRepositoryInterface $repository
    ) {
        $this->foreignCustomerReferenceFilter = $foreignCustomerReferenceFilter;
        $this->repository = $repository;
        $this->idCustomerFilter = $idCustomerFilter;
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
        $idCustomer = $this->idCustomerFilter->filter($filterFieldTransfers);
        $foreignCustomerReference = $this->foreignCustomerReferenceFilter->filter($filterFieldTransfers);

        if ($foreignCustomerReference === null || $idCustomer === null) {
            return $queryJoinCollectionTransfer;
        }

        $canSeeProductListsOfCustomer = $this->repository->canSeeProductListsOfCustomer(
            $idCustomer,
            $foreignCustomerReference,
        );

        $queryWhereConditionTransfer = (new QueryWhereConditionTransfer())
            ->setColumn(SpyCustomerTableMap::COL_CUSTOMER_REFERENCE)
            ->setComparison(Criteria::EQUAL)
            ->setValue($foreignCustomerReference);

        if ($canSeeProductListsOfCustomer !== true) {
            $queryWhereConditionTransfer = $queryWhereConditionTransfer->setColumn(SpyCustomerTableMap::COL_ID_CUSTOMER)
                ->setValue('-1');
        }

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyProductListTableMap::COL_ID_PRODUCT_LIST])
                ->setRight([SpyProductListCustomerTableMap::COL_FK_PRODUCT_LIST]),
        )->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyProductListCustomerTableMap::COL_FK_CUSTOMER])
                ->setRight([SpyCustomerTableMap::COL_ID_CUSTOMER])
                ->addQueryWhereCondition($queryWhereConditionTransfer),
        );
    }
}
