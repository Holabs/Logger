<?php

namespace Holabs\Logger;

use Nette\Utils\DateTime;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>, Tomáš Holan [www.tomasholan.eu]
 * @package      holabs/logger
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
class Log implements ILog {

	/** @var  int|null */
	public $id;

	/** @var string Action name */
	private $action;

	/** @var DateTime|null Event time */
	private $time;

	/** @var array|null All necessary parameters */
	private $params;

	/** @var string|null User ID */
	private $userId;

	/** @var string|null User IP address */
	private $ip;

	/** @var string|null User Agent */
	private $userAgent;


	/**
	 * @param string|null   $id
	 * @param string        $action
	 * @param array|null    $params
	 * @param string|null   $userId
	 * @param string|null   $ip
	 * @param string|null   $userAgent
	 * @param DateTime|null $time
	 */
	public function __construct(
		string $id = NULL,
		string $action,
		array $params = NULL,
		string $userId = NULL,
		string $ip = NULL,
		string $userAgent = NULL,
		DateTime $time = NULL
	) {
		$this->id = $id;
		$this->action = $action;
		$this->params = $params;
		$this->userId = $userId;
		$this->ip = $ip;
		$this->userAgent = $userAgent;
		$this->time = $time;
	}

	/**
	 * @return int|null
	 */
	public function getId(): ?int {
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getAction(): string {
		return $this->action;
	}

	/**
	 * @return DateTime|null
	 */
	public function getTime(): ?DateTime {
		return $this->time;
	}

	/**
	 * @return array|null
	 */
	public function getParams(): ?array {
		return $this->params;
	}

	/**
	 * @return string|null
	 */
	public function getUserId(): ?string {
		return $this->userId;
	}

	/**
	 * @return string|null
	 */
	public function getIp(): ?string {
		return $this->ip;
	}

	/**
	 * @return string|null
	 */
	public function getUserAgent(): ?string {
		return $this->userAgent;
	}


}