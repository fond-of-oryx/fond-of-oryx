<?php

namespace FondOfOryx\Glue\GlueApplicationAcl\Plugin\GlueApplicationExtension;

use Spryker\Glue\GlueApplication\Rest\Collection\ResourceRouteCollection;
use Spryker\Glue\GlueApplication\Rest\RequestConstantsInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RouterParameterExpanderPluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Glue\GlueApplicationAcl\GlueApplicationAclConfig getConfig()
 */
class AclRouterParameterExpanderPlugin extends AbstractPlugin implements RouterParameterExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface $resourceRoutePlugin
     * @param array<mixed> $resourceConfiguration
     *
     * @return array<mixed>
     */
    public function expandResourceConfiguration(ResourceRoutePluginInterface $resourceRoutePlugin, array $resourceConfiguration): array
    {
        $unprotectedResourceTypes = $this->getConfig()->getUnprotectedResourceTypes();

        $currentResourceType = $resourceConfiguration[RequestConstantsInterface::ATTRIBUTE_TYPE];
        $currentControllerAction = $resourceConfiguration[RequestConstantsInterface::ATTRIBUTE_CONFIGURATION][ResourceRouteCollection::CONTROLLER_ACTION];

        //Check if resource is unprotected
        $isUnProtected = in_array($currentResourceType, array_keys($unprotectedResourceTypes));

        //Check if controller action config exists, if not return explicit isProtected = true. Safety first!
        if (!array_key_exists($currentResourceType, $unprotectedResourceTypes)) {
            $isUnProtected = false;
        }

        //Check if action is protected, skip if resource is not configured
        if ($isUnProtected && isset($unprotectedResourceTypes[$currentResourceType])) {
            $isUnProtected = in_array($currentControllerAction, $unprotectedResourceTypes[$currentResourceType]);
        }

        $resourceConfiguration[RequestConstantsInterface::ATTRIBUTE_CONFIGURATION][ResourceRouteCollection::IS_PROTECTED] = !$isUnProtected;

        return $resourceConfiguration;
    }

    /**
     * @param array<mixed> $resourceConfiguration
     * @param array<mixed> $routeParams
     *
     * @return array<mixed>
     */
    public function expandRouteParameters(array $resourceConfiguration, array $routeParams): array
    {
        return $routeParams;
    }
}
