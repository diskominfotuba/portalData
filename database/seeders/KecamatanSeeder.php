<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    public static $banjarAgungId;
    public static $banjarBaruId;
    public static $banjarMargoId;
    public static $denteTeladasId;
    public static $gedungAjiId;
    public static $gedungAjiBaruId;
    public static $gedungMenengId;
    public static $menggalaId;
    public static $menggalaTimurId;
    public static $meraksaAjiId;
    public static $penawarAjiId;
    public static $penawartamaId;
    public static $rawaPituId;
    public static $rawajituSelatanId;
    public static $rawajituTimurId;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banjarAgung = Kecamatan::create(['nama_kecamatan' => 'Banjar Agung']);
        self::$banjarAgungId = $banjarAgung->id;

        $banjarBaru = Kecamatan::create(['nama_kecamatan' => 'Banjar Baru']);
        self::$banjarBaruId = $banjarBaru->id;

        $banjarMargo = Kecamatan::create(['nama_kecamatan' => 'Banjar Margo']);
        self::$banjarMargoId = $banjarMargo->id;

        $denteTeladas = Kecamatan::create(['nama_kecamatan' => 'Dente Teladas']);
        self::$denteTeladasId = $denteTeladas->id;

        $gedungAji = Kecamatan::create(['nama_kecamatan' => 'Gedung Aji']);
        self::$gedungAjiId = $gedungAji->id;

        $gedungAjiBaru = Kecamatan::create(['nama_kecamatan' => 'Gedung Aji Baru']);
        self::$gedungAjiBaruId = $gedungAjiBaru->id;

        $gedungMeneng = Kecamatan::create(['nama_kecamatan' => 'Gedung Meneng']);
        self::$gedungMenengId = $gedungMeneng->id;

        $menggala = Kecamatan::create(['nama_kecamatan' => 'Menggala']);
        self::$menggalaId = $menggala->id;

        $menggalaTimur = Kecamatan::create(['nama_kecamatan' => 'Menggala Timur']);
        self::$menggalaTimurId = $menggalaTimur->id;

        $meraksaAji = Kecamatan::create(['nama_kecamatan' => 'Meraksa Aji']);
        self::$meraksaAjiId = $meraksaAji->id;

        $penawarAji = Kecamatan::create(['nama_kecamatan' => 'Penawar Aji']);
        self::$penawarAjiId = $penawarAji->id;

        $penawartama = Kecamatan::create(['nama_kecamatan' => 'Penawartama']);
        self::$penawartamaId = $penawartama->id;

        $rawaPitu = Kecamatan::create(['nama_kecamatan' => 'Rawa Pitu']);
        self::$rawaPituId = $rawaPitu->id;

        $rawajituSelatan = Kecamatan::create(['nama_kecamatan' => 'Rawajitu Selatan']);
        self::$rawajituSelatanId = $rawajituSelatan->id;

        $rawajituTimur = Kecamatan::create(['nama_kecamatan' => 'Rawajitu Timur']);
        self::$rawajituTimurId = $rawajituTimur->id;
    }
}
