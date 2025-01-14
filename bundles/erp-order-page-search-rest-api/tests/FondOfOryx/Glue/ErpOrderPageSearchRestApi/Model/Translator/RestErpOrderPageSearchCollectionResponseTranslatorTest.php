<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchPaginationSortTransfer;

class RestErpOrderPageSearchCollectionResponseTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restErpOrderPageSearchCollectionResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restErpOrderPageSearchPaginationSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator\RestErpOrderPageSearchCollectionResponseTranslator
     */
    protected $translator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(ErpOrderPageSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpOrderPageSearchCollectionResponseTransferMock = $this->getMockBuilder(RestErpOrderPageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpOrderPageSearchPaginationSortTransferMock = $this->getMockBuilder(RestErpOrderPageSearchPaginationSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->translator = new RestErpOrderPageSearchCollectionResponseTranslator(
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
            'external-reference_asc' => 'erp_order_page_search_rest_api.sort.external-reference_asc',
            'external-reference_desc' => 'erp_order_page_search_rest_api.sort.external-reference_desc',
        ];
        $translated = [
            'external-reference_asc' => 'Externe Referenz aufsteigend',
            'external-reference_desc' => 'Externe Referenz absteigend',
        ];

        $this->restErpOrderPageSearchCollectionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restErpOrderPageSearchPaginationSortTransferMock);

        $this->restErpOrderPageSearchPaginationSortTransferMock->expects(static::atLeastOnce())
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

        $this->restErpOrderPageSearchPaginationSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restErpOrderPageSearchPaginationSortTransferMock);

        static::assertEquals(
            $this->restErpOrderPageSearchCollectionResponseTransferMock,
            $this->translator->translate(
                $this->restErpOrderPageSearchCollectionResponseTransferMock,
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

        $this->restErpOrderPageSearchCollectionResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restErpOrderPageSearchCollectionResponseTransferMock,
            $this->translator->translate(
                $this->restErpOrderPageSearchCollectionResponseTransferMock,
                $locale,
            ),
        );
    }
}
