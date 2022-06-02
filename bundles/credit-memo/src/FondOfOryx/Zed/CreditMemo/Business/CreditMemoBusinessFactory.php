<?php

namespace FondOfOryx\Zed\CreditMemo\Business;

use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoItemsWriter;
use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoItemsWriterInterface;
use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoPluginExecutor;
use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoPluginExecutorInterface;
use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoReader;
use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoReaderInterface;
use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoReferenceGenerator;
use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoReferenceGeneratorInterface;
use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoWriter;
use FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoWriterInterface;
use FondOfOryx\Zed\CreditMemo\Business\Processor\CreditMemoProcessor;
use FondOfOryx\Zed\CreditMemo\Business\Processor\CreditMemoProcessorInterface;
use FondOfOryx\Zed\CreditMemo\Business\Resolver\LocaleResolver;
use FondOfOryx\Zed\CreditMemo\Business\Resolver\PaymentMethodResolver;
use FondOfOryx\Zed\CreditMemo\Business\Resolver\ResolverInterface;
use FondOfOryx\Zed\CreditMemo\CreditMemoDependencyProvider;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToLocaleFacadeInterface;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToSequenceNumberFacadeInterface;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CreditMemo\CreditMemoConfig getConfig()
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManager getEntityManager()
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepository getRepository()
 */
class CreditMemoBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoWriterInterface
     */
    public function createCreditMemoWriter(): CreditMemoWriterInterface
    {
        return new CreditMemoWriter(
            $this->getEntityManager(),
            $this->createCreditMemoPluginExecutor(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoPluginExecutorInterface
     */
    protected function createCreditMemoPluginExecutor(): CreditMemoPluginExecutorInterface
    {
        return new CreditMemoPluginExecutor(
            $this->getCreditMemoPreSavePlugins(),
            $this->getCreditMemoPostSavePlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Business\Resolver\ResolverInterface
     */
    public function createCreditMemoPaymentResolver(): ResolverInterface
    {
        return new PaymentMethodResolver($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Business\Resolver\ResolverInterface
     */
    public function createCreditMemoLocaleResolver(): ResolverInterface
    {
        return new LocaleResolver($this->getLocaleFacade());
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoItemsWriterInterface
     */
    public function createCreditMemoItemsWriter(): CreditMemoItemsWriterInterface
    {
        return new CreditMemoItemsWriter($this->getEntityManager());
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoReferenceGeneratorInterface
     */
    public function createCreditMemoReferenceGenerator(): CreditMemoReferenceGeneratorInterface
    {
        return new CreditMemoReferenceGenerator(
            $this->getSequenceNumberFacade(),
            $this->getStoreFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoReaderInterface
     */
    public function createCreditMemoReader(): CreditMemoReaderInterface
    {
        return new CreditMemoReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Business\Processor\CreditMemoProcessorInterface
     */
    public function createCreditMemoProcessor(): CreditMemoProcessorInterface
    {
        return new CreditMemoProcessor(
            $this->getCreditMemoProcessorPlugins(),
            $this->getRepository(),
            $this->getStoreFacade(),
            $this->getConfig(),
            $this->getLogger(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface>
     */
    protected function getCreditMemoProcessorPlugins(): array
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::PLUGINS_PROCESSOR);
    }

    /**
     * @return array<\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPreSavePluginInterface>
     */
    protected function getCreditMemoPreSavePlugins(): array
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::PLUGINS_PRE_SAVE);
    }

    /**
     * @return array<\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPostSavePluginInterface>
     */
    protected function getCreditMemoPostSavePlugins(): array
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::PLUGINS_POST_SAVE);
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToSequenceNumberFacadeInterface
     */
    protected function getSequenceNumberFacade(): CreditMemoToSequenceNumberFacadeInterface
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::FACADE_SEQUENCE_NUMBER);
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface
     */
    protected function getStoreFacade(): CreditMemoToStoreFacadeInterface
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToLocaleFacadeInterface
     */
    protected function getLocaleFacade(): CreditMemoToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::FACADE_LOCALE);
    }
}
