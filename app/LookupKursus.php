<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupKursus extends Model
{
	protected $table = 'lookup_kursus';

	protected $fillable = [
		'kod', 'nama'
	];

	// belong
	public function pelajar() { return $this->belongsTo(Pelajar::class); }
}
