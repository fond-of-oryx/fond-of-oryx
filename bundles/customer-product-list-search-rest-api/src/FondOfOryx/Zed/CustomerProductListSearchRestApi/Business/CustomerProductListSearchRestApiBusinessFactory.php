<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business;

use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Expander\SearchProductListQueryExpander;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Filter\IdCustomerFilter;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader\ProductListReader;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\CustomerProductListSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence\CustomerProductListSearchRestApiRepositoryInterface getRepository()
 */
class CustomerProductListSearchRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface
     */
    public function createSearchProductListQueryExpander(): SearchProductListQueryExpanderInterface
    {
        return new SearchProductListQueryExpander(
            $this->createProductListReader(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader\ProductListReaderInterface
     */
    protected function createProductListReader(): ProductListReaderInterface
    {
        return new ProductListReader(
            $this->createIdCustomerFilter(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Filter\IdCustomerFilter
     */
    protected function createIdCustomerFilter(): IdCustomerFilter
    {
        return new IdCustomerFilter();
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): CustomerProductListSearchRestApiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(CustomerProductListSearchRestApiDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
