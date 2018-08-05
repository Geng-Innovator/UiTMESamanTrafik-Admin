<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Kenderaan;
use App\Kesalahan;
use App\Laporan;
use App\LookupJabatan;
use App\LookupJawatan;
use App\LookupJenisKesalahan;
use App\LookupJenisPekerja;
use App\LookupStatusKenderaan;
use App\LookupStatusLaporan;
use App\Staf;
use Carbon\Carbon;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Pekerja;
use App\LookupJenisKenderaan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class StafController extends Controller
{
	// login
    public function login(Request $request) {
    	// get request input
	    $noPekerja = $request['no_pekerja'];
	    $password = $request['password'];

        if(Auth::attempt(['no_pekerja' => $noPekerja, 'password' => $password], false)) {
			$tempPekerjaInfo = Auth::user();
			
			$tempStafInfo = null;
			$tempStafInfoAll = Staf::all()->where('pekerja_id', 'LIKE', $tempPekerjaInfo['id']);
			foreach($tempStafInfoAll as $info)
				$tempStafInfo = $info;

	        return response()->json( [
		        'status' => 1,
		        'data'   => [
		        	'pekerja_id' => $tempPekerjaInfo['id'],
			        'staf_id' => $tempStafInfo['id'],
			        'log_pertama' => $tempPekerjaInfo['log_pertama']
		        ]
	        ] );
        } else
        	return response()->json([
        		'status' => 0
	        ]);
    }

    // reset password
    public function resetPassword(Request $request) {
    	// get request input
	    $stafId = $request['staf_id'];
	    $curPass = $request['cur_pass'];
	    $newPass = $request['new_pass'];

    	$staf = Staf::all()->find($stafId);
        $pekerja = Pekerja::all()->find($staf['pekerja_id']);

        if(Hash::check($curPass, $pekerja->password)) {
			$pekerja->password = bcrypt($newPass);
			if($pekerja->log_pertama)
				$pekerja->log_pertama = 0;
	        $pekerja->save();

			$tempStafInfo = null;
			$tempStafInfoAll = Staf::all()->where('pekerja_id', 'LIKE', $pekerja['id']);
			foreach($tempStafInfoAll as $info)
				$tempStafInfo = $info;

	        return response()->json([
	        	'status' => 1,
		        'data' => [
		        	'pekerja_id' => $pekerja['id'],
			        'staf_id' => $tempStafInfo['id']
		        ]
	        ]);
        } else
        	return response()->json([
        		'status' => 0
	        ]);
	}

	// hantar laporan
	public function showHantarLaporan() {
    	$jenisKenderaanList = LookupJenisKenderaan::all();

    	return response()->json([
    		'status' => 1,
		    'data' => [
		    	'jenisKenderaanList' => $jenisKenderaanList
		    ]
	    ]);
	}

    public function hantarLaporan(Request $request) {
    	// get request input
	    $stafId = $request['staf_id'];
	    $tempat = $request['tempat'];
	    $imejStaf = $request['imej_staf'];
	    $laporanStaf = $request['laporan_staf'];
	    $noSiriPelekat = $request['no_siri_pelekat'];
	    $noKenderaan = $request['no_kenderaan'];
	    $jenisKenderaanId = $request['jenis_kenderaan_id'];

	    // get default id for status laporan & kenderaan
	    $statusKenderaanId = null;
	    $statusLaporanId = null;
    	$statusLaporan = LookupStatusLaporan::all()->where('nama', 'LIKE', 'DILAPORKAN');
    	$statusKenderaan = LookupStatusKenderaan::all()->where('nama', 'LIKE', 'TIADA TINDAKAN');

	    foreach ($statusLaporan as $statLaporan)
	    	$statusLaporanId = $statLaporan['id'];
    	foreach ($statusKenderaan as $statKenderaan)
	    	$statusKenderaanId = $statKenderaan['id'];

    	// process
	    // image process
	    // define file path
	    $destination = public_path() . '/images/uploads/';
	    $fileName = $stafId . '_' . time() . '.png';

	    // insert process
	    $newKenderaan = new Kenderaan();
	    $newKenderaan->fill([
		    'no_kenderaan' => strtoupper($noKenderaan),
		    'jenis_kenderaan' => $jenisKenderaanId,
		    'status_kenderaan' => $statusKenderaanId
	    ]);
	    $newKenderaan->save();

	    $newLaporan = new Laporan();
	    $newLaporan->fill([
		    'staf_id' => $stafId,
		    'admin_id' => null,
		    'polis_id' => null,
		    'pelajar_id' => null,
		    'status_laporan' => $statusLaporanId,
		    'tempat' => strtoupper($tempat),
		    'imej_staf' => asset('images/uploads') . '/' . $fileName,
		    'imej_polis' => null,
		    'laporan_staf' => strtoupper($laporanStaf),
		    'laporan_polis' => null,
		    'no_siri_pelekat' => $noSiriPelekat,
		    'kenderaan' => $newKenderaan->id
	    ]);
	    $newLaporan->save();

		// insert file
		file_put_contents($destination . $fileName, base64_decode($imejStaf));

	    // register
    	return response()->json([
    		'status' => 1,
		    'data' => $newLaporan
	    ]);
    }

    // show methods
	public function showProfil(Request $request) {
    	// get request input
		$stafId = $request['staf_id'];

    	$staf = Staf::all()->find($stafId);
    	$pekerja = Pekerja::all()->find($staf['pekerja_id']);

    	if(empty($pekerja))
		    return response()->json([
		    	'status' => 0
		    ]);
    	else {
    		$jawatan = LookupJawatan::all()->find($pekerja['jawatan']);
    		$jabatan = LookupJabatan::all()->find($staf['jabatan']);
    		$jenisPekerja = LookupJenisPekerja::all()->find($pekerja['jenis_pekerja']);

		    return response()->json([
			    'status' => 1,
			    'data' => [
				    'no_pekerja' => $pekerja['no_pekerja'],
				    'no_ic' => $pekerja['no_ic'],
				    'no_tel_hp' => $pekerja['no_tel_hp'],
				    'no_tel_pej' => $pekerja['no_tel_pej'],
				    'nama' => $pekerja['nama'],
				    'emel' => $pekerja['emel'],
				    'jenis_pekerja' => $jenisPekerja['nama'],
				    'jawatan_nama' => $jawatan['nama'],
				    'jawatan_gred' => $jawatan['gred'],
				    'jabatan' => $jabatan['nama']
			    ]
		    ]);
	    }
	}

	public function showDashboard(Request $request) {
		// get request input
		$stafId = $request['staf_id'];

    	$laporanAll = Laporan::all()->where('staf_id', 'LIKE', $stafId);

		$laporanList = null;
    	foreach($laporanAll as $laporan) {
    		$statusLaporan = LookupStatusLaporan::all()->find($laporan['status_laporan']);

    		$laporanList[] = [
    			'id' => $laporan['id'],
			    'laporan_imej' => $laporan['imej_staf'],
    			'laporan_tempat' => $laporan['tempat'],
			    'laporan_tarikh' => $laporan['created_at']->format('d-m-Y'),
			    'laporan_masa' => $laporan['created_at']->format('H:i:s'),
			    'laporan_status' => $statusLaporan['nama']
		    ];
	    }

		return response()->json([
			'status' => 1,
			'data' => [
				'laporan_list' => $laporanList
			]
		]);
	}

	public function showLaporan(Request $request) {
		// get request input
		$laporanId = $request['laporan_id'];

    	$laporan = Laporan::all()->find($laporanId);

    	if(empty($laporan))
    		return response()->json([
    			'status' => 0
		    ]);
    	else {
		    $kesalahanList = null;
		    $stafImejPath = null;
		    $polisImejPath = null;

    		$statusLaporan = LookupStatusLaporan::all()->find($laporan['status_laporan']);
    		$kenderaan = Kenderaan::all()->find($laporan['kenderaan']);
    		$jenisKenderaan = LookupJenisKenderaan::all()->find($kenderaan['jenis_kenderaan']);
    		$statusKenderaan = LookupStatusKenderaan::all()->find($kenderaan['status_kenderaan']);
    		$kesalahanAll = Kesalahan::all()->where('laporan_id', 'LIKE', $laporan['id']);

    		foreach($kesalahanAll as $kesalahan) {
    			$namaKesalahan = LookupJenisKesalahan::all()->find($kesalahan['jenis_kesalahan']);
    			$kesalahanList[] = $namaKesalahan['nama'];
			}
			
		    if($laporan['imej_staf'] != null)
		    	$stafImejPath = $laporan['imej_staf'];
    		if($laporan['imej_polis'] != null)
    			$polisImejPath = $laporan['imej_polis'];

    		return response()->json([
    			'status' => 1,
			    'data' => [
			    	// laporan
			    	'id' => $laporan['id'],
				    'laporan_status' => $statusLaporan['nama'],
				    'laporan_tarikh' => $laporan['created_at']->format('d-m-Y'),
				    'laporan_masa' => $laporan['created_at']->format('H:i:s'),
				    'laporan_tempat' => $laporan['tempat'],

				    // staf
				    'staf_id' => $laporan['staf_id'],
				    'staf_imej' => $stafImejPath,
				    'staf_penerangan' => $laporan['laporan_staf'],

				    // polis
				    'polis_id' => $laporan['polis_id'],
				    'polis_imej' => $polisImejPath,
				    'polis_penerangan' => $laporan['laporan_polis'],

				    // kenderaan
				    'kenderaan_no' => $kenderaan['no_kenderaan'],
				    'kenderaan_jenis' => $jenisKenderaan['nama'],
				    'kenderaan_status' => $statusKenderaan['nama'],
				    'no_siri_pelekat' => $laporan['no_siri_pelekat'],

				    // kesalahan
				    'kesalahan_list' => $kesalahanList
			    ]
		    ]);
	    }
	}
}
