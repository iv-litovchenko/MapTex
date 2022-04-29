<?php
require_once('AssociationTeam.php');
require_once('AssociationPlayer.php');

require_once('Composition.php');
require_once('Aggregation.php');
require_once('TestInterface.php');
require_once('TestTrait.php');
require_once('A.php');
require_once('B.php');

// Ассоциация
$team = new \Test\AssociationTeam('Command 1');
$player = new \Test\AssociationPlayer();
$player->setTeam($team);
echo $player->getTeam()->getName();
echo '<br />';

// Внедрение зависимостей (DI)
// Композиция
$test = new \Test\Composition();
echo $test->run('Test msg composition');
echo '<br />';

// Внедрение зависимостей (DI)
// Агрегация
$object = new \Test\B();
$test = new \Test\Aggregation($object);
echo $test->run('Test msg aggregation');
echo '<br />';

// Вывод UML-диаграммы
echo '<br /><img src="/phptest/uml.png" width="50%">';