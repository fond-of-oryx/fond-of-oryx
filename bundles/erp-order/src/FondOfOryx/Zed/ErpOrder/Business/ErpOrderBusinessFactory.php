<?php

namespace FondOfOryx\Zed\ErpOrder\Business;

use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderAddressHandler;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderAddressHandlerInterface;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderExpenseAmountHandler;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderExpenseAmountHandlerInterface;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderExpenseHandler;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderExpenseHandlerInterface;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderItemAmountHandler;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderItemAmountHandlerInterface;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderItemHandler;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderItemHandlerInterface;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderTotalsHandler;
use FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderTotalsHandlerInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderAddressReader;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderAddressReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderExpenseReader;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderExpenseReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderItemReader;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderItemReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderReader;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalsReader;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalsReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAddressWriter;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAddressWriterInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAmountWriter;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAmountWriterInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderExpenseWriter;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderExpenseWriterInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriter;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriterInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriter;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriterInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderWriter;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderWriterInterface;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAddressPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAddressPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAmountPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAmountPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderExpensePluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderExpensePluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\ErpOrderDependencyProvider;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface getRepository()()
 */
class ErpOrderBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderWriterInterface
     */
    public function createErpOrderWriter(): ErpOrderWriterInterface
    {
        return new ErpOrderWriter(
            $this->getEntityManager(),
            $this->createErpOrderPluginExecutor(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAddressWriterInterface
     */
    public function createErpOrderAddressWriter(): ErpOrderAddressWriterInterface
    {
        return new ErpOrderAddressWriter(
            $this->getEntityManager(),
            $this->createErpOrderAddressPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriterInterface
     */
    public function createErpOrderItemWriter(): ErpOrderItemWriterInterface
    {
        return new ErpOrderItemWriter(
            $this->getEntityManager(),
            $this->createErpOrderItemPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderAddressHandlerInterface
     */
    public function createErpOrderAddressHandler(): ErpOrderAddressHandlerInterface
    {
        return new ErpOrderAddressHandler(
            $this->createErpOrderAddressWriter(),
            $this->createErpOrderAddressReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderItemHandlerInterface
     */
    public function createErpOrderItemHandler(): ErpOrderItemHandlerInterface
    {
        return new ErpOrderItemHandler(
            $this->createErpOrderItemWriter(),
            $this->createErpOrderItemReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ReaderInterface
     */
    public function createErpOrderReader(): ReaderInterface
    {
        return new ErpOrderReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderItemReaderInterface
     */
    public function createErpOrderItemReader(): ErpOrderItemReaderInterface
    {
        return new ErpOrderItemReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderAddressReaderInterface
     */
    public function createErpOrderAddressReader(): ErpOrderAddressReaderInterface
    {
        return new ErpOrderAddressReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderExpenseWriterInterface
     */
    public function createErpOrderExpenseWriter(): ErpOrderExpenseWriterInterface
    {
        return new ErpOrderExpenseWriter(
            $this->getEntityManager(),
            $this->createErpOrderExpensePluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAmountWriterInterface
     */
    public function createErpOrderAmountWriter(): ErpOrderAmountWriterInterface
    {
        return new ErpOrderAmountWriter(
            $this->getEntityManager(),
            $this->createErpOrderAmountPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderExpenseHandlerInterface
     */
    public function createErpOrderExpenseHandler(): ErpOrderExpenseHandlerInterface
    {
        return new ErpOrderExpenseHandler(
            $this->createErpOrderExpenseWriter(),
            $this->createErpOrderExpenseReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderItemAmountHandlerInterface
     */
    public function createErpOrderItemAmountHandler(): ErpOrderItemAmountHandlerInterface
    {
        return new ErpOrderItemAmountHandler(
            $this->createErpOrderAmountWriter(),
            $this->createErpOrderReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderExpenseAmountHandlerInterface
     */
    public function createErpOrderExpenseAmountHandler(): ErpOrderExpenseAmountHandlerInterface
    {
        return new ErpOrderExpenseAmountHandler(
            $this->createErpOrderAmountWriter(),
            $this->createErpOrderReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderExpenseReaderInterface
     */
    public function createErpOrderExpenseReader(): ErpOrderExpenseReaderInterface
    {
        return new ErpOrderExpenseReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderExpensePluginExecutorInterface
     */
    protected function createErpOrderExpensePluginExecutor(): ErpOrderExpensePluginExecutorInterface
    {
        return new ErpOrderExpensePluginExecutor(
            $this->getErpOrderExpensePreSavePlugin(),
            $this->getErpOrderExpensePostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAmountPluginExecutorInterface
     */
    protected function createErpOrderAmountPluginExecutor(): ErpOrderAmountPluginExecutorInterface
    {
        return new ErpOrderAmountPluginExecutor(
            $this->getErpOrderAmountPreSavePlugin(),
            $this->getErpOrderAmountPostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutorInterface
     */
    protected function createErpOrderPluginExecutor(): ErpOrderPluginExecutorInterface
    {
        return new ErpOrderPluginExecutor(
            $this->getErpOrderPreSavePlugin(),
            $this->getErpOrderPostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface
     */
    protected function createErpOrderItemPluginExecutor(): ErpOrderItemPluginExecutorInterface
    {
        return new ErpOrderItemPluginExecutor(
            $this->getErpOrderItemPreSavePlugin(),
            $this->getErpOrderItemPostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAddressPluginExecutorInterface
     */
    protected function createErpOrderAddressPluginExecutor(): ErpOrderAddressPluginExecutorInterface
    {
        return new ErpOrderAddressPluginExecutor(
            $this->getErpOrderAddressPreSavePlugin(),
            $this->getErpOrderAddressPostSavePlugin(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface>
     */
    public function getErpOrderPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface>
     */
    public function getErpOrderPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface>
     */
    public function getErpOrderItemPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_ITEM_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPostSavePluginInterface>
     */
    public function getErpOrderItemPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_ITEM_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPreSavePluginInterface>
     */
    public function getErpOrderAddressPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_ADDRESS_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPostSavePluginInterface>
     */
    public function getErpOrderAddressPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_ADDRESS_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderTotalsHandlerInterface
     */
    public function createErpOrderTotalsHandler(): ErpOrderTotalsHandlerInterface
    {
        return new ErpOrderTotalsHandler(
            $this->createErpOrderTotalsReader(),
            $this->createErpOrderTotalsWriter(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalsReaderInterface
     */
    protected function createErpOrderTotalsReader(): ErpOrderTotalsReaderInterface
    {
        return new ErpOrderTotalsReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriterInterface
     */
    protected function createErpOrderTotalsWriter(): ErpOrderTotalsWriterInterface
    {
        return new ErpOrderTotalsWriter(
            $this->getEntityManager(),
            $this->createErpOrderTotalsPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutorInterface
     */
    protected function createErpOrderTotalsPluginExecutor(): ErpOrderTotalsPluginExecutorInterface
    {
        return new ErpOrderTotalsPluginExecutor(
            $this->getErpOrderTotalsPreSavePlugins(),
            $this->getErpOrderTotalsPostSavePlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPreSavePluginInterface>
     */
    protected function getErpOrderTotalsPreSavePlugins(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_TOTALS_PRE_SAVE);
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPostSavePluginInterface>
     */
    protected function getErpOrderTotalsPostSavePlugins(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_TOTALS_POST_SAVE);
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderExpensePreSavePluginInterface>
     */
    public function getErpOrderExpensePreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_EXPENSE_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderExpensePostSavePluginInterface>
     */
    public function getErpOrderExpensePostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_EXPENSE_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAmountPreSavePluginInterface>
     */
    public function getErpOrderAmountPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_AMOUNT_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAmountPostSavePluginInterface>
     */
    public function getErpOrderAmountPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::PLUGIN_ERP_ORDER_AMOUNT_POST_SAVE)->getArrayCopy();
    }
}
