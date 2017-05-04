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
		return parent::connection($name)->blueprintResolver(
			function($table, Closure $callback = null) {
				new Blueprint($table, $callback);
			}
		);
	}

	/**
	 * Get a schema builder instance for the default connection.
	 *
	 * @return \Illuminate\Database\Schema\Builder
	 */
	protected static function getFacadeAccessor() {
		return parent::getFacadeAccessor()->blueprintResolver(
			function($table, Closure $callback = null) {
				new Blueprint($table, $callback);
			}
		);
	}
}
