<?php

namespace FondOfOryx\Zed\CartCodeTypeDataImport\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

class CartCodeTypeDataImportFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CartCodeTypeDataImport\Business\CartCodeTypeDataImportBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartCodeTypeDataImportBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CartCodeTypeDataImport\Business\Model\CartCodeTypeWriterStep|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterConfigurationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterConfigurationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterReportTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterReportTransferMock;

    /**
     * @var \FondOfOryx\Zed\CartCodeTypeDataImport\Business\CartCodeTypeDataImportFacade
     */
    protected $cartCodeTypeDataImportFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->cartCodeTypeDataImportBusinessFactoryMock = $this->getMockBuilder(CartCodeTypeDataImportBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterMock = $this->getMockBuilder(DataImporterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterConfigurationTransferMock = $this->getMockBuilder(DataImporterConfigurationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterReportTransferMock = $this->getMockBuilder(DataImporterReportTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartCodeTypeDataImportFacade = new CartCodeTypeDataImportFacade();
        $this->cartCodeTypeDataImportFacade->setFactory($this->cartCodeTypeDataImportBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testImport(): void
    {
        $this->cartCodeTypeDataImportBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createCartCodeTypeDataImporter')
            ->willReturn($this->dataImporterMock);

        $this->dataImporterMock->expects(static::atLeastOnce())
            ->method('import')
            ->with($this->dataImporterConfigurationTransferMock)
            ->willReturn($this->dataImporterReportTransferMock);

        static::assertEquals(
            $this->dataImporterReportTransferMock,
            $this->cartCodeTypeDataImportFacade->import($this->dataImporterConfigurationTransferMock)
        );
    }
}
