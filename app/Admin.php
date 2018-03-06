<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	protected $table = 'admin';

	protected $fillable = [
		'pekerja_id'
	];

	// belong
	public function pekerja() { return $this->belongsTo(Pekerja::class); }

	// has
	public function laporan() { return $this->hasMany(Laporan::class); }
}
