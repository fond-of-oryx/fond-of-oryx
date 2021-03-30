<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToCompanyUserReferenceClientBridge;

class ReturnLabelsRestApiDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';
    public const CLIENT_COMPANY_USER_REFERENCE_CLIENT = 'CLIENT_COMPANY_USER_REFERENCE_CLIENT';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addZedRequestClient($container);
        $container = $this->addCompanyUserReferenceClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addZedRequestClient(Container $container): Container
    {
        $container[static::CLIENT_ZED_REQUEST] = static function (Container $container) {
            return new ReturnLabelsRestApiToZedRequestClientBridge(
                $container->getLocator()->zedRequest()->client()
            );
        };

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    protected function addCompanyUserReferenceClient(Container $container): Container
    {
        $container->set(static::CLIENT_COMPANY_USER_REFERENCE_CLIENT, static function (Container $container) {
            return new ReturnLabelsRestApiToCompanyUserReferenceClientBridge(
                $container->getLocator()->companyUserReference()->client()
            );
        });

        return $container;
    }
}
