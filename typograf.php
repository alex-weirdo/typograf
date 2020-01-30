<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 30.01.2020
 * Time: 13:19
 */

include 'classes/Typograf.php';

$text = <<<TEXT
Заканчивается январь, и самое время рассказать о том, что мы будем смотреть в оставшиеся 11 месяцев 2020 года. Все мысли о российском кино, поэтому мы попросили Сергея Дешина собрать вместе самые любопытные кинопроекты из тех, что готовятся к выходу. В первой части списка — наше молодое кино. Мэтры будут на следующей неделе.
TEXT;

// можно вызвать так
$text = (new Typograf($text))->nbsp()->quotes()->options()->work();

// или так
$options = [
	'quotes' => true,
	'nbsp' => true
];
$text = (new Typograf($text))->options($options);

echo "<pre>";
var_dump($text);
echo "</pre>";
