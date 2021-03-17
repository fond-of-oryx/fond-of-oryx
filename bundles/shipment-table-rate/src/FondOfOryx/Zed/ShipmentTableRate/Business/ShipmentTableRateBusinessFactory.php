<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business;

use FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculator;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculatorInterface;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReader;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGenerator;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig getConfig()
 */
class ShipmentTableRateBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculatorInterface
     */
    public function createPriceCalculator(): PriceCalculatorInterface
    {
        return new PriceCalculator(
            $this->createShipmentTableRateReader(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface
     */
    protected function createShipmentTableRateReader(): ShipmentTableRateReaderInterface
    {
        return new ShipmentTableRateReader(
            $this->createZipCodePatternsGenerator(),
            $this->getRepository(),
            $this->getCountryFacade(),
            $this->getStoreFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface
     */
    protected function createZipCodePatternsGenerator(): ZipCodePatternsGeneratorInterface
    {
        return new ZipCodePatternsGenerator();
    }

    /**
     * @return \FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface
     */
    protected function getCountryFacade(): ShipmentTableRateToCountryFacadeInterface
    {
        return $this->getProvidedDependency(ShipmentTableRateDependencyProvider::FACADE_COUNTRY);
    }

    /**
     * @return \FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface
     */
    protected function getStoreFacade(): ShipmentTableRateToStoreFacadeInterface
    {
        return $this->getProvidedDependency(ShipmentTableRateDependencyProvider::FACADE_STORE);
    }
}
