<?php

namespace App\Http\Controllers;

use App\Admin;
use App\LookupJabatan;
use App\LookupJawatan;
use App\LookupJenisPekerja;
use App\LookupPos;
use App\Pekerja;
use App\Polis;
use App\Staf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('pekerja.index');
    }

    // show
	public function showAdmin() {
    	if(Auth::check()) {
			$admin = Auth::user();
			
			$pekerjaInfo = Pekerja::all()->find($admin['id']);
			$jawatanInfo = LookupJawatan::all()->find($admin['jawatan']);

			$returnInfoAdmin = [
				'no_pekerja' => $pekerjaInfo['no_pekerja'],
				'admin_nama' => $pekerjaInfo['nama'],
				'admin_emel' => $pekerjaInfo['emel'],
				'admin_ic' => $pekerjaInfo['no_ic'],
				'admin_no_tel_hp' => $pekerjaInfo['no_tel_hp'],
				'admin_no_tel_pej' => $pekerjaInfo['no_tel_pej'],
				'admin_jawatan_gred' => $jawatanInfo['gred'],
				'admin_jawatan_nama' => $jawatanInfo['nama'],
				'admin_tarikh_daftar' => $pekerjaInfo['created_at']->format('d-m-Y')
			];
			
			if($admin['log_pertama'] == 0)
				return view('admin/profil')->with([
					'infoAdmin' => $returnInfoAdmin,
					'resetPassword' => 0
				]);
			else
				return view('admin/profil')->with([
					'infoAdmin' => $returnInfoAdmin,
					'resetPassword' => 1
				]);
	    } else
	    	return redirect('/');
	}

    public function showStaf($id) {
	    if(Auth::check()) {
		    $stafInfo = Staf::all()->find($id);
		    $pekerjaInfo = Pekerja::all()->find($stafInfo['pekerja_id']);
		    $jawatanInfo = LookupJawatan::all()->find($pekerjaInfo['jawatan']);
		    $jabatanInfo = LookupJabatan::all()->find($stafInfo['jabatan']);

		    $returnInfoStaf = [
			    'no_pekerja' => $pekerjaInfo['no_pekerja'],
			    'staf_nama' => $pekerjaInfo['nama'],
			    'staf_emel' => $pekerjaInfo['emel'],
			    'staf_ic' => $pekerjaInfo['no_ic'],
			    'staf_no_tel_hp' => $pekerjaInfo['no_tel_hp'],
			    'staf_no_tel_pej' => $pekerjaInfo['no_tel_pej'],
			    'staf_jawatan_gred' => $jawatanInfo['gred'],
			    'staf_jawatan_nama' => $jawatanInfo['nama'],
			    'staf_jabatan' => $jabatanInfo['nama'],
			    'staf_tarikh_daftar' => $pekerjaInfo['created_at']->format('d-m-Y')
		    ];

		    return view('info/info_staf')->with([
			    'infoStaf' => $returnInfoStaf
		    ]);
	    } else
	    	return redirect('/');
    }

    public function showPolis($id) {
	    if(Auth::check()) {
		    $polisInfo = Polis::all()->find($id);
		    $pekerjaInfo = Pekerja::all()->find($polisInfo['pekerja_id']);
		    $jawatanInfo = LookupJawatan::all()->find($pekerjaInfo['jawatan']);
		    $posInfo = LookupPos::all()->find($polisInfo['pos']);

		    $returnInfoPolis = [
			    'no_pekerja' => $pekerjaInfo['no_pekerja'],
			    'polis_nama' => $pekerjaInfo['nama'],
			    'polis_emel' => $pekerjaInfo['emel'],
			    'polis_ic' => $pekerjaInfo['no_ic'],
			    'polis_no_tel_hp' => $pekerjaInfo['no_tel_hp'],
			    'polis_no_tel_pej' => $pekerjaInfo['no_tel_pej'],
			    'polis_jawatan_gred' => $jawatanInfo['gred'],
			    'polis_jawatan_nama' => $jawatanInfo['nama'],
			    'polis_pos' => $posInfo['nama'],
			    'polis_tarikh_daftar' => $pekerjaInfo['created_at']->format('d-m-Y')
		    ];

		    return view('info/info_polis')->with([
			    'infoPolis' => $returnInfoPolis
		    ]);
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
    	$tempPekerja = Pekerja::find($id);
    	$jawatanList = LookupJawatan::all();
    	$jenisPekerjaList = LookupJenisPekerja::all();

        return redirect()->intended('pekerja.edit')->with([
        	'jawatanList' => $jawatanList,
	        'jenisPekerjaList' => $jenisPekerjaList
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tempPekerja = Pekerja::find($id);

        $tempPekerja->no_pekerja = $request['no_pekerja'];
        $tempPekerja->no_ic = $request['no_ic'];
        $tempPekerja->nama = $request['nama'];
        $tempPekerja->emel = $request['emel'];
        $tempPekerja->password = $request['password'];
        $tempPekerja->no_tel_hp = $request['no_tel_hp'];
        $tempPekerja->no_tel_pej = $request['no_tel_pej'];
        $tempPekerja->log_pertama = $request['log_pertama'];
        $tempPekerja->jawatan = $request['jawatan'];
        $tempPekerja->jenis_pekerja = $request['jenis_pekerja'];
        $tempPekerja->save();

        return $tempPekerja;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pekerja::find($id)->delete();

        return redirect()->intended();
    }
}
