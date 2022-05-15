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

final class ServiceProvider
{
	/**
	 * @var callable
	 */
	static private $provider;

	/**
	 * Define the service provider.
	 *
	 * @return callable|null The previous provider, or `null` if none was defined.
	 */
	static public function define(callable $provider): ?callable
	{
		$previous = self::$provider;

		self::$provider = $provider;

		return $previous;
	}

	/**
	 * Return the current provider.
	 */
	static public function defined(): ?callable
	{
		return self::$provider;
	}

	/**
	 * Undefine the provider.
	 */
	static public function undefine(): void
	{
		self::$provider = null;
	}

	/**
	 * Return a service.
	 *
	 * @param string $id Service identifier.
	 */
	static public function provide(string $id): object
	{
		$provider = self::$provider;

		if (!$provider)
		{
			throw new \LogicException("No provider is defined yet. Please define one with `ServiceProvider::define(\$provider)`.");
		}

		return $provider($id);
	}
}
