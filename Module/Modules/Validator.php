<?php

class Validator
{
    private bool $_passed = false;
    private array $_errors = [];
    private array $_attributes = [];
    private ?DB $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check(array $source, array $inputRules): Validator
    {
        foreach ($inputRules as $inputName => $rules) {
            $value = $source[$inputName];

            foreach ($rules as $ruleName => $ruleValue) {
                if ($ruleName === 'required' && empty($value)) {
                    $this->addError($inputName, "{$this->getAttr($inputName)} is required");
                    continue;
                }

                if (!empty($value)) {
                    switch ($ruleName) {
                        case 'min':
                            if (strlen($value) < $ruleValue)
                                $this->addError($inputName, "{$this->getAttr($inputName)} must be a minimum of {$ruleValue} characters");
                            break;
                        case 'max':
                            if (strlen($value) > $ruleValue)
                                $this->addError($inputName, "{$this->getAttr($inputName)} must be a maximum of {$ruleValue} characters");
                            break;
                        case 'matches':
                            if ($value !== $source[$ruleValue])
                                $this->addError($inputName, "{$ruleValue} must match {$this->getAttr($inputName)}");
                            break;
                        case 'unique':
                            $query = $this->_db->get($ruleValue, [$inputName, '=', $value]);
                            if ($query->count())
                                $this->addError($inputName, "{$this->getAttr($inputName)} already exists");
                            break;
                        case 'email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL))
                                $this->addError($inputName, "{$this->getAttr($inputName)} is not a valid email");
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        $this->_passed = empty($this->_errors);

        return $this;
    }


    private function addError(string $inputName, string $error): void
    {
        $this->_errors[$inputName] = $error;
    }

    public function errors(): array
    {
        return $this->_errors;
    }

    public function error($name): string
    {
        return $this->_errors[$name] ?? "";
    }

    public function setAttributes($inputNames): void
    {
        $this->_attributes = $inputNames;
    }

    public function getAttr($name): string
    {
        return $this->_attributes[$name] ?? $name;
    }

    
    public function passed(): bool
    {
        return $this->_passed;
    }

}