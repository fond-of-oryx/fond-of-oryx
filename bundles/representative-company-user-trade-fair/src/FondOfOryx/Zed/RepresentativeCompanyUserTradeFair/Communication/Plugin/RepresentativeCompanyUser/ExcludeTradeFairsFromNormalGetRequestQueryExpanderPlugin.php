<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Communication\Plugin\RepresentativeCompanyUser;

use FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\Persistence\RepresentativeCompanyUserQueryExpanderPluginInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class ExcludeTradeFairsFromNormalGetRequestQueryExpanderPlugin implements RepresentativeCompanyUserQueryExpanderPluginInterface
{
    /**
     * @param \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery
     */
    public function expand(FooRepresentativeCompanyUserQuery $query, RepresentativeCompanyUserFilterTransfer $filterTransfer): FooRepresentativeCompanyUserQuery
    {
        return $query->filterByFkRepresentativeCompanyUserTradeFair(null, Criteria::ISNULL);
    }
}
