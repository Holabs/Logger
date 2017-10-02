<?php

namespace Holabs\Logger;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/logger
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
trait TLogger {

	/** @var ILogger */
	protected $logger;

	/**
	 * @param ILogger $logger
	 */
	public function injectLogger(ILogger $logger) {
		$this->logger = $logger;
	}

	/**
	 * @param string     $action
	 * @param array|null $params
	 * @return Log
	 */
	protected function log(string $action, array $params = NULL): Log {
		return $this->logger->log($action, $params);
	}

}