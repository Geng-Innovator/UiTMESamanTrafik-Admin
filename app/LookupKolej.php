<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupKolej extends Model
{
	protected $table = 'lookup_kolej';

	protected $fillable = [
		'nama'
	];

	// belong
	public function pelajar() { return $this->belongsTo(Pelajar::class); }
}
