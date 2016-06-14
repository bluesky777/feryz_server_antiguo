<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamenFisico extends Model {
	protected $table = 'examen_fisico';

	use SoftDeletes;
	protected $softDelete = true;
}