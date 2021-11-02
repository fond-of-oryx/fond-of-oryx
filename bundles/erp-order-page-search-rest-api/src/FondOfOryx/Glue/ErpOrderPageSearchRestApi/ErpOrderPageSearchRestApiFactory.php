<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\ErpOrderMapper;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\ErpOrderMapperInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReader;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ErpOrderPageSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReaderInterface
     */
    public function createErpOrderReader(): ErpOrderPageSearchReaderInterface
    {
        return new ErpOrderPageSearchReader(
            $this->getErpOrderPageSearchClient(),
            $this->createRequestBuilder(),
            $this->createErpOrderMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\ErpOrderMapperInterface
     */
    protected function createErpOrderMapper(): ErpOrderMapperInterface
    {
        return new ErpOrderMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected function createRequestBuilder(): RequestBuilderInterface
    {
        return new RequestBuilder();
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface
     */
    protected function getErpOrderPageSearchClient(): ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchRestApiDependencyProvider::CLIENT_ERP_ORDER_PAGE_SEARCH);
    }
}
