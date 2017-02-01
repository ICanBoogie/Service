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

/**
 * A representation of a service reference.
 *
 * Can be used to resolve the service or invoke it with some arguments.
 */
final class ServiceReference
{
	/**
	 * @var string
	 */
	private $id;

	/**
	 * @param string $id Service identifier
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->id;
	}

	/**
	 * @param array ...$args
	 *
	 * @return mixed
	 */
	public function __invoke(...$args)
	{
		/* @var $service callable */
		$service = $this->resolve();

		return $service(...$args);
	}

	/**
	 * @return object
	 */
	public function resolve()
	{
		return ServiceProvider::provide($this->id);
	}
}
