# Service

[![Release](https://img.shields.io/packagist/v/ICanBoogie/Service.svg)](https://packagist.org/packages/ICanBoogie/Service)
[![Build Status](https://img.shields.io/travis/ICanBoogie/Service.svg)](http://travis-ci.org/ICanBoogie/Service)
[![Code Quality](https://img.shields.io/scrutinizer/g/ICanBoogie/Service.svg)](https://scrutinizer-ci.com/g/ICanBoogie/Service)
[![Code Coverage](https://img.shields.io/coveralls/ICanBoogie/Service.svg)](https://coveralls.io/r/ICanBoogie/Service)
[![Packagist](https://img.shields.io/packagist/dt/ICanBoogie/Service.svg)](https://packagist.org/packages/ICanBoogie/Service)

**ICanBoogie/Service** provides means to reference, resolve, and invoke services using your favorite
dependency injection container, in the most transparent way possible.

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





## References are callables

Service references created with `ref` are especially useful when you need to provide a callable
but you don't want that callable to be instantiated right away:

```php
<?php

use function ICanBoogie\Service\ref;

class Compute
{
	public function __construct(callable $computer)
	{
		// …
	}

	// …
}

$compute = new Compute(ref('expansive_instance'));
```





## References can be exported

[ServiceReference][] instances can safely be exported with `var_export()`:

```php
<?php

use ICanBoogie\Service\ServiceReference;

$id = 'my_service';
$reference = new ServiceReference($id);
$dump = var_export($reference, true);

$r = eval("return $dump;");

echo get_class($r);   // ICanBoogie\Service\ServiceReference 
echo (string) $r;     // my_service
```





----------





## Requirements

The package requires PHP 5.6 or later.





## Installation

The recommended way to install this package is through [Composer](http://getcomposer.org/):

	$ composer require ICanBoogie/Service





### Cloning the repository

The package is [available on GitHub](https://github.com/ICanBoogie/Service), its repository can be
cloned with the following command line:

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

[![Build Status](https://img.shields.io/travis/ICanBoogie/Service.svg)](http://travis-ci.org/ICanBoogie/Service)
[![Code Coverage](https://img.shields.io/coveralls/ICanBoogie/Service.svg)](https://coveralls.io/r/ICanBoogie/Service)





## License

**ICanBoogie/Service** is licensed under the New BSD License - See the [LICENSE](LICENSE) file for details.





[documentation]:    https://icanboogie.org/api/service/master/
[ServiceReference]: https://icanboogie.org/api/service/master/class-ICanBoogie.Service.ServiceReference.html
