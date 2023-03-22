<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence;

use Orm\Zed\CompanyUserArchive\Persistence\FooCompanyUserArchiveQuery;

class CompanyDeleterCompanyUserArchiveConnectorPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUserArchive\Persistence\FooCompanyUserArchiveQuery
     */
    public function createFooCompanyUserArchiveQuery(): FooCompanyUserArchiveQuery
    {
        return FooCompanyUserArchiveQuery::create();
    }
}
