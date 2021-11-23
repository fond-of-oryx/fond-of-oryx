<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi;

use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\ErpInvoiceMapper;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\ErpInvoiceMapperInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader\ErpInvoicePageSearchReader;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader\ErpInvoicePageSearchReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ErpInvoicePageSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader\ErpInvoicePageSearchReaderInterface
     */
    public function createErpInvoiceReader(): ErpInvoicePageSearchReaderInterface
    {
        return new ErpInvoicePageSearchReader(
            $this->getErpInvoicePageSearchClient(),
            $this->createRequestBuilder(),
            $this->createErpInvoiceMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\ErpInvoiceMapperInterface
     */
    protected function createErpInvoiceMapper(): ErpInvoiceMapperInterface
    {
        return new ErpInvoiceMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected function createRequestBuilder(): RequestBuilderInterface
    {
        return new RequestBuilder();
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface
     */
    protected function getErpInvoicePageSearchClient(): ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchRestApiDependencyProvider::CLIENT_ERP_INVOICE_PAGE_SEARCH);
    }
}
