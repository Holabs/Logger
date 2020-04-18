<?php

namespace Holabs\Logger\Bridges\Nette;

use Holabs\Logger;
use Holabs\Logger\Storages\TempStorage;
use Nette\DI\CompilerExtension;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/logger
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class LoggerExtension extends CompilerExtension {

	public function loadConfiguration() {

		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('service'))
			->setFactory(Logger::class);

		$builder->addDefinition($this->prefix('storage'))
			->setFactory(TempStorage::class);
	}

}
