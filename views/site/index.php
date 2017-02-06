<?php

/* @see \app\controllers\SiteController::actionIndex() Action for this view. */
/* @var $this yii\web\View */

$this->title = 'Calculator';
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-4">
            <h2>Калькулятор</h2>
            <div id="calculator"></div>
        </div>
        <div class="col-lg-5 col-lg-offset-1">
            <h2>Помощь</h2>
            <ol>
                <li>
                    Примеры выражений:
                    <pre>"-2.3 + 3", "2 /10", "2-5.2", "-2*  34.3    "</pre>
                </li>
                <li>
                    Поддерживает только четыре арифметические операции:
                    <pre>+, -, *, /</pre>
                </li>
            </ol>
        </div>
    </div>
</div>
<script id="calculator-template" type="text/template">
    <form class="calculator">
        <div class="form-group">
            <label for="expression">Введите арифметическое выражение</label>
            <input id="expression"
                   class="calculator__expression form-control"
                   autocomplete="off"
                   maxlength="30"
                   placeholder='Например: "2 + 3"'>
            <div id="error" class="calculator__error help-block help-block-error"></div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Посчитать</button>
        </div>

        <div class="form-group">
            <label for="result">Результат</label>
            <input id="result" class="calculator__result form-control" readonly>
        </div>
    </form>
</script>
<script>
    $(function () {
        $('#calculator').calculator();
    });
</script>
