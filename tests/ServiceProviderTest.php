<?php

/*
 * This file is part of the ICanBoogie package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ICanBoogie\Service;

class ServiceProviderTest extends \PHPUnit_Framework_TestCase
{
	public function testServiceProvider()
	{
		$service = function () {};
		$service_id = uniqid();

		$provider = function ($id) use ($service, $service_id) {

			if ($id === $service_id)
			{
				return $service;
			}

			return null;
		};

		ServiceProvider::define($provider);

		$this->assertSame($provider, ServiceProvider::defined());
		$this->assertSame($service, ServiceProvider::provide($service_id));
		$this->assertSame($provider, ServiceProvider::define(function () {}));

		ServiceProvider::undefine();

		$this->expectException(\LogicException::class);
		ServiceProvider::provide($service_id);
	}
}
