<?php

namespace App\Http\Controllers\Auth;

use Mail;

use App\Admin;
use App\LookupJabatan;
use App\LookupJawatan;
use App\LookupJenisPekerja;
use App\LookupPos;
use App\Pekerja;
use App\Http\Controllers\Controller;
use App\Polis;
use App\Staf;
use App\Mail\DaftarMail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
	        'no_pekerja' => 'required|string|max:255|unique:users',
	        'password' => 'required|string|min:6|confirmed',
	        'nama' => 'required|string|max:255',
            'emel' => 'required|string|email|max:255',
            'no_ic' => 'required|string|max:255',
            'no_tel_hp' => 'required|string|max:255',
            'no_tel_pej' => 'required|string|max:255',
            'jawatan' => 'required|string|max:255',
            'jenis_pekerja' => 'required|string|max:255',
	        'log_pertama' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     * @return \App\Pekerja
     */
    protected function create(array $data)
    {
    	$newPekerja = new Pekerja();
        $newPekerja->fill([
	        'no_pekerja' => $data['no_pekerja'],
	        'password' => bcrypt($data['password']),
	        'nama' => $data['nama'],
            'emel' => $data['emel'],
            'no_ic' => $data['no_ic'],
            'no_tel_hp' => $data['no_tel_hp'],
            'no_tel_pej' => $data['no_tel_pej'],
            'jawatan' => $data['jawatan'],
            'jenis_pekerja' => $data['jenis_pekerja'],
	        'log_pertama' => $data['log_pertama']
        ]);
        $newPekerja->save();

        $jenisPekerjaList = LookupJenisPekerja::all();
        foreach ($jenisPekerjaList as $jenisPekerja) {
	        if($jenisPekerja['id'] == $newPekerja['jenis_pekerja']) {
		        switch ($jenisPekerja['nama']) {
			        case 'ADMIN':
			        	$newAdmin = new Admin();
			        	$newAdmin->fill([
			        		'pekerja_id' => $newPekerja['id']
				        ]);
				        $newAdmin->save();
				        break;
			        case 'STAF':
				        $newStaf = new Staf();
				        $newStaf->fill([
					        'pekerja_id' => $newPekerja['id'],
					        'jabatan' => $data['jabatan']
				        ]);
				        $newStaf->save();
				        break;
			        case 'POLIS':
				        $newPolis = new Polis();
				        $newPolis->fill([
					        'pekerja_id' => $newPekerja['id'],
					        'pos' => $data['pos']
				        ]);
				        $newPolis->save();
				        break;
		        }
	        }
        }

        return $newPekerja;
    }

    public function showRegistrationForm() {
    	if(Auth::check()) {
			$jawatanList = LookupJawatan::all();
			$jenisPekerjaList = LookupJenisPekerja::all();
			$jabatanList = LookupJabatan::all();
			$posList = LookupPos::all();

			return view('auth.daftar')
				->with([
					'jawatanList' => $jawatanList,
					'jenisPekerjaList' => $jenisPekerjaList,
					'jabatanList' => $jabatanList,
					'posList' => $posList
				]);
		} else {
			return redirect('/');
		}
    }

	public function register( Request $request ) {
		$jenisPekerjaPolisId = null;
		$jenisPekerjaAdminId = null;
		$jenisPekerjaPolis = LookupJenisPekerja::all()->where('nama', 'LIKE', 'POLIS');
		$jenisPekerjaAdmin = LookupJenisPekerja::all()->where('nama', 'LIKE', 'ADMIN');
		foreach($jenisPekerjaPolis as $jenisPekerja)
			$jenisPekerjaPolisId = $jenisPekerja['id'];
		foreach($jenisPekerjaAdmin as $jenisPekerja)
			$jenisPekerjaAdminId = $jenisPekerja['id'];
			
		$password = str_random(6);
		switch($request['jenis_pekerja']) {
			case $jenisPekerjaAdminId:
				$this->create([
					'no_pekerja' => $request['no_pekerja'],
					'password' => $password,
					'nama' => $request['nama'],
					'emel' => $request['emel'],
					'no_ic' => $request['no_ic'],
					'no_tel_hp' => $request['no_tel_hp'],
					'no_tel_pej' => $request['no_tel_pej'],
					'jawatan' => $request['jawatan'],
					'jenis_pekerja' => $request['jenis_pekerja'],
					'jabatan' => null,
					'pos' => null,
					'log_pertama' => 1
				]);
				break;
			case $jenisPekerjaPolisId:
				$this->create([
					'no_pekerja' => $request['no_pekerja'],
					'password' => $password,
					'nama' => $request['nama'],
					'emel' => $request['emel'],
					'no_ic' => $request['no_ic'],
					'no_tel_hp' => $request['no_tel_hp'],
					'no_tel_pej' => $request['no_tel_pej'],
					'jawatan' => $request['jawatan'],
					'jenis_pekerja' => $request['jenis_pekerja'],
					'jabatan' => null,
					'pos' => $request['pos_id'],
					'log_pertama' => 1
				]);
				break;
			default:
				$this->create([
					'no_pekerja' => $request['no_pekerja'],
					'password' => $password,
					'nama' => $request['nama'],
					'emel' => $request['emel'],
					'no_ic' => $request['no_ic'],
					'no_tel_hp' => $request['no_tel_hp'],
					'no_tel_pej' => $request['no_tel_pej'],
					'jawatan' => $request['jawatan'],
					'jenis_pekerja' => $request['jenis_pekerja'],
					'jabatan' => $request['jabatan_id'],
					'pos' => null,
					'log_pertama' => 1
				]);
				break;
		}

		// hantar emel daftar
		Mail::to($request['emel'])
			->send(new DaftarMail($request['nama'], $request['emel'], $password, $request['no_pekerja']));

		return view('admin.dashboard')->with([
			'daftar' => 1
		]);
	}
}
