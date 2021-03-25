<?php

namespace FondOfOryx\Zed\ReturnLabel;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelDependencyProvider extends AbstractBundleDependencyProvider
{
    public const COMPANY_UNIT_ADDRESS_QUERY_CONTAINER = 'COMPANY_UNIT_ADDRESS_QUERY_CONTAINER';

    /**
     * @param Container $container
     *
     * @return Container
     *
     * @throws \Spryker\Service\Container\Exception\FrozenServiceException
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = $this->getCompanyUnitAddressQueryContainer($container);

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     *
     * @throws \Spryker\Service\Container\Exception\FrozenServiceException
     */
    protected function getCompanyUnitAddressQueryContainer(Container $container): Container
    {
        $container->set(static::COMPANY_UNIT_ADDRESS_QUERY_CONTAINER, static function(Container $container) {
            return new ReturnLabelToCompanyUnitAddressQueryContainerBridge(
                $container->getLocator()->companyUnitAddress->queryContainer
            );
        });

        return $container;
    }
}
