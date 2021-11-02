<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business;

use FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculator;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculatorInterface;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReader;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\VariableExtractor;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\VariableExtractorInterface;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGenerator;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceInterface;
use FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateDependencyProvider;
use FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface;
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
            $this->getConfig(),
            $this->getUtilMathFormulaService(),
            $this->createVariableExtractor(),
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
            $this->getStoreFacade(),
            $this->getPriceToPayFilterPlugin(),
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

    /**
     * @return \FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceInterface
     */
    protected function getUtilMathFormulaService(): ShipmentTableRateToUtilMathFormulaServiceInterface
    {
        return $this->getProvidedDependency(ShipmentTableRateDependencyProvider::SERVICE_UTIL_MATH_FORMULA);
    }

    /**
     * @return \FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface
     */
    protected function getPriceToPayFilterPlugin(): PriceToPayFilterPluginInterface
    {
        return $this->getProvidedDependency(ShipmentTableRateDependencyProvider::PLUGIN_PRICE_TO_PAY_FILTER);
    }

    /**
     * @return \FondOfOryx\Zed\ShipmentTableRate\Business\Model\VariableExtractorInterface
     */
    protected function createVariableExtractor(): VariableExtractorInterface
    {
        return new VariableExtractor();
    }
}
