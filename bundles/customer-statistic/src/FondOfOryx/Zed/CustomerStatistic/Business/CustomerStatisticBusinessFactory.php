<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business;

use FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerExpander;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerExpanderInterface;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReader;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReaderInterface;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticWriter;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticWriterInterface;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\LoginCountIncrementer;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\LoginCountIncrementerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepositoryInterface getRepository()
 */
class CustomerStatisticBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticWriterInterface
     */
    protected function createCustomerStatisticWriter(): CustomerStatisticWriterInterface
    {
        return new CustomerStatisticWriter(
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReaderInterface
     */
    protected function createCustomerStatisticReader(): CustomerStatisticReaderInterface
    {
        return new CustomerStatisticReader(
            $this->getRepository()
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerStatistic\Business\Model\LoginCountIncrementerInterface
     */
    public function createLoginCountIncrementer(): LoginCountIncrementerInterface
    {
        return new LoginCountIncrementer(
            $this->createCustomerStatisticReader(),
            $this->createCustomerStatisticWriter()
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerExpanderInterface
     */
    public function createCustomerExpander(): CustomerExpanderInterface
    {
        return new CustomerExpander(
            $this->createCustomerStatisticReader()
        );
    }
}
