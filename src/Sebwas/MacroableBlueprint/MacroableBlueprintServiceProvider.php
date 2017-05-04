<?php

namespace Sebwas\MacroableBlueprint;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Sebwas\MacroableBlueprint\MacroableBlueprint;

class MacroableBlueprintServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->app->make(Builder::class)->blueprintResolver(
			function($table, Closure $callback = null) {
				return new MacroableBlueprint($table, $callback);
			}
		);
	}
}
