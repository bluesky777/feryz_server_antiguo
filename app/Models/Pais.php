<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pais extends Model {
	protected $table = 'paises';

	use SoftDeletes;
	protected $softDelete = true;
	protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}