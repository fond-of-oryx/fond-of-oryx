<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business;

use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Handler\ThirtyFiveUpOrderHandler;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Handler\ThirtyFiveUpOrderHandlerInterface;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapper;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapperInterface;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Reader\ThirtyFiveUpReader;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Reader\ThirtyFiveUpReaderInterface;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriter;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriterInterface;
use FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeInterface;
use FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToStoreFacadeInterface;
use FondOfOryx\Zed\ThirtyFiveUp\ThirtyFiveUpDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * Class ThirtyFiveUpBusinessFactory
 *
 * @package FondOfOryx\Zed\ThirtyFiveUp\Business
 *
 * @method \FondOfOryx\Zed\ThirtyFiveUp\ThirtyFiveUpConfig getConfig()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface getEntityManager()()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface getRepository()
 */
class ThirtyFiveUpBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Handler\ThirtyFiveUpOrderHandlerInterface
     */
    public function createThirtyFiveUpOrderHandler(): ThirtyFiveUpOrderHandlerInterface
    {
        return new ThirtyFiveUpOrderHandler(
            $this->createThirtyFiveUpOrderMapper(),
            $this->createThirtyFiveUpOrderWriter()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapperInterface
     */
    public function createThirtyFiveUpOrderMapper(): ThirtyFiveUpOrderMapperInterface
    {
        return new ThirtyFiveUpOrderMapper($this->getConfig(), $this->getLocaleFacade(), $this->getRepository(), $this->getStoreFacade());
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriterInterface
     */
    public function createThirtyFiveUpOrderWriter(): ThirtyFiveUpOrderWriterInterface
    {
        return new ThirtyFiveUpOrderWriter($this->getEntityManager());
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Reader\ThirtyFiveUpReaderInterface
     */
    public function createThirtyFiveUpReader(): ThirtyFiveUpReaderInterface
    {
        return new ThirtyFiveUpReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeInterface
     */
    public function getLocaleFacade(): ThirtyFiveUpToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToStoreFacadeInterface
     */
    public function getStoreFacade(): ThirtyFiveUpToStoreFacadeInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpDependencyProvider::FACADE_STORE);
    }
}
