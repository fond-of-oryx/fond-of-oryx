<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi;

use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiRestApiToCompanyAddressApiFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const COMPANY_UNIT_ADDRESS_API_FACADE = 'COMPANY_UNIT_ADDRESS_API_FACADE';

    /**
     * @param Container $container
     *
     * @return Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->getCompanyUnitAddressApiFacade($container);

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     *
     * @throws \Spryker\Service\Container\Exception\FrozenServiceException
     */
    public function getCompanyUnitAddressApiFacade(Container $container): Container
    {
        $container->set(static::COMPANY_UNIT_ADDRESS_API_FACADE, static function (Container $container) {
            return new ReturnLabelsRestApiRestApiToCompanyAddressApiFacadeBridge(
                $container->getLocator()->companyUnitAddressApi()->facade()
            );
        });

        return $container;
    }
}
