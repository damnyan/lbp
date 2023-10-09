<?php

namespace Tests;

use DateTime;
use Dmn\Lbp\CreditFile\Enum\BankCode;
use Dmn\Lbp\CreditFile\Enum\CurrencyCode;
use Dmn\Lbp\CreditFile\Enum\CustomerType;
use Dmn\Lbp\CreditFile\Enum\OrganizationCode;
use Dmn\Lbp\CreditFile\Enum\SettlementType;
use Dmn\Lbp\CreditFile\Enum\TargetCreditingApplication;
use Dmn\Lbp\CreditFile\Enum\TransactionType;
use Dmn\Lbp\CreditFile\Row;
use PHPUnit\Framework\TestCase;

class CreditFileTest extends TestCase
{
    /**
     * @test
     * @testdox It should generate credit instruction
     *
     * @return void
     */
    public function creditInstruction(): void
    {
        $row = new Row();
        $row->agencyReferenceNumber = 'LBPT001722444438';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2023-05-18 07:30:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '8656003520';
        $row->receiversAccountNumber = '0276000055';
        $row->merchantBillerCode = null;
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 102.18;
        $row->remittersLastName = 'LANDBANK';
        $row->remittersFirstName = 'LBP';
        $row->remittersMiddleName = null;
        $row->remittersAddress = 'Makati City';
        $row->receiversLastName = 'JANE1';
        $row->receiversFirstName = 'JANE';
        $row->receiversMiddleName = 'LBCS';
        $row->receiversAddress = 'Pedro Gil';
        $row->receiversCity = 'Manila City';
        $row->receiversProvince = 'Metro Manila';
        $row->organizationCode = OrganizationCode::LANDBANK;
        $row->currencyCode = CurrencyCode::PHP;
        $row->emailAddress = 'galasanayjane2@gmail.com';
        $row->customerType = CustomerType::INDIVIDUAL;

        $creditInstruction = 'LBPT001722444438|01|20230518|073000|LP|1|035|8656003520|0276000055|||102.18|LANDBANK|LBP||Makati City|JANE1|JANE|LBCS|Pedro Gil|Manila City|Metro Manila|LBP|PHP|galasanayjane2@gmail.com|I|null|null|null|null|null|null';
        $this->assertEquals($creditInstruction, $row->getCreditInstruction());
    }
}
