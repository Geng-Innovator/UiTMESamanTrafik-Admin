<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pekerja extends Authenticatable
{
    use Notifiable;

    protected $table = 'pekerja';

    protected $fillable = [
        'nama', 'emel', 'password',
        'no_pekerja', 'no_ic', 'no_tel_hp', 'no_tel_pej',
        'log_pertama', 'jawatan', 'jenis_pekerja'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    // has
    public function admin() { return $this->hasOne(Admin::class); }
    public function polis() { return $this->hasOne(Polis::class); }
    public function staf() { return $this->hasOne(Staf::class); }
    public function jawatan() { return $this->hasOne(LookupJawatan::class); }
    public function jenis_pekerja() { return $this->hasOne(LookupJenisPekerja::class); }
}
