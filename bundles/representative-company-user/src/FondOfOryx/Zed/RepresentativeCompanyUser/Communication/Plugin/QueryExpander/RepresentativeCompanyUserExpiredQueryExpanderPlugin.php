<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\QueryExpander;

use FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\Persistence\RepresentativeCompanyUserQueryExpanderPluginInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;
use Propel\Runtime\ActiveQuery\Criteria;

class RepresentativeCompanyUserExpiredQueryExpanderPlugin implements RepresentativeCompanyUserQueryExpanderPluginInterface
{
    /**
     * @param \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery
     */
    public function expand(FooRepresentativeCompanyUserQuery $query, RepresentativeCompanyUserFilterTransfer $filterTransfer): FooRepresentativeCompanyUserQuery
    {
        $expired = $filterTransfer->getExpired();
        if ($expired === null) {
            return $query;
        }

        $criteria = $expired === true ? Criteria::EQUAL : Criteria::NOT_EQUAL;

        return $query->filterByState(FooRepresentativeCompanyUserTableMap::COL_STATE_EXPIRED, $criteria);
    }
}
