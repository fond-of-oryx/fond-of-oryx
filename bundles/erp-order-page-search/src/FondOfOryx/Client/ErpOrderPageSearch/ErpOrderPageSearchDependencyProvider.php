<?php
namespace FondOfOryx\Client\ErpOrderPageSearch;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

/**
 * Class ErpOrderPageSearchDependencyProvider
 *
 * @package FondOfOryx\Client\ErpOrderPageSearch
 */
class ErpOrderPageSearchDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';

    public const CLIENT_SESSION = 'CLIENT_SESSION';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $this->addZedRequestClient($container);
        $this->addSessionClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    protected function addZedRequestClient(Container $container): void
    {
        $container[static::CLIENT_ZED_REQUEST] = static function (Container $container) {
            return $container->getLocator()->zedRequest()->client();
        };
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    private function addSessionClient(Container $container): void
    {
        $container[static::CLIENT_SESSION] = static function (Container $container) {
            return $container->getLocator()->session()->client();
        };
    }
}
