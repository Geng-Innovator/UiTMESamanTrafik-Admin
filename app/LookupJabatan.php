<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupJabatan extends Model
{
	protected $table = 'lookup_jabatan';

	protected $fillable = [
		'nama'
	];

	// belong
	public function staf() { return $this->belongsTo(Staf::class); }
}
