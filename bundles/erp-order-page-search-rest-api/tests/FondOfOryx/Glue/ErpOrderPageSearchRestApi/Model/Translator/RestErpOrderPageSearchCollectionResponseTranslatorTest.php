<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator;

use Codeception\Test\Unit;
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

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->withConsecutive([$untranslated['external-reference_asc'], $locale], [$untranslated['external-reference_desc'], $locale])
            ->willReturnOnConsecutiveCalls($translated['external-reference_asc'], $translated['external-reference_desc']);

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
