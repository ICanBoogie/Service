# Service

[![Release](https://img.shields.io/packagist/v/ICanBoogie/Service.svg)](https://packagist.org/packages/ICanBoogie/Service)
[![Build Status](https://img.shields.io/travis/ICanBoogie/Service/master.svg)](http://travis-ci.org/ICanBoogie/Service)
[![HHVM](https://img.shields.io/hhvm/ICanBoogie/Service.svg)](http://hhvm.h4cc.de/package/ICanBoogie/Service)
[![Code Quality](https://img.shields.io/scrutinizer/g/ICanBoogie/Service/master.svg)](https://scrutinizer-ci.com/g/ICanBoogie/Service)
[![Code Coverage](https://img.shields.io/coveralls/ICanBoogie/Service/master.svg)](https://coveralls.io/r/ICanBoogie/Service)
[![Packagist](https://img.shields.io/packagist/dt/ICanBoogie/Service.svg)](https://packagist.org/packages/ICanBoogie/Service)

The **ICanBoogie/Service** package provides means to reference, resolve, and invoke services using
your favorite dependency injection container, in the most transparent way possible.

Please, consider the following example:

```php
<?php

use ICanBoogie\Service\ServiceProvider;
use function ICanBoogie\Service\ref;

ServiceProvider::define(function ($id) {

	if ($id === 'hello')
	{
		return function ($name = "world") {
			return "Hello $name!";
		};
	}

	throw new \LogicException("Unknown service: $id");
});

# getting a service through the provider
$service = ServiceProvider::provide('hello');
echo $service("Madonna");
// Hello Madonna!

# using a reference
$reference = ref('hello');
echo $reference;
// hello
echo $reference("Madonna");
// Hello Madonna! 
```

Service references created with `ref` are especially useful when you need to provide a callable
but you don't want that callable to be instantiated right away:

```
<?php

use function ICanBoogie\Service\ref;

$compute = new Compute(ref('expansive_instance'));
```




----------





## Requirements

The package requires PHP 5.6 or later.





## Installation

The recommended way to install this package is through [Composer](http://getcomposer.org/):

```
$ composer require ICanBoogie/Service
```





### Cloning the repository

The package is [available on GitHub](https://github.com/ICanBoogie/Service), its repository can be cloned with the following command line:

	$ git clone https://github.com/ICanBoogie/Service.git





## Documentation

The package is documented as part of the [ICanBoogie][] framework [documentation][]. You can
generate the documentation for the package and its dependencies with the `make doc` command. The
documentation is generated in the `build/docs` directory. [ApiGen](http://apigen.org/) is required.
The directory can later be cleaned with the `make clean` command.





## Testing

The test suite is ran with the `make test` command. [PHPUnit](https://phpunit.de/) and
[Composer](http://getcomposer.org/) need to be globally available to run the suite. The command
installs dependencies as required. The `make test-coverage` command runs test suite and also creates
an HTML coverage report in `build/coverage`. The directory can later be cleaned with the `make
clean` command.

The package is continuously tested by [Travis CI](http://about.travis-ci.org/).

[![Build Status](https://img.shields.io/travis/ICanBoogie/Service/master.svg)](http://travis-ci.org/ICanBoogie/Service)
[![Code Coverage](https://img.shields.io/coveralls/ICanBoogie/Service/master.svg)](https://coveralls.io/r/ICanBoogie/Service)





## License

**ICanBoogie/Service** is licensed under the New BSD License - See the [LICENSE](LICENSE) file for details.





[documentation]: http://api.icanboogie.org/service/latest/
