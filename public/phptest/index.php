<?php

require_once('Composition.php');
require_once('Aggregation.php');
require_once('Ass.php');
require_once('DepInj.php');
require_once('TestInterface.php');
require_once('TestTrait.php');
require_once('A.php');
require_once('B.php');

// Композиция
$test1 = new \Test\Composition();
echo $test1->run('Test msg composition');
echo '<br />';

// Агрегация
$object = new \Test\B();
$test2 = new \Test\Aggregation($object);
echo $test2->run('Test msg aggregation');
echo '<br />';

// Ассоциация
$object = new \Test\B();
$test3 = new \Test\Ass();
echo $test3->run($object, 'Test msg ass');
echo '<br />';

// Внедрение зависимостей (DI)
$object = new \Test\B();
$test4 = new \Test\DepInj($object);
echo $test4->run('Test Dep Inj');

class Test
{
    final public const AAA = 1;
}

$obj = new Test();
echo Test::AAA;

// Вывод UML-диаграммы
echo '<br /><img src="/phptest/uml.png" width="50%">';
