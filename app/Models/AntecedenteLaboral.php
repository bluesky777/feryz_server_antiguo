<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AntecedenteLaboral extends Model {
	protected $table = 'antec_laborales';

	use SoftDeletes;
	protected $softDelete = true;
}