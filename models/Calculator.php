<?php

namespace app\models;

use Yii;
use yii\base\InvalidCallException;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Calculator extends Model
{

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
                $result = $operand1 / $operand2;
                break;
            default:
                throw new InvalidCallException("Invalid operator");
        }

        return $result;
    }
}
