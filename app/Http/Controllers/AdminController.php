<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Laporan;
use App\Kenderaan;
use App\LookupFakulti;
use App\LookupJenisKenderaan;
use App\LookupKolej;
use App\LookupKursus;
use App\LookupStatusLaporan;
use App\Pelajar;
use App\Pekerja;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		if(Auth::check()) {
			$admin = Auth::user();

			if($admin['log_pertama'] == 1)
				return redirect()->route('admin.form.ubah_katalaluan');
			else
				return redirect()->route('admin.dashboard');
		} else
    		return view('auth.log_masuk')->with([
    			'message' => null,
			    'password' => null
		    ]);
    }

    public function showDashboard() {
        if(Auth::check()) {
	        $allLaporan = Laporan::all();

	        $laporanList = null;
	        foreach($allLaporan as $laporan) {
		        $lookupStatusLaporan = LookupStatusLaporan::all()->find($laporan['status_laporan']);
		        $kenderaan = Kenderaan::all()->find($laporan['kenderaan']);
		        $lookupJenisKenderaan = LookupJenisKenderaan::all()->find($kenderaan['jenis_kenderaan']);

		        $noKenderaan = $kenderaan['no_kenderaan'];
		        $jenisKenderaan = $lookupJenisKenderaan['nama'];
				$statusLaporan = $lookupStatusLaporan['nama'];
				
				if($laporan['imej_staf'] != null) {
					$laporanList[] = [
						'id' => $laporan['id'],
						'imej' => $laporan['imej_staf'],
						'tempat' => $laporan['tempat'],
						'no_kenderaan' => $noKenderaan,
						'jenis_kenderaan' => $jenisKenderaan,
						'status_laporan' => $statusLaporan,
						'tarikh' => $laporan['created_at']
					];
				} else {
					$laporanList[] = [
						'id' => $laporan['id'],
						'imej' => $laporan['imej_polis'],
						'tempat' => $laporan['tempat'],
						'no_kenderaan' => $noKenderaan,
						'jenis_kenderaan' => $jenisKenderaan,
						'status_laporan' => $statusLaporan,
						'tarikh' => $laporan['created_at']
					];
				}
			}
			
			return view('admin.dashboard')->with([
				'daftar' => 0,
				'laporanList' => $laporanList
			]);
        } else
	        return view('auth.log_masuk')->with([
    			'message' => 'Sila log masuk dahulu',
			    'password' => null
		    ]);
	}
	
	// reset password
	public function showUbahKatalaluan() {
		return redirect()->route('admin.profil');
	}

	public function ubahKatalaluan(Request $request) {
		// get request input
		$curPass = $request['cur_pass'];
		$newPass = $request['new_pass'];
		
		$pekerja = Pekerja::all()->find(Auth::user()['id']);

		if(Hash::check($curPass, $pekerja->password)) {
			if($pekerja->log_pertama)
				$pekerja->log_pertama = 0;
			$pekerja->password = bcrypt($newPass);
			$pekerja->save();

			return redirect('/');
		} else
			return redirect()->route('admin.profil');
	}

    // show info
	public function showPelajar($id) {
		if(Auth::check()) {
			$pelajar = Pelajar::all()->find($id);
			$kursus = LookupKursus::all()->find($pelajar['kursus']);
			$fakulti = LookupFakulti::all()->find($pelajar['fakulti']);
			$kolej = LookupKolej::all()->find($pelajar['kolej']);

			return view('info.info_pelajar')->with([
				'infoPelajar' => [
					'pelajar_nama' => $pelajar['nama'],
					'pelajar_no' => $pelajar['no_pelajar'],
					'pelajar_kursus_kod' => $kursus['kod'],
					'pelajar_kursus_nama' => $kursus['nama'],
					'pelajar_fakulti' => $fakulti['nama'],
					'pelajar_kolej' => $kolej['nama']
				]
			]);
		} else
			return view('auth.log_masuk')->with([
    			'message' => 'Sila log masuk dahulu',
			    'password' => null
		    ]);
	}

	// jadualkan laporan
	public function jadualkanLaporan(Request $request) {
    	if(Auth::check()) {
			$laporanId = $request['laporan_id'];
			$adminId = $request['admin_id'];
			$polisId = $request['polis_id'];
	
			$laporan = Laporan::all()->find($laporanId);
			$laporan->fill([
				'admin_id' => $adminId,
				'polis_id' => $polisId,
				'status_laporan' => 2
			]);
			$laporan->save();
	
			return redirect('admin/laporan/' . $laporanId);
		} else
			return view('auth.log_masuk')->with([
    			'message' => 'Sila log masuk dahulu',
			    'password' => null
		    ]);
	}

	// langsaikan hutang
	public function tutupKes(Request $request) {
		if(Auth::check()) {
			$laporanId = $request['laporan_id'];
			$adminId = $request['admin_id'];

			$statusLaporan = null;
			$statusLaporanAll = LookupStatusLaporan::all()->where("nama", "LIKE", "DITUTUP");
			foreach($statusLaporanAll as $status)
				$statusLaporan = $status;

			$laporan = Laporan::all()->find($laporanId);
			$laporan->fill([
				'admin_id' => $adminId,
				'status_laporan' => $statusLaporan['id']
			]);
			$laporan->save();
			
			return redirect('admin/laporan/' . $laporanId);
		} else {
			return view('auth.log_masuk')->with([
				'message' => 'Sila log masuk dahulu',
				'password' => null
			]);
		}
	}
}
