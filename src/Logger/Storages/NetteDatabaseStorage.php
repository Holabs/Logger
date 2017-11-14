<?php

namespace Holabs\Logger\Storages;

use Holabs\Logger\ILog;
use Holabs\Logger\Log;
use Nette\Database\Context;
use Nette\Database\Table\Selection;
use Nette\SmartObject;
use Nette\Utils\DateTime;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>, Tomáš Holan [www.tomasholan.eu]
 * @package      holabs/logger
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
class NetteDatabaseStorage implements IStorage {

	use SmartObject;

	/** @var Selection */
	private $table;

	/**
	 * @param string  $table
	 * @param Context $database
	 */
	public function __construct(string $table, Context $database) {
		$this->table = $database->table($table);
	}

	/**
	 * @param string      $action
	 * @param array|null  $parameters
	 * @param string|null $userId
	 * @param string|null $ip
	 * @param string|null $userAgent
	 * @return ILog
	 */
	public function write(
		string $action,
		array $parameters = NULL,
		string $userId = NULL,
		string $ip = NULL,
		string $userAgent = NULL
	): ILog {

		$result = $this->table->insert(
			[
				'action'    => $action,
				'params'    => $parameters ? serialize($parameters) : NULL,
				'userId'    => $userId,
				'ip'        => $ip,
				'userAgent' => $userAgent,
				'time'      => new DateTime(),
			]
		);

		return new Log(
			$result->offsetGet('id'),
			$action,
			$result->offsetGet('time'),
			$parameters,
			$userId,
			$ip,
			$userAgent
		);
	}

	/**
	 * Get logs
	 * @param array|null  $by
	 * @param string|null $order
	 * @param int|null    $limit
	 * @param int|null    $offset
	 * @return ILog[]
	 */
	public function read(array $by = NULL, string $order = NULL, int $limit = NULL, int $offset = NULL): array {

		$result = $this->table->where($by)->order($order)->limit($limit, $offset);

		$logs = [];
		foreach ($result as $log) {
			$logs[] = new Log(
				$log->id, $log->action, $log->time, $log->params, $log->userId, $log->ip, $log->userAgent
			);
		}

		return $logs;
	}

	/**
	 * @return Selection
	 */
	public function getDataSource(): Selection {
		return $this->table;
	}

	/**
	 * @return array
	 */
	public function getActionTypes(): array {
		$types = array();
		$result = $this->table->select('DISTINCT(action)');
		foreach ($result as $action) {
			$types[] = $action->action;
		}

		return $types;
	}

}
