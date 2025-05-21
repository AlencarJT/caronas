<?php

$fila = new SplQueue();

$fila->enqueue("João");
$fila->enqueue("Maria");
$fila->enqueue("Carlos");

echo "Foi atendido: " . $fila->dequeue() . PHP_EOL;
echo "Foi atendido: " . $fila->dequeue() . PHP_EOL;

echo "Restando na fila:" . PHP_EOL;
foreach ($fila as $pessoa) {
    echo $pessoa . PHP_EOL;
}
