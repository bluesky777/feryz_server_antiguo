<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccidenteTrabajo extends Model {
	protected $table = 'accid_trabajo';

	use SoftDeletes;
	protected $softDelete = true;
}