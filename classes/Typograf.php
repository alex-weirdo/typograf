<?php

/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 30.01.2020
 * Time: 13:19
 */
class Typograf
{
	public $text = '';

	# Настройки
	protected $nbsp = false;
	protected $quotes = false;

	/**
	 * Typograf constructor.
	 * @param $text
	 */
	public function __construct($text)
	{
		$this->text = $text;
	}

	/**
	 * Применит настройки и вернет исправленый текст
	 * @return string
	 */
	public function work() {
		$text = $this->text;
		return $text;
	}

	/*
	 * Далее работа с настройками
	 */

	public function nbsp($accept = true) {
		$this->nbsp = $accept;
		return $this;
	}

	public function quotes($accept = true) {
		$this->quotes = $accept;
		return $this;
	}

	/**
	 * @param array $options
	 * @return $this
	 */
	public function options($options = []) {
		try {
			foreach ($options as $key => $value)
				if ( isset($this->$key) )
					$this->$key = $value;
				else throw new Exception;
		} catch (Exception $e) {
			die('<b>Проверьте массив с опциями.</b><br>' . $e);
		}
		return $this;
	}
}