<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staf extends Model
{
	protected $table = 'staf';

	protected $fillable = [
		'pekerja_id', 'jabatan'
	];

	// belong
	public function pekerja() { return $this->belongsTo(Pekerja::class); }

	// has
	public function laporan() { return $this->hasMany(Laporan::class); }
	public function jabatan() { return $this->hasOne(LookupJabatan::class); }
}
