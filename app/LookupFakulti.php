<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupFakulti extends Model
{
	protected $table = 'lookup_fakulti';

	protected $fillable = [
		'nama'
	];

	// belong
	public function pelajar() { return $this->belongsTo(Pelajar::class); }
}
