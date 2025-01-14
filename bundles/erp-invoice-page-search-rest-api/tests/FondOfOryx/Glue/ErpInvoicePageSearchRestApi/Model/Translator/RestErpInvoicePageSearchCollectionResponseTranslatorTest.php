<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

        $locale = 'de_DE';
        $sortParamNames = [
            'external-reference_asc',
            'external-reference_desc',
        ];
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
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $callCount = $this->atLeastOnce();
        $this->glossaryStorageClientMock->expects($callCount)
            ->method('translate')
            ->willReturnCallback(static function (string $id, string $localeName, array $parameters = []) use ($self, $callCount, $locale, $untranslated, $translated) {
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
