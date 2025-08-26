<?php

namespace Dmn\Lbp;

use DateTime;
use Dmn\Lbp\CreditFile\Row;
use ZipArchive;

class CreditFile
{
    protected array $rows = [];

    protected int $previousCumulativeHash = 0;

    protected int $recordHash = 0;

    protected int $rowCount = 0;

    protected int $totalTransactionAmount = 0;

    protected string|null $rawFilePath = null;
    protected string|null $zipFilePath = null;

    protected string $separator = '|';

    /**
     * Construct
     *
     * @param string $agencyCode
     * @param string $filePassword
     * @param integer $sequenceNumber
     * @param string $path
     * @param DateTime|null|null $date
     */
    public function __construct(
        protected string $agencyCode,
        protected string $filePassword,
        protected int $sequenceNumber = 1,
        protected string $path = '/',
        protected DateTime|null $date = null,
    ) {
        if (is_null($date)) {
            $this->date = new DateTime();
        }
    }

    /**
     * Set sequence number
     *
     * @param integer $sequenceNumber
     * @return void
     */
    public function setSequenceNumber(int $sequenceNumber): void
    {
        $this->sequenceNumber = $sequenceNumber;
    }

    /**
     * Set Date
     *
     * @param integer $sequenceNumber
     * @return void
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Get raw file path
     *
     * @return string|null
     */
    public function getRawFilePath(): string|null
    {
        return $this->rawFilePath;
    }

    /**
     * Get zip file path
     *
     * @return string|null
     */
    public function getZipFilePath(): string|null
    {
        return $this->zipFilePath;
    }

    /**
     * Add row
     *
     * @param Row $row
     * @return void
     */
    public function addRow(Row $row): void
    {
        $row->setPreviousCumulativeHash($this->previousCumulativeHash);
        $row->compute();
        $this->previousCumulativeHash = $row->getCumulativeHash();
        $this->recordHash = $this->recordHash + $row->getRecordHash();
        $this->rowCount++;

        // OLD: $this->totalTransactionAmount = $this->totalTransactionAmount + $row->getTransactionAmount();
        $transactionAmount = $this->toCents($row->getTransactionAmount());
        $this->totalTransactionAmount = $this->totalTransactionAmount + $transactionAmount;

        array_push($this->rows, $row);
    }

    /**
     * Add rows
     *
     * @param Row ...$rows
     * @return void
     */
    public function addRows(Row ...$rows): void
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
    }

    /**
     * Get rows
     *
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * Footer value
     *
     * @return array
     */
    protected function footerValue(): array
    {
        return [
            $this->rowCount,
            $this->centsToString($this->totalTransactionAmount), // FIXED: Convert back to decimal string
            $this->recordHash
        ];
    }

    protected function headers(): array
    {
        return [$this->batchNumber()];
    }

    /**
     * batchNumber
     *
     * @return string
     */
    protected function batchNumber(): string
    {
        return $this->agencyCode
            . '_'
            . $this->date->format('Ymd')
            . str_pad($this->sequenceNumber, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Generate
     *
     * @return string
     */
    public function generate(): string
    {
        $filename = $this->batchNumber();
        $this->rawFilePath = $this->path . $filename . '.txt';
        $this->zipFilePath = $this->path . $filename . '.zip';

        $f = fopen($this->rawFilePath, 'w');

        $this->addHeaders($f);
        foreach ($this->rows as $row) {
            /** @var \Dmn\Lbp\CreditFile\Row $row */
            $this->addLine($f, $row->getCsvRow());
        }

        $this->addFooter($f);

        fclose($f);

        $this->createZip();
        return $this->zipFilePath;
    }

    /**
     * Create zip
     *
     * @return string
     */
    public function createZip(): string
    {
        $basename = basename($this->rawFilePath);

        $zip = new ZipArchive();
        $zip->open($this->zipFilePath, ZipArchive::CREATE);
        $zip->addFile($this->rawFilePath, $basename);
        $zip->setEncryptionName($basename, ZipArchive::EM_AES_256, $this->filePassword);
        $zip->close();
        return '';
    }

    /**
     * Add headers
     *
     * @param resource $f
     * @return void
     */
    protected function addHeaders(&$f): void
    {
        $this->addLine($f, $this->headers());
    }

    /**
     * Add footer
     *
     * @param [type] $f
     * @return void
     */
    protected function addFooter(&$f): void
    {
        $this->addLine($f, $this->footerValue());
    }

    protected function addLine(&$f, array $data): void
    {
        fputs($f, implode('|', $data) . "\r\n");
    }

    /**
     * ADDED: Convert decimal amount to integer cents using BCMath for precision
     */
    private function toCents($amount): int
    {
        return (int) bcmul((string)$amount, '100', 0);
    }

    /**
     * ADDED: Convert integer cents to decimal string with exactly 2 decimal places
     */
    private function centsToString(int $cents): string
    {
        $pesos = intdiv($cents, 100);
        $cent  = $cents % 100;
        return $pesos . '.' . str_pad((string)$cent, 2, '0', STR_PAD_LEFT);
    }
}