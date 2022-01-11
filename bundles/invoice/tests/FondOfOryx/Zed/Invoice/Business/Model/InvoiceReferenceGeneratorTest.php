<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToSequenceNumberFacadeBridge;
use FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToStoreFacadeBridge;
use FondOfOryx\Zed\Invoice\InvoiceConfig;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class InvoiceReferenceGeneratorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToSequenceNumberFacadeBridge
     */
    protected $sequenceNumberFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToStoreFacadeBridge
     */
    protected $storeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\InvoiceConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SequenceNumberSettingsTransfer
     */
    protected $sequenceNumberSettingsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeTranferMock;

    /**
     * @var \FondOfOryx\Zed\Invoice\Business\Model\InvoiceReferenceGeneratorInterface
     */
    protected $invoiceReferenceGenerator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->sequenceNumberFacadeMock = $this->getMockBuilder(InvoiceToSequenceNumberFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(InvoiceToStoreFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(InvoiceConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTranferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sequenceNumberSettingsTransferMock = $this->getMockBuilder(SequenceNumberSettingsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceReferenceGenerator = new InvoiceReferenceGenerator($this->sequenceNumberFacadeMock, $this->storeFacadeMock, $this->configMock);
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->storeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTranferMock);

        $this->storeTranferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn('STORE_NAME');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getReferencePrefix')
            ->willReturn('REFERENCE_PREFIX');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getReferenceEnvironmentPrefix')
            ->willReturn('REFERENCE_ENVIRONMENT_PREFIX');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getReferenceOffset')
            ->willReturn(1);

        static::assertEquals('', $this->invoiceReferenceGenerator->generate());
    }
}
