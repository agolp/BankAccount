<?php declare(strict_types=1);

class BankAccount
{
    protected int $balance;

    public function __construct(int $balance = 0)
    {
        $this->balance = $balance;
    }

    /**
     * Return the account balance
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * Check amount
     */
    public function checkAmount(int $amount): BankAccount
    {
        if ($amount < 0) {
            throw new BankAccountException('The supplied amount should be positive');
        }

        return $this;
    }

    /**
     * Credit the account with the supplied amount
     */
    public function credit(int $amount): BankAccount
    {
        $this->checkAmount($amount);
        $this->balance += $amount;

        return $this;
    }

    /**
     * Debit the account with the supplied amount
     */
    public function debit(int $amount): BankAccount
    {
        $this->checkAmount($amount);
        if ($amount > $this->balance) {
            throw new BankAccountException('Insufficient funds in bank account');
        }
        $this->balance -= $amount;

        return $this;
    }

    /**
     * Transfer the supplied amount to the target bank account
     */
    public function transfer(BankAccount $target, int $amount)
    {
        $this->debit($amount);
        $target->credit($amount);
    }
}
