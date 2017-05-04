<?php

namespace Sebwas\MacroableBlueprint;

use Illuminate\Database\Schema\Builder;
use Sebwas\MacroableBlueprint\Blueprint;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->app->make(Builder::class)->blueprintResolver(
			function($table, Closure $callback = null) {
				return new Blueprint($table, $callback);
			}
		);
	}
}
