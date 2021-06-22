<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CreditMemo\CreditMemoConstants;
use FondOfOryx\Zed\CreditMemo\CreditMemoConfig;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToSequenceNumberFacadeBridge;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeBridge;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class CreditMemoReferenceGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToSequenceNumberFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sequenceNumberFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\CreditMemoConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoReferenceGeneratorInterface
     */
    protected $model;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->sequenceNumberFacadeMock = $this->getMockBuilder(CreditMemoToSequenceNumberFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->storeFacadeMock = $this->getMockBuilder(CreditMemoToStoreFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(CreditMemoConfig::class)->disableOriginalConstructor()->getMock();
        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)->disableOriginalConstructor()->getMock();

        $this->model = new CreditMemoReferenceGenerator($this->sequenceNumberFacadeMock, $this->storeFacadeMock, $this->configMock);
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->sequenceNumberFacadeMock->expects(static::once())->method('generate')->willReturnCallback(static function (SequenceNumberSettingsTransfer $check) {
            static::assertSame($check->getName(), CreditMemoConstants::REFERENCE_NAME_VALUE);
            static::assertSame($check->getPrefix(), 'RefPrefix-');

            return 'test';
        });
        $this->configMock->expects(static::once())->method('getReferenceOffset')->willReturn(null);
        $this->configMock->expects(static::once())->method('getReferencePrefix')->willReturn('RefPrefix');
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->storeTransferMock->expects(static::once())->method('getName')->willReturn('TestStore');

        $this->model->generate();
    }

    /**
     * @return void
     */
    public function testGenerateWithOffset(): void
    {
        $this->sequenceNumberFacadeMock->expects(static::once())->method('generate')->willReturnCallback(static function (SequenceNumberSettingsTransfer $check) {
            static::assertSame($check->getName(), CreditMemoConstants::REFERENCE_NAME_VALUE);
            static::assertSame($check->getPrefix(), 'RefPrefix-');

            return 'test';
        });
        $this->configMock->expects(static::exactly(2))->method('getReferenceOffset')->willReturn(100);
        $this->configMock->expects(static::once())->method('getReferencePrefix')->willReturn('RefPrefix');
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->storeTransferMock->expects(static::once())->method('getName')->willReturn('TestStore');

        $this->model->generate();
    }

    /**
     * @return void
     */
    public function testGenerateWithOffsetWithEnvPrefix(): void
    {
        $this->sequenceNumberFacadeMock->expects(static::once())->method('generate')->willReturnCallback(static function (SequenceNumberSettingsTransfer $check) {
            static::assertSame($check->getName(), CreditMemoConstants::REFERENCE_NAME_VALUE);
            static::assertSame($check->getPrefix(), 'RefPrefix-EnvPrefix-');

            return 'test';
        });
        $this->configMock->expects(static::exactly(2))->method('getReferenceOffset')->willReturn(100);
        $this->configMock->expects(static::once())->method('getReferencePrefix')->willReturn('RefPrefix');
        $this->configMock->expects(static::once())->method('getReferenceEnvironmentPrefix')->willReturn('EnvPrefix');
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->storeTransferMock->expects(static::once())->method('getName')->willReturn('TestStore');

        $this->model->generate();
    }
}
