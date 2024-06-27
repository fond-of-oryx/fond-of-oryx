<?php

namespace FondOfOryx\Glue\DocumentsRestApi;

use FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class DocumentsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_EASY_API = 'CLIENT_EASY_API';

    /**
     * @var string
     */
    public const PLUGINS_DOCUMENT_REST_REQUEST_EXPANDER = 'PLUGINS_DOCUMENT_REST_REQUEST_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_DOCUMENT_TYPE = 'PLUGINS_DOCUMENT_TYPE';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addDocumentRestRequestExpanderPlugins($container);
        $container = $this->addDocumentTypePlugins($container);

        return $this->addEasyApi($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addEasyApi(Container $container): Container
    {
        $container[static::CLIENT_EASY_API] = static fn (
            Container $container
        ) => new DocumentsRestApiToEasyApiBridge(
            $container->getLocator()->easyApi()->client(),
        );

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addDocumentRestRequestExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_DOCUMENT_REST_REQUEST_EXPANDER] = static function () use ($self) {
            return $self->getDocumentRestRequestExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface>
     */
    protected function getDocumentRestRequestExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addDocumentTypePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_DOCUMENT_TYPE] = static function () use ($self) {
            return $self->getDocumentTypePlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface>
     */
    protected function getDocumentTypePlugins(): array
    {
        return [];
    }
}
