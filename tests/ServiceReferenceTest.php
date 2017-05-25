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
	public function testDump()
	{
		$id = uniqid();
		$reference = new ServiceReference($id);
		$dump = var_export($reference, true);

		$r = eval("return $dump;");

		$this->assertInstanceOf(ServiceReference::class, $r);
		$this->assertSame($id, (string) $r);
	}

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

	public function testCall()
	{
		$service_id = uniqid();
		$service = new SampleService();
		$value = uniqid();

		$provider = function ($id) use ($service_id, $service) {

			if ($id === $service_id)
			{
				return $service;
			}

			return null;
		};

		ServiceProvider::define($provider);

		/* @var $reference SampleService */

		$reference = new ServiceReference($service_id);
		$this->assertSame($value, $reference->do_something($value));
	}

	public function testHelper()
	{
		$id = uniqid();
		$reference = ref($id);

		$this->assertInstanceOf(ServiceReference::class, $reference);
		$this->assertSame($id, (string) $reference);
	}
}
