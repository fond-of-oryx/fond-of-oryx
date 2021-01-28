<?php
namespace FondOfOryx\Client\ErpOrderPageSearch;

use FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStub;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Session\SessionClientInterface;

/**
 * Class ErpOrderPageSearchFactory
 *
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 *
 * @package FondOfOryx\Client\ErpOrderPageSearch
 */
class ErpOrderPageSearchFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ErpOrderPageSearch\Zed\ErpOrderPageSearchStubInterface
     */
    public function createZedStub()
    {
        return new ErpOrderPageSearchStub($this->getZedRequestClient());
    }

    /**
     * @return mixed
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getZedRequestClient()
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    protected function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::CLIENT_SESSION);
    }
}
