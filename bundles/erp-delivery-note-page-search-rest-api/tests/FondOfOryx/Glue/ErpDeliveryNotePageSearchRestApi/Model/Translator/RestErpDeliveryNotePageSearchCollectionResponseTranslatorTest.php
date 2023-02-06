<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchPaginationSortTransfer;

class RestErpDeliveryNotePageSearchCollectionResponseTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restErpDeliveryNotePageSearchCollectionResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restErpDeliveryNotePageSearchPaginationSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator\RestErpDeliveryNotePageSearchCollectionResponseTranslator
     */
    protected $translator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpDeliveryNotePageSearchCollectionResponseTransferMock = $this->getMockBuilder(RestErpDeliveryNotePageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpDeliveryNotePageSearchPaginationSortTransferMock = $this->getMockBuilder(RestErpDeliveryNotePageSearchPaginationSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->translator = new RestErpDeliveryNotePageSearchCollectionResponseTranslator(
            $this->glossaryStorageClientMock,
        );
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $locale = 'de_DE';
        $sortParamNames = [
            'external-reference_asc',
            'external-reference_desc',
        ];
        $untranslated = [
            'external-reference_asc' => 'erp_delivery_note_page_search_rest_api.sort.external-reference_asc',
            'external-reference_desc' => 'erp_delivery_note_page_search_rest_api.sort.external-reference_desc',
        ];
        $translated = [
            'external-reference_asc' => 'Externe Referenz aufsteigend',
            'external-reference_desc' => 'Externe Referenz absteigend',
        ];

        $this->restErpDeliveryNotePageSearchCollectionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restErpDeliveryNotePageSearchPaginationSortTransferMock);

        $this->restErpDeliveryNotePageSearchPaginationSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->withConsecutive([$untranslated['external-reference_asc'], $locale], [$untranslated['external-reference_desc'], $locale])
            ->willReturnOnConsecutiveCalls($translated['external-reference_asc'], $translated['external-reference_desc']);

        $this->restErpDeliveryNotePageSearchPaginationSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restErpDeliveryNotePageSearchPaginationSortTransferMock);

        static::assertEquals(
            $this->restErpDeliveryNotePageSearchCollectionResponseTransferMock,
            $this->translator->translate(
                $this->restErpDeliveryNotePageSearchCollectionResponseTransferMock,
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

        $this->restErpDeliveryNotePageSearchCollectionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restErpDeliveryNotePageSearchCollectionResponseTransferMock,
            $this->translator->translate(
                $this->restErpDeliveryNotePageSearchCollectionResponseTransferMock,
                $locale,
            ),
        );
    }
}
