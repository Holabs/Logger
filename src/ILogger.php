<?php

namespace Holabs\Logger;

use Holabs\Logger\Storages\IStorage;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>, Tomáš Holan [www.tomasholan.eu]
 * @package      holabs/logger
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 *
 * @property \Closure[]|callable[]|array $onLog
 */
interface ILogger {

	/**
	 * @param string     $action
	 * @param array|null $parameters
	 * @return ILog
	 */
	public function log(string $action, array $parameters = NULL): ILog;

	/**
	 * @return IStorage
	 */
	public function getStorage(): IStorage;

	/**
	 * @param array|NULL   $by
	 * @param string|NULL  $order
	 * @param integer|NULL $limit
	 * @param integer|NULL $offset
	 * @return ILog[]
	 */
	public function read(array $by = NULL, string $order = NULL, int $limit = NULL, int $offset = NULL): array;
}