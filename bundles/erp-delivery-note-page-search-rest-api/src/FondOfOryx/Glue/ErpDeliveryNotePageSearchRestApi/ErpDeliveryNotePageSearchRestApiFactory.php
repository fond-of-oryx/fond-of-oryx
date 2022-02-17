<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi;

use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\ErpDeliveryNoteMapper;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\ErpDeliveryNoteMapperInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader\ErpDeliveryNotePageSearchReader;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader\ErpDeliveryNotePageSearchReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ErpDeliveryNotePageSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader\ErpDeliveryNotePageSearchReaderInterface
     */
    public function createErpDeliveryNoteReader(): ErpDeliveryNotePageSearchReaderInterface
    {
        return new ErpDeliveryNotePageSearchReader(
            $this->getErpDeliveryNotePageSearchClient(),
            $this->createRequestBuilder(),
            $this->createErpDeliveryNoteMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\ErpDeliveryNoteMapperInterface
     */
    protected function createErpDeliveryNoteMapper(): ErpDeliveryNoteMapperInterface
    {
        return new ErpDeliveryNoteMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected function createRequestBuilder(): RequestBuilderInterface
    {
        return new RequestBuilder();
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface
     */
    protected function getErpDeliveryNotePageSearchClient(): ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchRestApiDependencyProvider::CLIENT_ERP_DELIVERY_NOTE_PAGE_SEARCH);
    }
}
