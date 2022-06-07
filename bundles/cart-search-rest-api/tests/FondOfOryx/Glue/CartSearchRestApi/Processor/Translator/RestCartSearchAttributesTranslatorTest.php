<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCartSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCartSearchSortTransfer;

class RestCartSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCartSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCartSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Translator\RestCartSearchAttributesTranslator
     */
    protected $restCartSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CartSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchAttributesTransferMock = $this->getMockBuilder(RestCartSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchSortTransferMock = $this->getMockBuilder(RestCartSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchAttributesTranslator = new RestCartSearchAttributesTranslator(
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
            'name_asc' => 'cart_search_rest_api.sort.name_asc',
            'name_desc' => 'cart_search_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restCartSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restCartSearchSortTransferMock);

        $this->restCartSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->withConsecutive([$untranslated['name_asc'], $locale], [$untranslated['name_desc'], $locale])
            ->willReturnOnConsecutiveCalls($translated['name_asc'], $translated['name_desc']);

        $this->restCartSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restCartSearchSortTransferMock);

        static::assertEquals(
            $this->restCartSearchAttributesTransferMock,
            $this->restCartSearchAttributesTranslator->translate(
                $this->restCartSearchAttributesTransferMock,
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

        $this->restCartSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restCartSearchAttributesTransferMock,
            $this->restCartSearchAttributesTranslator->translate(
                $this->restCartSearchAttributesTransferMock,
                $locale,
            ),
        );
    }
}
