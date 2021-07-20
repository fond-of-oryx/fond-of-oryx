<?php

namespace FondOfOryx\Zed\CartCodeTypeDataImport\Communication\Plugin\DataImport;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CartCodeTypeDataImport\Business\CartCodeTypeDataImportFacade;
use FondOfOryx\Zed\CartCodeTypeDataImport\CartCodeTypeDataImportConfig;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;

class CartCodeTypeDataImportPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CartCodeTypeDataImport\Business\CartCodeTypeDataImportFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartCodeTypeDataImportFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterConfigurationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterConfigurationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterReportTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterReportTransferMock;

    /**
     * @var \FondOfOryx\Zed\CartCodeTypeDataImport\Communication\Plugin\DataImport\CartCodeTypeDataImportPlugin
     */
    protected $cartCodeTypeDataImportPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->cartCodeTypeDataImportFacadeMock = $this->getMockBuilder(CartCodeTypeDataImportFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterConfigurationTransferMock = $this->getMockBuilder(DataImporterConfigurationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterReportTransferMock = $this->getMockBuilder(DataImporterReportTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartCodeTypeDataImportPlugin = new CartCodeTypeDataImportPlugin();
        $this->cartCodeTypeDataImportPlugin->setFacade($this->cartCodeTypeDataImportFacadeMock);
    }

    /**
     * @return void
     */
    public function testImport(): void
    {
        $this->cartCodeTypeDataImportFacadeMock->expects(static::atLeastOnce())
            ->method('import')
            ->with($this->dataImporterConfigurationTransferMock)
            ->willReturn($this->dataImporterReportTransferMock);

        static::assertEquals(
            $this->dataImporterReportTransferMock,
            $this->cartCodeTypeDataImportPlugin->import($this->dataImporterConfigurationTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetImportType(): void
    {
        static::assertEquals(
            CartCodeTypeDataImportConfig::IMPORT_TYPE_CART_CODE_TYPE,
            $this->cartCodeTypeDataImportPlugin->getImportType()
        );
    }
}
