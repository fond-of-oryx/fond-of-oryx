<?php

namespace FondOfOryx\Zed\CompanyApi\Persistence;

use Orm\Zed\Company\Persistence\SpyCompanyQuery;

interface CompanyApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery
     */
    public function queryFind(): SpyCompanyQuery;
}
