<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kenderaan extends Model
{
	protected $table = 'kenderaan';

	protected $fillable = [
		'no_kenderaan', 'jenis_kenderaan', 'status_kenderaan'
	];

	// belongs
	public function laporan() { return $this->belongsTo(Laporan::class); }

	// has
	public function jenis_kenderaan() { return $this->hasOne(LookupJenisKenderaan::class); }
	public function status_kenderaan() { return $this->hasOne(LookupStatusKenderaan::class); }
}
