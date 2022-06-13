<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business;

use FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutor;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutorInterface;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager\ProportionalGiftCardValueManager;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager\ProportionalGiftCardValueManagerInterface;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Validator\HasRedeemedGiftCardValidator;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Validator\HasRedeemedGiftCardValidatorInterface;
use FondOfOryx\Zed\GiftCardProportionalValue\GiftCardProportionalValueDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepositoryInterface getRepository()
 */
class GiftCardProportionalValueBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValue\Business\Validator\HasRedeemedGiftCardValidatorInterface
     */
    public function createHasRedeemedGiftCardValidator(): HasRedeemedGiftCardValidatorInterface
    {
        return new HasRedeemedGiftCardValidator();
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager\ProportionalGiftCardValueManagerInterface
     */
    public function createManager(): ProportionalGiftCardValueManagerInterface
    {
        return new ProportionalGiftCardValueManager($this->getEntityManager(), $this->createProportionalValueCalculatorPluginExecutor());
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutorInterface
     */
    public function createProportionalValueCalculatorPluginExecutor(): ProportionalValueCalculatorPluginExecutorInterface
    {
        return new ProportionalValueCalculatorPluginExecutor($this->getProportionalValueCalulationPlugins());
    }

    /**
     * @return array<\FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface>
     */
    protected function getProportionalValueCalulationPlugins(): array
    {
        return $this->getProvidedDependency(GiftCardProportionalValueDependencyProvider::PLUGINS_PROPORTIONAL_VALUE_CALCULATION);
    }
}
