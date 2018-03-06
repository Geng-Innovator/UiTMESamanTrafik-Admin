<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupJenisKesalahan extends Model
{
	protected $table = 'lookup_jenis_kesalahan';

	protected $fillable = [
		'nama'
	];

	// belong
	public function kesalahan() { return $this->belongsTo(Kesalahan::class); }
}
