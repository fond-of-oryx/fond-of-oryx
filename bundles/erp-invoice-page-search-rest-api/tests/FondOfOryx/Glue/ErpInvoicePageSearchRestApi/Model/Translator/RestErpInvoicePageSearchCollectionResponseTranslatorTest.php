<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpInvoicePageSearchPaginationSortTransfer;

class RestErpInvoicePageSearchCollectionResponseTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restErpInvoicePageSearchCollectionResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restErpInvoicePageSearchPaginationSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator\RestErpInvoicePageSearchCollectionResponseTranslator
     */
    protected $translator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpInvoicePageSearchCollectionResponseTransferMock = $this->getMockBuilder(RestErpInvoicePageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpInvoicePageSearchPaginationSortTransferMock = $this->getMockBuilder(RestErpInvoicePageSearchPaginationSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->translator = new RestErpInvoicePageSearchCollectionResponseTranslator(
            $this->glossaryStorageClientMock,
        );
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $locale = 'de_DE';
        $untranslated = [
            'external-reference_asc' => 'erp_invoice_page_search_rest_api.sort.external-reference_asc',
            'external-reference_desc' => 'erp_invoice_page_search_rest_api.sort.external-reference_desc',
        ];
        $translated = [
            'external-reference_asc' => 'Externe Referenz aufsteigend',
            'external-reference_desc' => 'Externe Referenz absteigend',
        ];

        $this->restErpInvoicePageSearchCollectionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restErpInvoicePageSearchPaginationSortTransferMock);

        $this->restErpInvoicePageSearchPaginationSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->withConsecutive([$untranslated['external-reference_asc'], $locale], [$untranslated['external-reference_desc'], $locale])
            ->willReturnOnConsecutiveCalls($translated['external-reference_asc'], $translated['external-reference_desc']);

        $this->restErpInvoicePageSearchPaginationSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restErpInvoicePageSearchPaginationSortTransferMock);

        static::assertEquals(
            $this->restErpInvoicePageSearchCollectionResponseTransferMock,
            $this->translator->translate(
                $this->restErpInvoicePageSearchCollectionResponseTransferMock,
                $locale,
            ),
        );
    }

    /**
     * @return void
     */
    public function testTranslateWithNullableSort(): void
    {
        $locale = 'de_DE';

        $this->restErpInvoicePageSearchCollectionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restErpInvoicePageSearchCollectionResponseTransferMock,
            $this->translator->translate(
                $this->restErpInvoicePageSearchCollectionResponseTransferMock,
                $locale,
            ),
        );
    }
}
