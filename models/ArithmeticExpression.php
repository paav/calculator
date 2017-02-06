<?php

namespace app\models;

use yii\base\Model;

/**
 *
 */
class ArithmeticExpression extends Model
{
    const REGEX_EXPRESSION = '/\s*(-?\d+|-?\d*\.\d+)\s*([-+*\/])\s*(\d*\.\d+|\d+)\s*/';

    /** @var double */
    protected $operand1;
    /** @var double */
    protected $operand2;
    /** @var string */
    protected $operator;

    /**
     * ArithmeticExpression constructor.
     * @param string $operand1
     * @param string $operand2
     * @param string $operator
     * @param array $config
     */
    public function __construct($operand1, $operand2, $operator, $config = [])
    {
        $this->operand1 = (double)$operand1;
        $this->operand2 = (double)$operand2;
        $this->operator = $operator;
        parent::__construct($config);
    }

    /**
     * Parses arithmetic expression string.
     * @param string $string
     * @return self
     */
    public static function parse($string)
    {
        preg_match(static::REGEX_EXPRESSION, $string, $matches);
        $arithmeticExpr = new static($matches[1], $matches[3], $matches[2]);
        return $arithmeticExpr;
    }

    /**
     * @return double
     */
    public function getOperand1()
    {
        return $this->operand1;
    }

    /**
     * @return double
     */
    public function getOperand2()
    {
        return $this->operand2;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Converts instance to string.
     * @return string
     */
    public function toString()
    {
        return $this->operand1 . ' ' . $this->operator . ' ' . $this->operand2;
    }
}
