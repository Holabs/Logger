<?php


namespace Holabs\Logger;

use Nette\Utils\DateTime;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/logger
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface ILog {

	/**
	 * @return int|null
	 */
	public function getId(): ?int;

	/**
	 * @return string
	 */
	public function getAction(): string;

	/**
	 * @return DateTime
	 */
	public function getTime(): DateTime;

	/**
	 * @return array|null
	 */
	public function getParams(): ?array;

	/**
	 * @return string|null
	 */
	public function getUserId(): ?string;

	/**
	 * @return string|null
	 */
	public function getIp(): ?string;

	/**
	 * @return string|null
	 */
	public function getUserAgent(): ?string;

}