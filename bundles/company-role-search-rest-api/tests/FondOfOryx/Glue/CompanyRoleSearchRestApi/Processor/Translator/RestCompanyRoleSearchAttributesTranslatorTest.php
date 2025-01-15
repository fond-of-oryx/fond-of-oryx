<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer;

class RestCompanyRoleSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator\RestCompanyRoleSearchAttributesTranslator
     */
    protected $restCompanyRoleSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanyRoleSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchAttributesTransferMock = $this->getMockBuilder(RestCompanyRoleSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchSortTransferMock = $this->getMockBuilder(RestCompanyRoleSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchAttributesTranslator = new RestCompanyRoleSearchAttributesTranslator(
            $this->glossaryStorageClientMock,
        );
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $self = $this;

        $locale = 'en_US';
        $untranslated = [
            'name_asc' => 'companies_rest_api.sort.name_asc',
            'name_desc' => 'companies_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restCompanyRoleSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restCompanyRoleSearchSortTransferMock);

        $this->restCompanyRoleSearchSortTransferMock->expects(static::atLeastOnce())
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
                        $self->assertEquals($untranslated['name_asc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['name_asc'];
                    case 2:
                        $self->assertEquals($untranslated['name_desc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['name_desc'];
                }

                throw new Exception('Unexpected call count');
            });

        $this->restCompanyRoleSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restCompanyRoleSearchSortTransferMock);

        static::assertEquals(
            $this->restCompanyRoleSearchAttributesTransferMock,
            $this->restCompanyRoleSearchAttributesTranslator->translate(
                $this->restCompanyRoleSearchAttributesTransferMock,
                $locale,
            ),
        );
    }

    /**
     * @return void
     */
    public function testTranslateWithNullableSort(): void
    {
        $locale = 'en_US';

        $this->restCompanyRoleSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restCompanyRoleSearchAttributesTransferMock,
            $this->restCompanyRoleSearchAttributesTranslator->translate(
                $this->restCompanyRoleSearchAttributesTransferMock,
                $locale,
            ),
        );
    }
}
