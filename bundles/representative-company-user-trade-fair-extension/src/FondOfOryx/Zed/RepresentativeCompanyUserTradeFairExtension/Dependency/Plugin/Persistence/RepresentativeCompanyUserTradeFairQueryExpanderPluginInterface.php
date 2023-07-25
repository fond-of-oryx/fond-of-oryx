<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairExtension\Dependency\Plugin\Persistence;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFairQuery;

interface RepresentativeCompanyUserTradeFairQueryExpanderPluginInterface
{
    /**
     * @param \Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFairQuery $query
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFairQuery
     */
    public function expand(
        FooRepresentativeCompanyUserTradeFairQuery $query,
        RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
    ): FooRepresentativeCompanyUserTradeFairQuery;
}
