<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
	protected $table = 'laporan';

	protected $fillable = [
		'staf_id', 'admin_id', 'polis_id', 'pelajar_id',
		'status_laporan', 'tarikh_masa', 'tempat',
		'imej_staf', 'imej_polis',
		'laporan_staf', 'laporan_polis',
		'no_siri_pelekat', 'kenderaan'
	];

	// belongs
	public function admin() { return $this->belongsTo(Admin::class); }
	public function polis() { return $this->belongsTo(Polis::class); }
	public function staf() { return $this->belongsTo(Staf::class); }
	public function pelajar() { return $this->belongsTo(Pelajar::class); }

	// has
	public function status_laporan() { return $this->hasOne(LookupStatusLaporan::class); }
	public function kenderaan() { return $this->hasOne(Kenderaan::class); }
	public function kesalahan() { return $this->hasMany(Kesalahan::class); }
}
