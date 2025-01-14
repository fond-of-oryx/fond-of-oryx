<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchSortTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestOrderBudgetSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiToGlossaryStorageClientInterface|MockObject $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestOrderBudgetSearchAttributesTransfer|MockObject $restOrderBudgetSearchAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestOrderBudgetSearchSortTransfer
     */
    protected MockObject|RestOrderBudgetSearchSortTransfer $restOrderBudgetSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslator
     */
    protected RestOrderBudgetSearchAttributesTranslator $restOrderBudgetSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(OrderBudgetSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchAttributesTransferMock = $this->getMockBuilder(RestOrderBudgetSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchSortTransferMock = $this->getMockBuilder(RestOrderBudgetSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchAttributesTranslator = new RestOrderBudgetSearchAttributesTranslator(
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
            'name_asc' => 'order_budget_search_rest_api.sort.name_asc',
            'name_desc' => 'order_budget_search_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restOrderBudgetSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restOrderBudgetSearchSortTransferMock);

        $this->restOrderBudgetSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $callCount = $this->atLeastOnce();
        $this->glossaryStorageClientMock->expects($callCount)
            ->method('translate')
            ->willReturnCallback(static function (string $id, string $localeName, array $parameters = []) use ($self, $callCount, $locale, $translated, $untranslated) {
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

        $this->restOrderBudgetSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restOrderBudgetSearchSortTransferMock);

        static::assertEquals(
            $this->restOrderBudgetSearchAttributesTransferMock,
            $this->restOrderBudgetSearchAttributesTranslator->translate(
                $this->restOrderBudgetSearchAttributesTransferMock,
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

        $this->restOrderBudgetSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restOrderBudgetSearchAttributesTransferMock,
            $this->restOrderBudgetSearchAttributesTranslator->translate(
                $this->restOrderBudgetSearchAttributesTransferMock,
                $locale,
            ),
        );
    }
}
