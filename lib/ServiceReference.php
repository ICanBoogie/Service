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
	 * @param array $properties
	 *
	 * @return ServiceReference
	 */
	static public function __set_state(array $properties)
	{
		return new self($properties['id']);
	}

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
	 * @param string $name
	 * @param array $arguments
	 */
	public function __call($name, array $arguments)
	{
		return $this->resolve()->$name(...$arguments);
	}

	/**
	 * @return object
	 */
	public function resolve()
	{
		return ServiceProvider::provide($this->id);
	}
}
