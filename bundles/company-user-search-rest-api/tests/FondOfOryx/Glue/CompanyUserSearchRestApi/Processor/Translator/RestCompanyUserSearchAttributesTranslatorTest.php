<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer;

class RestCompanyUserSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslator
     */
    protected $restCompanyUserSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanyUserSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchAttributesTransferMock = $this->getMockBuilder(RestCompanyUserSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchSortTransferMock = $this->getMockBuilder(RestCompanyUserSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchAttributesTranslator = new RestCompanyUserSearchAttributesTranslator(
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
            'name_asc' => 'companies_rest_api.sort.name_asc',
            'name_desc' => 'companies_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restCompanyUserSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restCompanyUserSearchSortTransferMock);

        $this->restCompanyUserSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

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

        $this->restCompanyUserSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restCompanyUserSearchSortTransferMock);

        static::assertEquals(
            $this->restCompanyUserSearchAttributesTransferMock,
            $this->restCompanyUserSearchAttributesTranslator->translate(
                $this->restCompanyUserSearchAttributesTransferMock,
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

        $this->restCompanyUserSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restCompanyUserSearchAttributesTransferMock,
            $this->restCompanyUserSearchAttributesTranslator->translate(
                $this->restCompanyUserSearchAttributesTransferMock,
                $locale,
            ),
        );
    }
}
