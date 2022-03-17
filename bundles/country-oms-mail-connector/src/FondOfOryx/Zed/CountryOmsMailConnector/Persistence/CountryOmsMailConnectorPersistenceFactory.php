<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Persistence;

use FondOfOryx\Zed\CountryOmsMailConnector\CountryOmsMailConnectorDependencyProvider;
use FondOfOryx\Zed\CountryOmsMailConnector\Persistence\Propel\Mapper\CountryMapper;
use FondOfOryx\Zed\CountryOmsMailConnector\Persistence\Propel\Mapper\CountryMapperInterface;
use Orm\Zed\Country\Persistence\Base\SpyCountryQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepositoryInterface getRepository()
 */
class CountryOmsMailConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Country\Persistence\Base\SpyCountryQuery
     */
    public function getCountryQuery(): SpyCountryQuery
    {
        return $this->getProvidedDependency(CountryOmsMailConnectorDependencyProvider::PROPEL_QUERY_COUNTRY);
    }

    /**
     * @return \FondOfOryx\Zed\CountryOmsMailConnector\Persistence\Propel\Mapper\CountryMapperInterface
     */
    public function createCountryMapper(): CountryMapperInterface
    {
        return new CountryMapper();
    }
}
