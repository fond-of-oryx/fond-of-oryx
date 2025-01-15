<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

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

        $callCount = $this->atLeastOnce();
        $this->glossaryStorageClientMock->expects($callCount)
            ->method('translate')
            ->willReturnCallback(static function (string $id, string $localeName, array $parameters = []) use ($self, $callCount, $translated, $untranslated, $locale) {
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
                        $self->assertSame($untranslated['name_asc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['name_asc'];
                    case 2:
                        $self->assertSame($untranslated['name_desc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['name_desc'];
                }

                throw new Exception('Unexpected call count');
            });

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
