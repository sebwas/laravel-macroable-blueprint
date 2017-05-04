Laravel macroable blueprint
===========================

The [`Illuminate\Database\Schema\Blueprint`](https://laravel.com/api/master/Illuminate/Database/Schema/Blueprint.html) class can do a lot. However, you might find yourself in a situation where you need a certain partial schema in your migrations over and over again. Unfortunately, the `Blueprint` class does not provide any one functionality to create reusable pieces these.

Installation
------------

The installation is as simple as `composer require sebwas/laravel-macroable-blueprint`.

Usage
-----

To use the macroable blueprint, you need to put the service provider in your `config/app.php` file.

```php
// ...
		Sebwas\MacroableBlueprint\ServiceProvider::class,
// ...
```

To define the macros, simply call the macro method on the MacroableBlueprint class, like you're probably used to from other macroable classes from the `bootstrap/app.php` file. The callback is bound to the `Blueprint` class, thus can interact with it using `$this` (instead of the usual `$table` variable name).

Example
-------

In your `bootstrap/app.php`:

```php
// ...

Sebwas\MacroableBlueprint\Blueprint::macro('social', function (array $providers, bool $bypassCheck = false) {
	if (!$bypassCheck) {
		$providers = array_intersect(
			['google', 'facebook', 'bitbucket', 'github', 'twitter', 'linkedin'], // Valid providers
			$providers
		);
	}

	foreach ($providers as $provider) {
		$this->string("{$provider}_id")->nullable()->unique();
	}
});

// ...
```

In your migration file, e.g. `database/migrations/2014_10_12_000000_create_users_table.php`:

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->social(['google', 'facebook']);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
```

Disclaimer
----------

Please don't get upset about my coding style. It's called a _style_ on purpose.
