<?php

namespace Holabs\Logger\Bridges\Nette;

use Holabs\Logger;
use Holabs\Logger\Storages\TempStorage;
use Nette\DI\Extensions\ExtensionsExtension;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/logger
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class LoggerExtension extends ExtensionsExtension {

	public function loadConfiguration() {

		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('service'))
			->setFactory(Logger::class);

		$builder->addDefinition($this->prefix('storage'))
			->setFactory(TempStorage::class);
	}

}