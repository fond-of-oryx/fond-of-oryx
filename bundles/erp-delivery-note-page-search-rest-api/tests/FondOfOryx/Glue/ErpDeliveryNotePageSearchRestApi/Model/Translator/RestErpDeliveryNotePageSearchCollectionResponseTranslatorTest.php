<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

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

        $callCount = $this->atLeastOnce();
        $this->glossaryStorageClientMock->expects($callCount)
            ->method('translate')
            ->willReturnCallback(static function (string $id, string $localeName, array $parameters = []) use ($self, $callCount, $untranslated, $translated, $locale) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($untranslated['external-reference_asc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['external-reference_asc'];
                    case 2:
                        $self->assertSame($untranslated['external-reference_desc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['external-reference_desc'];
                }

                throw new Exception('Unexpected call count');
            });

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
