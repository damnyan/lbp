<?php

namespace Dmn\Lbp\CreditFile;

use DateTime;
use Dmn\Lbp\CreditFile\Enum\BankCode;
use Dmn\Lbp\CreditFile\Enum\CurrencyCode;
use Dmn\Lbp\CreditFile\Enum\CustomerType;
use Dmn\Lbp\CreditFile\Enum\OrganizationCode;
use Dmn\Lbp\CreditFile\Enum\SettlementType;
use Dmn\Lbp\CreditFile\Enum\TargetCreditingApplication;
use Dmn\Lbp\CreditFile\Enum\TransactionType;

class Row
{
    protected string|null $creditInstruction = null;

    protected int $recordHash = 0;

    protected int $cumulativeHash = 0;

    protected int $previousCumulativeHash = 0;

    public string $agencyReferenceNumber;

    public string $transactionType;

    public DateTime $timestamp;

    public string $settlementType;

    public string $targetCreditingApplication;

    public string $destinationBankCode;

    public string $receiversBankCode;

    public string $sourceAccountNumber;

    public string $receiversAccountNumber;

    public string|null $merchantBillerCode = null;

    public string|null $merchantReferenceNumber = null;

    public float $transactionAmount;

    public string $remittersLastName;
    public string $remittersFirstName;
    public string|null $remittersMiddleName;
    public string $remittersAddress;

    public string $receiversLastName;
    public string $receiversFirstName;
    public string|null $receiversMiddleName;
    public string $receiversAddress;
    public string $receiversCity;
    public string $receiversProvince;

    public string $organizationCode;

    public string $currencyCode;

    public string $emailAddress;

    public string $customerType;

    public string|null $remarks = null;

    public string|null $details1 = null;
    public string|null $details2 = null;
    public string|null $details3 = null;
    public string|null $details4 = null;
    public string|null $details5 = null;

    protected array $csvRow = [];

    protected array $row = [];

    public function __construct()
    {
        $this->setDefaults();
    }

    /**
     * Set defaults
     *
     * @return void
     */
    protected function setDefaults(): void
    {
        $this->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $this->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $this->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $this->receiversBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $this->organizationCode = OrganizationCode::USI;
        $this->currencyCode = CurrencyCode::PHP;
        $this->customerType = CustomerType::INDIVIDUAL;
    }

    /**
     * Compute
     *
     * @return void
     */
    public function compute(): void
    {
        $this->generateCreditInstruction();
        $this->generateRecordHash();
        $this->generateCumulativeHash();
        $this->generateCsvRow();
    }

    /**
     * Generate record hash
     *
     * @return void
     */
    protected function generateRecordHash(): void
    {
        $this->recordHash = ($this->transactionAmount * 100)
            * (
                (int) substr($this->sourceAccountNumber, strlen($this->sourceAccountNumber) - 6)
                + (int) substr($this->receiversAccountNumber, strlen($this->receiversAccountNumber) -6)
            );
    }

    /**
     * Generate cumulative Hash
     *
     * @return void
     */
    protected function generateCumulativeHash(): void
    {
        $this->cumulativeHash = $this->getRecordHash() + $this->previousCumulativeHash;
    }

    /**
     * Get record hash
     *
     * @return string
     */
    public function getRecordHash(): string
    {
        if (empty($this->recordHash)) {
            $this->generateRecordHash();
        }

        return $this->recordHash;
    }

    /**
     * Get cumulative hash
     *
     * @return integer
     */
    public function getCumulativeHash(): int
    {
        if (empty($this->cumulativeHash)) {
            $this->generateCumulativeHash();
        }

        return $this->cumulativeHash;
    }

    /**
     * Set previous cumulative has
     *
     * @param integer $cumulativeHash
     * @return void
     */
    public function setPreviousCumulativeHash(int $cumulativeHash): void
    {
        $this->previousCumulativeHash = $cumulativeHash;
    }

    /**
     * Generate Credit Instrauction
     *
     * @return void
     */
    protected function generateCreditInstruction(): void
    {
        $this->row = [
            'agency_reference_number' => $this->agencyReferenceNumber,
            'transaction_type' => $this->transactionType,
            'trasaction_date' => $this->timestamp->format('Ymd'),
            'transaction_time' => $this->timestamp->format('His'),
            'settlement_type' => $this->settlementType,
            'target_crediting_application' => $this->targetCreditingApplication,
            'destination_bank_code' => $this->destinationBankCode,
            'source_account_number' => $this->sourceAccountNumber,
            'receivers_account_number' => $this->receiversAccountNumber,
            'merchant_biller_code' => $this->merchantBillerCode,
            'merchant_reference_number' => $this->merchantReferenceNumber,
            'transaction_amount' => $this->transactionAmount,
            'remitters_last_name' => $this->remittersLastName,
            'remitters_first_name' => $this->remittersFirstName,
            'remitters_middle_name' => $this->remittersMiddleName,
            'remitters_address' => $this->remittersAddress,

            'receivers_last_name' => $this->receiversLastName,
            'receivers_first_name' => $this->receiversFirstName,
            'receivers_middle_name' => $this->receiversMiddleName,
            'receivers_address' => $this->receiversAddress,
            'receivers_city' => $this->receiversCity,
            'receivers_province' => $this->receiversProvince,

            'organization_code' => $this->organizationCode,
            'currency_code' => $this->currencyCode,

            'email_address' => $this->emailAddress,

            'customer_type' => $this->customerType,
            'remarks' => $this->remarks ?? 'null',
            'details1' => $this->details1 ?? 'null',
            'details2' => $this->details2 ?? 'null',
            'details3' => $this->details3 ?? 'null',
            'details4' => $this->details4 ?? 'null',
            'details5' => $this->details5 ?? 'null',
        ];
    }

    /**
     * Generate generate csv row
     *
     * @return void
     */
    protected function generateCsvRow(): void
    {
        $this->csvRow = $this->row;
    }

    /**
     * Get CSV row
     *
     * @return array
     */
    public function getCsvRow(): array
    {
        if (empty($this->csvRow)) {
            $this->generateCsvRow();
        }

        return $this->csvRow;
    }

    /**
     * Transaction amount
     *
     * @return float
     */
    public function getTransactionAmount(): float
    {
        return $this->transactionAmount;
    }
}
