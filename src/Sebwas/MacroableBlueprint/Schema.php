<?php

namespace SebWas\MacroableBlueprint;

use SebWas\MacroableBlueprint\Blueprint;
use Illuminate\Support\Facades\Schema as BaseFacade;

class Schema extends BaseFacade {
	/**
	 * Get a schema builder instance for a connection.
	 *
	 * @param  string  $name
	 * @return \Illuminate\Database\Schema\Builder
	 */
	public static function connection($name) {
		$builder = parent::connection($name);

		$builder->blueprintResolver(
			function($table, Closure $callback = null) {
				return new Blueprint($table, $callback);
			}
		);

		return $builder;
	}

	/**
	 * Get a schema builder instance for the default connection.
	 *
	 * @return \Illuminate\Database\Schema\Builder
	 */
	protected static function getFacadeAccessor() {
		$builder = parent::getFacadeAccessor();

		$builder->blueprintResolver(
			function($table, Closure $callback = null) {
				return new Blueprint($table, $callback);
			}
		);

		return $builder;
	}
}
