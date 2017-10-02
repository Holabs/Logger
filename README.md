Holabs/Logger
===============

Easy logging class for maps user's/system activity or debugging.

Logging:
 - action (Defined by developer)
 - parameters (Defined by developer)
 - REMOTE_ADDRESS (auto)
 - User-Agent (auto)
 - User ID (auto if logged in)

Installation
------------

**Requirements:**
 - php 7.1+
 - [nette/utils](https://github.com/nette/utils)
 
**Optional:**
 - [nette/database](https://github.com/nette/database) (for persist your logs)
 - [tracy/tracy](https://github.com/tracy/tracy) (for live preview your logs)
 
```sh
composer require holabs/logger
composer require nette/database	# optional
composer require tracy/tracy	# optional
```

Configuration
-------------
```yaml
extensions:
	holabs.logger: Holabs\Logger\Bridges\Nette\LoggerExtension
	
tracy:
	bar:
		- Holabs\Logger\Bridges\Tracy\LoggerPanel

# Optional if you want to persist(or change for your own storage) your logs over nette database
services:
	# Holabs\Logger\Storages\IStorage
	holabs.logger.storage: Holabs\Logger\Storages\NetteDatabaseStorage('tablename')
```

You can choose your storage or use predefined.

Using
-----
Your **BasePresenter** or some component now can looks like this:

```php
<?php

namespace App\Presenters;

use Holabs\Logger\TLogger;
use Nette\Application\UI\Presenter;


abstract class BasePresenter extends Presenter {

	// Inject property $logger and create LOG method
	use TLogger;

	public function startup() {
		parent::startup();

		$this->log('test', ['testing']);
	}

}
```