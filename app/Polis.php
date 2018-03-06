<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polis extends Model
{
	protected $table = 'polis';

	protected $fillable = [
		'pekerja_id', 'pos'
	];

	// belong
	public function pekerja() { return $this->belongsTo(Pekerja::class); }

	// has
	public function laporan() { return $this->hasMany(Laporan::class); }
	public function pos() { return $this->hasOne(LookupPos::class); }
}
