<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReader;
use FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReaderInterface;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToSplittableQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableTotals\SplittableTotalsDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableTotalsBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReaderInterface
     */
    public function createSplittableTotalsReader(): SplittableTotalsReaderInterface
    {
        return new SplittableTotalsReader($this->getSplittableQuoteFacade());
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToSplittableQuoteFacadeInterface
     */
    protected function getSplittableQuoteFacade(): SplittableTotalsToSplittableQuoteFacadeInterface
    {
        return $this->getProvidedDependency(SplittableTotalsDependencyProvider::FACADE_SPLITTABLE_QUOTE);
    }
}
