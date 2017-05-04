<?php

namespace Sebwas\MacroableBlueprint;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Database\Schema\Blueprint as BaseBlueprint;

class Blueprint extends BaseBlueprint {
	use Macroable;
}
