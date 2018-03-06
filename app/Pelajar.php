<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelajar extends Model
{
	protected $table = 'pelajar';

	protected $fillable = [
		'no_pelajar', 'nama', 'kursus', 'fakulti', 'kolej'
	];

	// has
	public function laporan() { return $this->hasMany(Laporan::class); }
	public function kursus() { return $this->hasOne(LookupKursus::class); }
	public function fakulti() { return $this->hasOne(LookupFakulti::class); }
	public function kolej() { return $this->hasOne(LookupKolej::class); }
}
