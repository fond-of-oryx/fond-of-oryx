<?php

namespace FondOfOryx\Zed\Invoice\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceAddressWriter;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceItemsWriter;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceReferenceGenerator;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceWriter;
use FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToSequenceNumberFacadeBridge;
use FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToStoreFacadeBridge;
use FondOfOryx\Zed\Invoice\InvoiceConfig;
use FondOfOryx\Zed\Invoice\InvoiceDependencyProvider;
use FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManager;
use FondOfOryx\Zed\Invoice\Persistence\InvoiceRepository;
use Spryker\Zed\Kernel\Container;

class InvoiceBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\Invoice\Business\InvoiceBusinessFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\InvoiceConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManager
     */
    protected $entityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Persistence\InvoiceRepository
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToSequenceNumberFacadeBridge
     */
    protected $sequenceNumberFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToStoreFacadeBridge
     */
    protected $storeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(InvoiceConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(InvoiceEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(InvoiceRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sequenceNumberFacadeMock = $this->getMockBuilder(InvoiceToSequenceNumberFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(InvoiceToStoreFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new InvoiceBusinessFactory();
        $this->factory->setConfig($this->configMock);
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateInvoiceWriter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([InvoiceDependencyProvider::PLUGINS_PRE_SAVE], [InvoiceDependencyProvider::PLUGINS_POST_SAVE])
            ->willReturnOnConsecutiveCalls([], []);

        static::assertInstanceOf(InvoiceWriter::class, $this->factory->createInvoiceWriter());
    }

    /**
     * @return void
     */
    public function testCreateInvoiceAddressWriter(): void
    {
        static::assertInstanceOf(InvoiceAddressWriter::class, $this->factory->createInvoiceAddressWriter());
    }

    /**
     * @return void
     */
    public function testCreateInvoiceItemsWriter(): void
    {
        static::assertInstanceOf(InvoiceItemsWriter::class, $this->factory->createInvoiceItemsWriter());
    }

    /**
     * @return void
     */
    public function testCreateInvoiceReferenceGenerator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([InvoiceDependencyProvider::FACADE_SEQUENCE_NUMBER], [InvoiceDependencyProvider::FACADE_STORE])
            ->willReturnOnConsecutiveCalls($this->sequenceNumberFacadeMock, $this->storeFacadeMock);

        static::assertInstanceOf(InvoiceReferenceGenerator::class, $this->factory->createInvoiceReferenceGenerator());
    }
}
