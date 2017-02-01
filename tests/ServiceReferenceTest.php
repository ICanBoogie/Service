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

class ServiceReferenceTest extends \PHPUnit_Framework_TestCase
{
	public function testServiceReference()
	{
		$value = uniqid();
		$prefix = uniqid();
		$suffix = uniqid();
		$service_id = uniqid();
		$service = function ($prefix, $suffix) use ($value) {
			return $prefix . $value . $suffix;
		};

		$provider = function ($id) use ($service_id, $service) {

			if ($id === $service_id)
			{
				return $service;
			}

			return null;
		};

		ServiceProvider::define($provider);

		$reference = new ServiceReference($service_id);

		$this->assertSame($service_id, (string) $reference);
		$this->assertSame($service, $reference->resolve());
		$this->assertSame($prefix . $value . $suffix, $reference($prefix, $suffix));
	}

	public function testHelper()
	{
		$id = uniqid();
		$reference = ref($id);

		$this->assertInstanceOf(ServiceReference::class, $reference);
		$this->assertSame($id, (string) $reference);
	}
}