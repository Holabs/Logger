<?php

namespace Holabs\Logger\Storages;

use Holabs\Logger\Log;
use Holabs\Logger\ILog;
use Nette\Utils\DateTime;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>, Tomáš Holan [www.tomasholan.eu]
 * @package      holabs/logger
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
class TempStorage implements IStorage {

	/** @var Log[] */
	private $logs = [];


	/**
	 * @param string      $action
	 * @param array|NULL  $parameters
	 * @param string|NULL $userId
	 * @param string|NULL $ip
	 * @param string|NULL $userAgent
	 * @return ILog
	 */
	public function write(
		string $action,
		array $parameters = NULL,
		string $userId = NULL,
		string $ip = NULL,
		string $userAgent = NULL
	): ILog {
		end($this->logs);
		$id = key($this->logs) ? : -1;
		$id++;
		$log = new Log($id, $action, $parameters, $userId, $ip, $userAgent, new DateTime());
		$this->logs[] = $log;

		return $log;
	}

	/**
	 * @param array|NULL  $by
	 * @param string|NULL $order
	 * @param int|NULL    $limit
	 * @param int|NULL    $offset
	 * @return ILog[]
	 */
	public function read(array $by = NULL, string $order = NULL, int $limit = NULL, int $offset = NULL): array {
		return $this->logs;
	}

	/**
	 * @return array
	 */
	public function getDataSource(): array {
		$tmp = [];
		foreach ($this->logs as $log) {
			$tmp[] = [
				'id'        => $log->getId(),
				'action'    => $log->getAction(),
				'params'    => $log->getParams(),
				'userId'    => $log->getUserId(),
				'ip'        => $log->getIp(),
				'userAgent' => $log->getUserAgent(),
				'time'      => $log->getTime(),
			];
		}

		return $tmp;
	}

	/**
	 * @return array
	 */
	public function getActionTypes(): array {
		return [];
	}

}
