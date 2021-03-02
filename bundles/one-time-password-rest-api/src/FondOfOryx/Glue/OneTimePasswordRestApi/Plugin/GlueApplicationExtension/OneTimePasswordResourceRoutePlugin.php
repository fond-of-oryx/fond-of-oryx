<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiConfig;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class OneTimePasswordResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addPost('post', false);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return OneTimePasswordRestApiConfig::RESOURCE_ONE_TIME_PASSWORD;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return OneTimePasswordRestApiConfig::CONTROLLER_ONE_TIME_PASSWORD;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestOneTimePasswordRequestAttributesTransfer::class;
    }
}
