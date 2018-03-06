<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DaftarMail extends Mailable
{
    use Queueable, SerializesModels;

    private $nama, $emel, $katalaluan, $no_pekerja;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama, $emel, $katalaluan, $no_pekerja)
    {
        $this->nama = $nama;
        $this->emel = $emel;
        $this->katalaluan = $katalaluan;
        $this->no_pekerja = $no_pekerja;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('UiTM E-Saman Trafik: Pengesahan pendaftaran')
            ->markdown('emel.daftar_emel')->with([
                'nama' => $this->nama,
                'emel' => $this->emel,
                'katalaluan' => $this->katalaluan,
                'no_pekerja' => $this->no_pekerja
            ]);
    }
}
