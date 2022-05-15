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
 * Creates a service reference.
 */
function ref(string $id): ServiceReference
{
	return new ServiceReference($id);
}
