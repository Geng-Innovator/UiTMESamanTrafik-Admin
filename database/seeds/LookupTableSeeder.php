<?php

use App\LookupFakulti;
use App\LookupJabatan;
use App\LookupJawatan;
use App\LookupJenisKenderaan;
use App\LookupJenisKesalahan;
use App\LookupJenisPekerja;
use App\LookupKolej;
use App\LookupKursus;
use App\LookupPos;
use App\LookupStatusKenderaan;
use App\LookupStatusLaporan;
use Illuminate\Database\Seeder;

class LookupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // lookup fakulti
	    LookupFakulti::create([ 'nama' => 'FSKM' ]);
	    LookupFakulti::create([ 'nama' => 'FKM' ]);
		LookupFakulti::create([ 'nama' => 'FSG' ]);
		LookupFakulti::create([ 'nama' => 'FSPU' ]);

	    // lookup jabatan
	    LookupJabatan::create([ 'nama' => 'JABATAN 1' ]);
	    LookupJabatan::create([ 'nama' => 'JABATAN 2' ]);
	    LookupJabatan::create([ 'nama' => 'JABATAN 3' ]);

	    // lookup jawatan
	    LookupJawatan::create([ 'gred' => 'GRED 1', 'nama' => 'JAWATAN 1' ]);
	    LookupJawatan::create([ 'gred' => 'GRED 2', 'nama' => 'JAWATAN 2' ]);
	    LookupJawatan::create([ 'gred' => 'GRED 3', 'nama' => 'JAWATAN 3' ]);

	    // lookup jenis kenderaan
	    LookupJenisKenderaan::create([ 'nama' => 'MOTORSIKAL' ]);
		LookupJenisKenderaan::create([ 'nama' => 'KERETA' ]);
	    LookupJenisKenderaan::create([ 'nama' => 'BAS' ]);

	    // lookup jenis kesalahan
	    LookupJenisKesalahan::create([ 'nama' => 'MELETAK DI TEMPAT LARANGAN/DIKHASKAN' ]);
	    LookupJenisKesalahan::create([ 'nama' => 'MELETAK DILUAR PETAK/PETAK KUNING' ]);
		LookupJenisKesalahan::create([ 'nama' => 'MENGHALANG LALUAN' ]);
		LookupJenisKesalahan::create([ 'nama' => 'TIADA LESEN MEMANDU/TAMAT TEMPOH' ]);
		LookupJenisKesalahan::create([ 'nama' => 'LESEN (L) MEMBAWA PEMBONCENG' ]);
		LookupJenisKesalahan::create([ 'nama' => 'TIADA CUKAI JALAN YANG SAH/TAMAT TEMPOH' ]);
		LookupJenisKesalahan::create([ 'nama' => 'MELANGAR JALAN SEHALA/DILARANG MASUK' ]);
		LookupJenisKesalahan::create([ 'nama' => 'TIDAK MEMAKAI TOPI KELEDAR PENUNGGANG/PEMBONCENG' ]);
		LookupJenisKesalahan::create([ 'nama' => 'TIADA PELEKAT UITM TERKINI' ]);
		LookupJenisKesalahan::create([ 'nama' => 'MELETAK DI KORIDOR/LALUAN PEJALAN KAKI' ]);
		LookupJenisKesalahan::create([ 'nama' => 'KENDERAAN DIKUNCI' ]);
		LookupJenisKesalahan::create([ 'nama' => 'LAIN-LAIN (NYATAKAN DI BAHAGIAN PENERANGAN)' ]);

	    // lookup jenis pekerja
	    LookupJenisPekerja::create([ 'nama' => 'ADMIN' ]);
	    LookupJenisPekerja::create([ 'nama' => 'STAF' ]);
	    LookupJenisPekerja::create([ 'nama' => 'POLIS' ]);

	    // lookup kolej
	    LookupKolej::create([ 'nama' => 'DELIMA' ]);
	    LookupKolej::create([ 'nama' => 'PERINDU' ]);
	    LookupKolej::create([ 'nama' => 'MAWAR' ]);
	    LookupKolej::create([ 'nama' => 'KENANGA' ]);

	    // lookup kursus
	    LookupKursus::create([ 'kod' => 'CS230', 'nama' => 'IJAZAH SARJANA MUDA SAINS KOMPUTER DAN MATEMATIK' ]);
	    LookupKursus::create([ 'kod' => 'CS253', 'nama' => 'IJAZAH SARJANA MUDA SAINS KOMPUTER DAN MATEMATIK (MULTIMEDIA)' ]);
	    LookupKursus::create([ 'kod' => 'CS249', 'nama' => 'IJAZAH SARJANA MUDA SAIN MATEMATIK' ]);

	    // lookup pos
	    LookupPos::create([ 'nama' => 'PINTU UTAMA' ]);
	    LookupPos::create([ 'nama' => 'PINTU BELAKANG' ]);
	    LookupPos::create([ 'nama' => 'PINTU SEKSYEN 2' ]);
	    LookupPos::create([ 'nama' => 'PINTU SEKSYEN 7' ]);

	    // lookup status kenderaan
	    LookupStatusKenderaan::create([ 'nama' => 'DISAMAN' ]);
	    LookupStatusKenderaan::create([ 'nama' => 'DIKUNCI' ]);
	    LookupStatusKenderaan::create([ 'nama' => 'TIADA TINDAKAN' ]);

	    // lookup status laporan
	    LookupStatusLaporan::create([ 'nama' => 'DILAPORKAN' ]);
	    LookupStatusLaporan::create([ 'nama' => 'DIJADUALKAN' ]);
	    LookupStatusLaporan::create([ 'nama' => 'DIKUATKUASAKAN' ]);
	    LookupStatusLaporan::create([ 'nama' => 'DITUTUP' ]);
    }
}
