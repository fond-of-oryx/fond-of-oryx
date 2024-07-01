<?php

namespace FondOfOryx\Glue\DocumentsRestApi;

use FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpander;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpanderInterface;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper\DocumentRestRequestMapper;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper\DocumentRestRequestMapperInterface;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Reader\DocumentReader;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Reader\DocumentReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;
use Spryker\Shared\Log\LoggerTrait;

/**
 * @method \FondOfOryx\Glue\DocumentsRestApi\DocumentsRestApiConfig getConfig()
 */
class DocumentsRestApiFactory extends AbstractFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Glue\DocumentsRestApi\Processor\Reader\DocumentReaderInterface
     */
    public function createDocumentReader(): DocumentReaderInterface
    {
        return new DocumentReader(
            $this->getEasyApi(),
            $this->createDocumentRestRequestMapper(),
            $this->createRestResponseBuilder(),
            $this->getLogger(),
            $this->getDocumentTypePlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\DocumentsRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    public function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper\DocumentRestRequestMapperInterface
     */
    public function createDocumentRestRequestMapper(): DocumentRestRequestMapperInterface
    {
        return new DocumentRestRequestMapper(
            $this->createDocumentRestRequestExpander(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpanderInterface
     */
    public function createDocumentRestRequestExpander(): DocumentRestRequestExpanderInterface
    {
        return new DocumentRestRequestExpander(
            $this->getDocumentRestRequestExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface
     */
    protected function getEasyApi(): DocumentsRestApiToEasyApiInterface
    {
        return $this->getProvidedDependency(DocumentsRestApiDependencyProvider::CLIENT_EASY_API);
    }

    /**
     * @return array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface>
     */
    protected function getDocumentRestRequestExpanderPlugins(): array
    {
        return $this->getProvidedDependency(DocumentsRestApiDependencyProvider::PLUGINS_DOCUMENT_REST_REQUEST_EXPANDER);
    }

    /**
     * @return array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface>
     */
    protected function getDocumentTypePlugins(): array
    {
        return $this->getProvidedDependency(DocumentsRestApiDependencyProvider::PLUGINS_DOCUMENT_TYPE);
    }
}
