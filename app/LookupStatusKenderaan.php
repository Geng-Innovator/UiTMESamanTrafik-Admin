<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupStatusKenderaan extends Model
{
	protected $table = 'lookup_status_kenderaan';

	protected $fillable = [
		'nama'
	];

	// belong
	public function kenderaan() { return $this->belongsTo(Kenderaan::class); }
}
