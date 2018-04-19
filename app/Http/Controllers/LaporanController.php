<?php

namespace App\Http\Controllers;

use App\Kenderaan;
use App\Kesalahan;
use App\Laporan;
use App\LookupJenisKenderaan;
use App\LookupJenisKesalahan;
use App\LookupJenisPekerja;
use App\LookupPos;
use App\LookupStatusKenderaan;
use App\LookupStatusLaporan;
use App\Pekerja;
use App\Pelajar;
use App\Polis;
use App\Staf;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Break_;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('laporan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return Laporan|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	// image process
	    $destination = base_path() . '/public/images/uploads/';

	    if(isset($request['imej_staf'])) {
		    $imageStafPath = $request->file('imej_staf')->getClientOriginalName();
		    $request->file('imej_staf')->move($destination, $imageStafPath);
	    }

	    if(isset($request['imej_polis'])) {
		    $imagePolisPath = $request->file('imej_polis')->getClientOriginalName();
		    $request->file('imej_polis')->move($destination, $imagePolisPath);
	    }

	    // register kenderaan
	    $newKenderaan = new Kenderaan();
	    $newKenderaan->fill([
	    	'no_kenderaan' => $request['no_kenderaan'],
		    'jenis_kenderaan' => $request['jenis_kenderaan'],
		    'status_kenderaan' => $request['status_kenderaan']
	    ]);
	    $newKenderaan->save();

	    // register laporan
    	$laporan = new Laporan();
    	$laporan->fill([
		    'staf_id' => $request['staf_id'],
		    'admin_id' => $request['admin_id'],
		    'polis_id' => $request['polis_id'],
		    'pelajar_id' => $request['pelajar_id'],
		    'status_laporan' => $request['status_laporan'],
		    'tempat' => $request['tempat'],
		    'imej_staf' => $imageStafPath,
		    'imej_polis' => $imagePolisPath,
		    'laporan_staf' => $request['laporan_staf'],
		    'laporan_polis' => $request['laporan_polis'],
		    'no_siri_pelekat' => $request['no_siri_pelekat'],
		    'kenderaan' => $newKenderaan->id
	    ]);
    	$laporan->save();

    	if(isset($request['client_req']))
    		return $laporan;
    	else
    		return redirect('admin/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Laporan|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()) {
	        $laporanInfo = Laporan::all()->find($id); // laporan info
	        $stafInfo = Staf::all()->find($laporanInfo['staf_id']); // staf info
	        $polisInfo = Polis::all()->find($laporanInfo['polis_id']); // polis info
	        $stafPekerjaInfo = Pekerja::all()->find($stafInfo['pekerja_id']);
			$polisPekerjaInfo = Pekerja::all()->find($polisInfo['pekerja_id']);
			if($laporanInfo['pelajar_id'] != null)
				$pelajarInfo = Pelajar::all()->find($laporanInfo['pelajar_id']); // pelajar info
			else {
				$pelajarInfo['id'] = null;
				$pelajarInfo['no_pelajar'] = null;
			}

	        // kenderaan info
	        $kenderaanInfo = Kenderaan::all()->find($laporanInfo['kenderaan']);
	        $jenisKenderaanInfo = LookupJenisKenderaan::all()->find($kenderaanInfo['jenis_kenderaan']);
	        $statusKenderaanInfo = LookupStatusKenderaan::all()->find($kenderaanInfo['status_kenderaan']);
	        $kenderaanInfo = [
		        'kenderaan_no' => $kenderaanInfo['id'],
		        'kenderaan_jenis' => $jenisKenderaanInfo['nama'],
		        'kenderaan_status' => $statusKenderaanInfo['nama']
	        ];

	        // kesalahan info
	        $kesalahanInfoList = Kesalahan::all()->where('laporan_id', 'LIKE', $laporanInfo['id']);
	        $kesalahanList = null;
	        foreach($kesalahanInfoList as $kesalahanInfo) {
		        $jenisKesalahan = LookupJenisKesalahan::all()->find($kesalahanInfo['id']);

		        $kesalahanList[] = [
			        'jenis_kesalahan' => $jenisKesalahan['nama']
		        ];
	        }

	        // laporan status info
	        $laporanStatusInfo = LookupStatusLaporan::all()->find($laporanInfo['status_laporan']);

	        // jadualkan laporan polis info list
	        $polisInfoList = Pekerja::all()->where('jenis_pekerja', 'LIKE', 3);
			$jadualPolisInfoList = null;

	        foreach($polisInfoList as $polisInfo) {
				$polisTableInfo = Polis::all()->where('pekerja_id', 'LIKE', $polisInfo['id']);
				
				foreach($polisTableInfo as $tableInfo) {
					$polisPos = LookupPos::all()->find($tableInfo['pos']);

					$jadualPolisInfoList[] = [
						'polis_id'     => $tableInfo['id'],
						'polis_pos'    => $polisPos['nama'],
						'polis_nama'   => $polisInfo['nama'],
						'polis_tel_hp' => $polisInfo['no_tel_hp'],
					];
				}
			}

	        $laporan = [
	        	// laporan
		        'laporan_id' => $laporanInfo['id'],
		        'laporan_tempat' => $laporanInfo['tempat'],
		        'laporan_tarikh' => date_format($laporanInfo['created_at'], 'Y-m-d'),
		        'laporan_masa' => date_format($laporanInfo['created_at'], 'H-i-s'),
		        'laporan_status' => $laporanStatusInfo['nama'],

		        // staf
		        'staf_id' => $laporanInfo['staf_id'],
		        'staf_nama' => $stafPekerjaInfo['nama'],
		        'staf_imej' => $laporanInfo['imej_staf'],
		        'staf_laporan' => $laporanInfo['laporan_staf'],

		        // polis
		        'polis_id' => $laporanInfo['polis_id'],
		        'polis_nama' => $polisPekerjaInfo['nama'],
		        'polis_imej' => $laporanInfo['imej_polis'],
		        'polis_laporan' => $laporanInfo['laporan_polis'],

		        // kenderaan
		        'kenderaan_no' => $kenderaanInfo['kenderaan_no'],
		        'kenderaan_jenis' => $kenderaanInfo['kenderaan_jenis'],
		        'kenderaan_status' => $kenderaanInfo['kenderaan_status'],
		        'kenderaan_no_siri_pelekat' => $laporanInfo['no_siri_pelekat'],

		        // pelajar
		        'pelajar_id' => $pelajarInfo['id'],
		        'pelajar_no' => $pelajarInfo['no_pelajar'],
		        'kesalahanList' => $kesalahanList,

		        // info jadualkan laporan
		        'jadual_polis_list' => $jadualPolisInfoList
			];

	        return view('laporan.info_laporan')->with(['laporan' => $laporan]);
		} else
			return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$laporan = Laporan::all()->find($id);

    	return view('laporan.edit')->with([
    		'laporan' => $laporan
	    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return Laporan|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $laporan = Laporan::all()->find($id);
        $laporan->fill([
            'staf_id' => $request['staf_id'],
		    'admin_id' => $request['admin_id'],
		    'polis_id' => $request['polis_id'],
		    'pelajar_id' => $request['pelajar_id'],
		    'status_laporan' => $request['status_laporan'],
		    'tarikh_masa' => $request['tarikh_masa'],
		    'tempat' => $request['tempat'],
		    'imej_staf' => $request['imej_staf'],
		    'imej_polis' => $request['imej_polis'],
		    'laporan_staf' => $request['laporan_staf'],
		    'laporan_polis' => $request['laporan_polis'],
		    'no_siri_pelekat' => $request['no_siri_pelekat'],
		    'kenderaan' => $request['kenderaan']
        ]);
        $laporan->save();

	    return $laporan;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Laporan::destroy($id);
    }
}
