<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LookupStatusLaporan extends Model
{
	protected $table = 'lookup_status_laporan';

	protected $fillable = [
		'nama'
	];

	// belong
	public function laporan() { return $this->belongsTo(Laporan::class); }
}
