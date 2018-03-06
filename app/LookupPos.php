<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupPos extends Model
{
	protected $table = 'lookup_pos';

	protected $fillable = [
		'nama'
	];

	// belong
	public function polis() { return $this->belongsTo(Polis::class); }
}
