<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupJenisPekerja extends Model
{
	protected $table = 'lookup_jenis_pekerja';

	protected $fillable = [
		'nama'
	];

	// belong
	public function pekerja() { return $this->belongsTo(Pekerja::class); }
}
