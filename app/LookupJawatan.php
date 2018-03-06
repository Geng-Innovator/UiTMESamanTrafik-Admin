<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupJawatan extends Model
{
	protected $table = 'lookup_jawatan';

	protected $fillable = [
		'gred', 'nama'
	];

	// belong
	public function pekerja() { return $this->belongsTo(Pekerja::class); }
}
