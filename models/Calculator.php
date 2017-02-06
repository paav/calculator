<?php

namespace app\models;

use yii\base\InvalidCallException;
use yii\base\Model;

/**
 *
 */
class Calculator extends Model
{
    /**
     * Calculates arithmetic expression.
     * @param ArithmeticExpression $arithmeticExpression
     * @throws InvalidCallException
     * @return double
     */
    public static function calculate(ArithmeticExpression $arithmeticExpression)
    {
        $operand1 = $arithmeticExpression->getOperand1();
        $operand2 = $arithmeticExpression->getOperand2();
        $operator = $arithmeticExpression->getOperator();

        switch($operator) {
            case "+":
                $result = $operand1 + $operand2;
                break;
            case "-":
                $result = $operand1 - $operand2;
                break;
            case "*":
                $result = $operand1 * $operand2;
                break;
            case "/":
                if ($operand2 == 0) {
                    throw new InvalidCallException('Division by zero.');
                }
                $result = $operand1 / $operand2;
                break;
            default:
                throw new InvalidCallException('Invalid operator.');
        }

        return $result;
    }
}
