<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnfermedadProfesional extends Model {
	protected $table = 'enfermedades_prof';

	use SoftDeletes;
	protected $softDelete = true;
}