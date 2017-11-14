<?php

namespace Holabs;

use Holabs\Logger\ILogger;
use Holabs\Logger\ILog;
use Holabs\Logger\Storages\IStorage;
use Nette\Security\User;
use Nette\SmartObject;
use Nette\Http\Request;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>, Tomáš Holan [www.tomasholan.eu]
 * @package      holabs/logger
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 *
 * @method onLog(Logger $sender, ILog $log) -- Occurs when new log is written
 */
class Logger implements ILogger {

	use SmartObject;

	/** @var \Closure[]|callable[]|array */
	public $onLog = [];

	/** @var IStorage */
	private $storage;

	/** @var  User */
	private $user;

	/** @var Request  HTTP Request object */
	private $request;


	/**
	 * @param IStorage $storage
	 * @param User     $user
	 * @param Request  $request
	 */
	public function __construct(IStorage $storage, User $user, Request $request) {
		$this->storage = $storage;
		$this->user = $user;
		$this->request = $request;
	}

	/**
	 * Write log to database
	 * @param string $action
	 * @param array|null  $parameters
	 * @return ILog
	 */
	public function log(string $action, array $parameters = NULL): ILog {
		$ip = $this->request->getRemoteAddress();
		$userAgent = $this->request->getHeader('User-Agent');

		$log = $this->getStorage()->write($action, $parameters, $this->user->getId(), $ip, $userAgent);
		$this->onLog($this, $log);

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
		return $this->getStorage()->read($by, $order, $limit, $offset);
	}

	/**
	 * @return IStorage
	 */
	public function getStorage(): IStorage {
		return $this->storage;
	}
}