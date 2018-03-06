<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kesalahan extends Model
{
	protected $table = 'kesalahan';

	protected $fillable = [
		'laporan_id', 'jenis_kesalahan'
	];

	// belongs
	public function laporan() { return $this->belongsTo(Laporan::class); }

	// has
	public function jenis_kesalahan() { return $this->hasOne(LookupJenisKesalahan::class); }
}
