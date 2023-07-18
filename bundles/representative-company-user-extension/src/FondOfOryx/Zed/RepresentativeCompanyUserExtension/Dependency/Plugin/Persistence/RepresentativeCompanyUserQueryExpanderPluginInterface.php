<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\Persistence;

use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;

interface RepresentativeCompanyUserQueryExpanderPluginInterface
{
    /**
     * @param \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery
     */
    public function expand(
        FooRepresentativeCompanyUserQuery $query,
        RepresentativeCompanyUserFilterTransfer $filterTransfer
    ): FooRepresentativeCompanyUserQuery;
}
