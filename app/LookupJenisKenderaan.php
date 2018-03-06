<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupJenisKenderaan extends Model
{
	protected $table = 'lookup_jenis_kenderaan';

	protected $fillable = [
		'nama'
	];

	// belong
	public function kenderaan() { return $this->belongsTo(Kenderaan::class); }
}
