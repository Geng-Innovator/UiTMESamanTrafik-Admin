<?php

namespace App\Http\Controllers;

use App\Kenderaan;
use App\Kesalahan;
use App\Laporan;
use App\LookupFakulti;
use App\LookupJawatan;
use App\LookupJenisKenderaan;
use App\LookupJenisKesalahan;
use App\LookupJenisPekerja;
use App\LookupKolej;
use App\LookupKursus;
use App\LookupPos;
use App\LookupStatusKenderaan;
use App\LookupStatusLaporan;
use App\Pekerja;
use App\Pelajar;
use App\Polis;
use App\Staf;
use Carbon\Carbon;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PolisController extends Controller
{
	public function login(Request $request) {
		// get request input
		$noPekerja = $request['no_pekerja'];
		$password = $request['password'];

		if(Auth::attempt(['no_pekerja' => $noPekerja, 'password' => $password], false)) {
			$tempPekerjaInfo = Auth::user();

			$tempPolisInfo = null;
			$tempPolisInfoAll = Polis::all()->where('pekerja_id', 'LIKE', $tempPekerjaInfo['id']);
			foreach($tempPolisInfoAll as $info)
				$tempPolisInfo = $info;

			return response()->json([
				'status' => 1,
				'data' => [
					'pekerja_id' => $tempPekerjaInfo['id'],
					'polis_id' => $tempPolisInfo['id'],
					'log_pertama' => $tempPekerjaInfo['log_pertama']
				]
			]);
		} else
			return response()->json([
				'status' => 0
			]);
	}

	public function resetPassword(Request $request) {
		// get request input
		$polisId = $request['polis_id'];
		$curPass = $request['cur_pass'];
		$newPass = $request['new_pass'];

		$polis = Polis::all()->find($polisId);
		$pekerja = Pekerja::all()->find($polis['pekerja_id']);

		if(Hash::check($curPass, $pekerja->password)) {
			$pekerja->password = bcrypt($newPass);
			if($pekerja->log_pertama)
				$pekerja->log_pertama = 0;
			$pekerja->save();

			return response()->json([
				'status' => 1,
				'data' => $pekerja
			]);
		} else
			return response()->json([
				'status' => 0
			]);
	}

	public function showMaklumBalas() {
		$tindakanList = LookupStatusKenderaan::all();
		$kesalahanList = LookupJenisKesalahan::all();
		$fakultiList = LookupFakulti::all();
		$kursusList = LookupKursus::all();
		$kolejList = LookupKolej::all();

		return response()->json([
			'status' => 1,
			'data' => [
				'tindakan_list' => $tindakanList,
				'kesalahan_list' => $kesalahanList,
				'fakulti_list' => $fakultiList,
				'kursus_list' => $kursusList,
				'kolej_list' => $kolejList
			]
		]);
	}

	public function maklumBalas(Request $request) {
		// get request input
		$laporanId = $request['laporan_id'];
		$polisId = $request['polis_id'];
		$imejPolis = $request['polis_imej'];
		$statusKenderaanId = $request['status_kenderaan_id'];
		$kesalahanListId = json_decode($request['kesalahan_list_id']);
		$peneranganPolis = $request['penerangan_polis'];
		$noPelajar = $request['pelajar_no'];
		$namaPelajar = $request['pelajar_nama'];
		$kursusPelajar = $request['pelajar_kursus_id'];
		$kolejPelajar = $request['pelajar_kolej_id'];
		$fakultiPelajar = $request['pelajar_fakulti_id'];

		// get lookup value
		$statusLaporanId = null;
		$statusLaporan = LookupStatusLaporan::all()->where('nama', 'LIKE', 'DIKUATKUASAKAN');
		foreach ($statusLaporan as $statLaporan)
			$statusLaporanId = $statLaporan['id'];

		// define file path
		$destination = base_path() . '\\public\\images\\uploads\\';
		$fileName = $laporanId . '_' . $polisId . '_' . time() . '.png';

		// update database
		$pelajarId = null;
		if($noPelajar != null) {
			// register pelajar
			$pelajar = Pelajar::create([
				'no_pelajar' => $noPelajar,
				'nama' => $namaPelajar,
				'kursus' => $kursusPelajar,
				'kolej' => $kolejPelajar,
				'fakulti' => $fakultiPelajar
			]);
			$pelajarId = $pelajar->id;
		}

		// update laporan
		$laporan = Laporan::all()->find($laporanId);
		$laporan->fill([
			'pelajar_id' => $pelajarId,
			'status_laporan' => $statusLaporanId,
			'imej_polis'=> $fileName,
			'laporan_polis' => $peneranganPolis
		]);
		$laporan->save();

		foreach($kesalahanListId as $kesalahanId) {
			$kesalahan = new Kesalahan();
			$kesalahan->fill([
				'laporan_id' => $laporanId,
				'jenis_kesalahan' => $kesalahanId
			]);
			$kesalahan->save();
		}

		$kenderaan = Kenderaan::all()->find($laporanId);
		$kenderaan->fill([
			'status_kenderaan' => $statusKenderaanId
		]);
		$kenderaan->save();

		// insert file
		file_put_contents($destination . $fileName, base64_decode($imejPolis));

		// return back full laporan data
		$returnStafPath = null;
		$returnPolisPath = null;

		$returnLaporan = Laporan::all()->find($laporanId);
		$returnStaf = Staf::all()->find($returnLaporan['staf_id']);
		$returnPolis = Polis::all()->find($returnLaporan['polis_id']);
		$returnStafPekerja = Pekerja::all()->find($returnStaf['pekerja_id']);
		$returnPekerjaPolis = Pekerja::all()->find($returnPolis['pekerja_id']);
		$returnStafPath = asset('/images/uploads/' . $returnLaporan['imej_staf']);
		$returnPolisPath = asset('/images/uploads/' . $returnLaporan['imej_polis']);
		$returnKenderaan = Kenderaan::all()->find($returnLaporan['kenderaan']);
		$returnjenisKenderaan = LookupJenisKenderaan::all()->find($returnKenderaan['jenis_kenderaan']);
		$returnStatusKenderaan = LookupStatusKenderaan::all()->find($returnKenderaan['status_kenderaan']);
		$returnKesalahan = Kesalahan::all()->where('laporan_id', 'LIKE', $returnLaporan['id']);

		$returnKesalahanList = null;
		foreach($returnKesalahan as $kesalahan) {
			$tempJenisKesalahan = LookupJenisKesalahan::all()->find($kesalahan['jenis_kesalahan']);

			$returnKesalahanList[] = $tempJenisKesalahan['nama'];
		}

		if($returnLaporan['imej_staf'] != null)
			$returnStafPath = asset('/images/uploads/' . $returnLaporan['imej_staf']);
		if($returnLaporan['imej_polis'] != null)
			$returnPolisPath = asset('/images/uploads/' . $returnLaporan['imej_polis']);

		return response()->json([
			'status' => 1,
			'data' => [
				// laporan
				'id' => $returnLaporan['id'],
				'laporan_status' => $returnLaporan['status_laporan'],
				'laporan_tarikh' => $returnLaporan['created_at']->format('d-m-Y'),
				'laporan_masa' => $returnLaporan['created_at']->format('H:i:s'),
				'laporan_tempat' => $returnLaporan['tempat'],
				'laporan_staf' => $returnLaporan['laporan_staf'],
				'laporan_polis' => $returnLaporan['laporan_polis'],

				// staf
				'staf_id' => $returnStaf['id'],
				'staf_nama' => $returnStafPekerja['nama'],
				'staf_imej' => $returnStafPath,

				// polis
				'polis_id' => $returnPolis['id'],
				'polis_nama' => $returnPekerjaPolis['nama'],
				'polis_imej' => $returnPolisPath,

				// kenderaan
				'kenderaan_no' => $returnKenderaan['no_kenderaan'],
				'no_siri_pelekat' => $returnLaporan['no_siri_pelekat'],
				'kenderaan_jenis' => $returnjenisKenderaan['nama'],
				'kenderaan_status' => $returnStatusKenderaan['nama'],

				// kesalahan
				'kesalahan_list' => $returnKesalahanList
			]
		]);
	}

	public function showDashboard(Request $request) {
		// get request input
		$polisId = $request['polis_id'];

		$laporanDitutup = null;
		$laporanStatusAll = LookupStatusLaporan::all()->where('nama', 'LIKE', 'DITUTUP');
		foreach($laporanStatusAll as $laporanStatus)
			$laporanDitutup = $laporanStatus;

		// filter, hanya yang dijadualkan shj ditunjuk
		$laporanAll = Laporan::all()
			->where('polis_id', 'LIKE', $polisId)
			->where('status_laporan', '<>', $laporanDitutup['id']);

		$laporanList = null;
		foreach($laporanAll as $laporan) {
			$statusLaporan = LookupStatusLaporan::all()->find($laporan['status_laporan']);

			$laporanList[] = [
				'id' => $laporan['id'],
				'laporan_imej' => base64_encode(file_get_contents(base_path() . '\\public\\images\\uploads\\' . $laporan['imej_staf'])),
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

	public function  showProfil(Request $request) {
		// get request input
		$polisId = $request['polis_id'];

		$polis = Polis::all()->find($polisId);
		$pekerja = Pekerja::all()->find($polis['pekerja_id']);

		if(empty($pekerja))
			return response()->json([
				'status' => 0
			]);
		else {
			$pos = LookupPos::all()->find($polis['pos']);
			$jenisPekerja = LookupJenisPekerja::all()->find($pekerja['jenis_pekerja']);
			$jawatan = LookupJawatan::all()->find($pekerja['jawatan']);

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
					'pos' => $pos['nama']
				]
			]);
		}
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
			$stafImejPath = null;
			$polisImejPath = null;

			$statusLaporan = LookupStatusLaporan::all()->find($laporan['status_laporan']);

			$kenderaan = Kenderaan::all()->find($laporan['kenderaan']);
			$jenisKenderaan = LookupJenisKenderaan::all()->find($kenderaan['jenis_kenderaan']);
			$statusKenderaan = LookupStatusKenderaan::all()->find($kenderaan['status_kenderaan']);

			$kesalahanAll = Kesalahan::all()->where('laporan_id', 'LIKE', $laporan['id']);

			$kesalahanList = null;
			foreach($kesalahanAll as $kesalahan) {
				$namaKesalahan = LookupJenisKesalahan::all()->find($kesalahan['jenis_kesalahan']);

				$kesalahanList[] = $namaKesalahan['nama'];
			}

			if($laporan['imej_staf'] != null)
				$stafImejPath = asset('/images/' . $laporan['imej_staf']);
			if($laporan['imej_polis'] != null)
				$polisImejPath = asset('/images/' . $laporan['imej_polis']);

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
