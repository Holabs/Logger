<?php

namespace Holabs\Logger\Storages;

use Holabs\Logger\ILog;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>, Tomáš Holan [www.tomasholan.eu]
 * @package      holabs/logger
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
interface IStorage {

	/**
	 * Write log to database
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
	): ILog;

	/**
	 * Get logs
	 * @param array|null   $by
	 * @param string|null  $order
	 * @param integer|null $limit
	 * @param integer|null $offset
	 * @return ILog[]
	 */
	public function read(array $by = NULL, string $order = NULL, int $limit = NULL, int $offset = NULL): array;

	/**
	 * @return \Ublaboo\DataGrid\DataSource\IDataSource|array|\DibiFluent|\Dibi\Fluent|\Nette\Database\Table\Selection|\Doctrine\ORM\QueryBuilder
	 */
	public function getDataSource();

	/**
	 * @return array
	 */
	public function getActionTypes(): array;
}
