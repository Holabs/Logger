<?php

namespace Holabs\Logger\Bridges\Tracy;

use Holabs\Logger\ILogger;
use Holabs\Logger\Log;
use Nette\SmartObject;
use Nette\Utils\ArrayList;
use Tracy\IBarPanel;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>, Tomáš Holan [www.tomasholan.eu]
 * @package      holabs/logger
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
class LoggerPanel implements IBarPanel {

	use SmartObject;

	/** @var ArrayList|Log[] */
	private $logs;

	/** @var Integer */
	private $count = 0;

	/** @var String Logger class */
	private $name;

	/** @var String Storage class */
	private $storage;


	/**
	 * @param ILogger $logger
	 */
	public function __construct(ILogger $logger) {
		$this->logs = new ArrayList;
		$logger->onLog[] = [$this, 'registerLog'];
		$this->name = get_class($logger);
		$this->storage = get_class($logger->getStorage());
	}

	/**
	 * @param ILogger $logger
	 * @param Log     $log
	 */
	public function registerLog(ILogger $logger, Log $log) {
		$this->count++;
		$this->logs[] = $log;
	}

	public function getTab() {
		$logs = $this->logs;
		$count = $this->count;
		ob_start();
		require __DIR__ . '/templates/LoggerTab.phtml';

		return ob_get_clean();
	}

	public function getPanel() {

		if (!$this->count) {
			return;
		}

		$logs = $this->logs;
		$count = $this->count;
		$name = $this->name;
		$storage = $this->storage;

		ob_start();
		require __DIR__ . '/templates/LoggerPanel.phtml';

		return ob_get_clean();
	}

}
