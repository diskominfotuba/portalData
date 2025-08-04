<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatanBanjarAgung = [
            "BANJAR AGUNG",
            "BANJAR DEWA",
            "DWI WARGA TUNGGAL JAYA",
            "MORIS JAYA",
            "TRI DARMA WIRA JAYA",
            "TRI MUKTI JAYA",
            "TRI MULYA JAYA",
            "TRI TUNGGAL JAYA",
            "TUNGGAL WARGA",
            "WARGA INDAH JAYA",
            "WARGA MAKMUR JAYA"
        ];

        foreach ($kecamatanBanjarAgung as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$banjarAgungId,
            ]);
        }

        $kecamatanGedungAji = [
            "GEDUNG AJI",
            "AJI JAYA KNPI",
            "AJI MESIR",
            "AJI MURNI JAYA",
            "AJI PERMAI TALANG BUAH",
            "BANDAR AJI JAYA",
            "KECUBUNG JAYA",
            "KECUBUNG MULYA",
            "PENAWAR",
            "PENAWAR BARU"
        ];

        foreach ($kecamatanGedungAji as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$gedungAjiId,
            ]);
        }

        $kecamatanGedungMeneng = [
            "BAKUNG ILIR",
            "BAKUNG RAHAYU",
            "BAKUNG UDIK",
            "GEDUNG BANDAR RAHAYU",
            "GEDUNG BANDAR REJO",
            "GEDUNG MENENG",
            "GEDUNG MENENG BARU",
            "GUNUNG TAPA",
            "GUNUNG TAPA ILIR",
            "GUNUNG TAPA TENGAH",
            "GUNUNG TAPA UDIK"
        ];

        foreach ($kecamatanGedungMeneng as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$gedungMenengId,
            ]);
        }

        $kecamatanMenggala = [
            "ASTRA KSETRA",
            "BUJUNG TENUK",
            "KAGUNGAN RAHAYU",
            "TIUH TOHOU",
            "UJUNG GUNUNG ILIR",
            "MENGGALA SELATAN",
            "MENGGALA TENGAH",
        ];

        foreach ($kecamatanMenggala as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$menggalaId,
            ]);
        }

        $kecamatanRawajituTimur = [
            "BUMI DIPASENA ABADI",
            "BUMI DIPASENA AGUNG",
            "BUMI DIPASENA JAYA",
            "BUMI DIPASENA MAKMUR",
            "BUMI DIPASENA MULYA",
            "BUMI DIPASENA SEJAHTERA",
            "BUMI DIPASENA UTAMA",
            "BUMI SENTOSA",
        ];

        foreach ($kecamatanRawajituTimur as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$rawajituTimurId,
            ]);
        }

        $kecamatanBanjarBaru = [
            "BALAI MURNI JAYA",
            "BAWANG SAKTI JAYA",
            "BAWANG TIRTO MULYO",
            "JAYA MAKMUR",
            "KAHURIPAN JAYA",
            "KAMPUNG MEKAR JAYA",
            "KARYA MURNI JAYA",
            "MEKAR INDAH JAYA",
            "PANCA KARSA PURNA JAYA",
            "PANCA MULIA"
        ];

        foreach ($kecamatanBanjarBaru as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$banjarBaruId,
            ]);
        }

        $kecamatanPenawarTama = [
            "BOGATAMA",
            "DWI MULYO",
            "PULO GADUNG",
            "REJOSARI",
            "SIDO HARJO",
            "SIDO MAKMUR",
            "SIDO MULYO",
            "SIDODADI",
            "TRI JAYA",
            "TRI KARYA",
            "TRI REJO MULYO",
            "TRI TUNGGAL JAYA",
            "WIRA AGUNG SARI",
            "WIRATAMA"
        ];

        foreach ($kecamatanPenawarTama as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$penawartamaId,
            ]);
        }

        $kecamatanRawapitu = [
            "ANDALAS CERMIN",
            "BATANG HARI",
            "BUMI SARI",
            "DUTA YOSO MULYO",
            "GEDUNG JAYA",
            "MULYO DADI",
            "PANGGUNG MULYA",
            "RAWA RAGIL",
            "SUMBER AGUNG"
        ];

        foreach ($kecamatanRawapitu as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$rawaPituId,
            ]);
        }

        $kecamatanPenawarAji = [
            "GEDUNG ASRI",
            "GEDUNG HARAPAN",
            "GEDUNG REJO SAKTI",
            "KARYA MAKMUR",
            "PANCA TUNGGAL JAYA",
            "PASAR BATANG",
            "SUKA MAKMUR",
            "SUMBER SARI",
            "WONO REJO"
        ];
        foreach ($kecamatanPenawarAji as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$penawarAjiId,
            ]);
        }

        $kecamatanMenggalaTimur = [
            "BEDAROU INDAH",
            "CEMPAKA DALAM",
            "CEMPAKA JAYA",
            "KAHURIPAN DALEM",
            "KIBANG PACING",
            "LEBUH DALEM",
            "LINGAI",
            "MENGGALA",
            "SUNGAI LUAR",
            "TRI MAKMUR JAYA",
            "LEBUH DALAM KAHURIPAN"
        ];
        foreach ($kecamatanMenggalaTimur as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$menggalaTimurId,
            ]);
        }

        $kecamatanBanjarMargo = [
            "AGUNG DALEM",
            "AGUNG JAYA",
            "BUJUK AGUNG",
            "CATUR KARYA BUANA JAYA",
            "MEKAR JAYA",
            "PENAWAR JAYA",
            "PENAWAR REJO",
            "PURWA JAYA",
            "RINGIN SARI",
            "SUKA MAJU",
            "SUMBER MAKMUR",
            "TRI TUNGGAL JAYA"
        ];
        foreach ($kecamatanBanjarMargo as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$banjarMargoId,
            ]);
        }

        $kecamatanDenteTeladas = [
            "BRATASENA ADIWARNA",
            "BRATASENA MANDIRI",
            "DENTE MAKMUR",
            "KEKATUNG",
            "KUALA TELADAS",
            "MAHABANG",
            "PASIRAN JAYA",
            "PENDOWO ASRI",
            "SUNGAI BURUNG",
            "SUNGAI NIBUNG",
            "TELADAS",
            "WAY DENTE"
        ];
        foreach ($kecamatanDenteTeladas as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$denteTeladasId,
            ]);
        }

        $kecamatanGedungAjiBaru = [
            "BATU AMPAR",
            "MAKARTI TAMA",
            "MEKAR ASRI",
            "MESIR DWI JAYA",
            "SETIA TAMA",
            "SIDO MEKAR",
            "SIDO MUKTI",
            "SUKA BHAKTI",
            "SUMBER JAYA"
        ];
        foreach ($kecamatanGedungAjiBaru as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$gedungAjiBaruId,
            ]);
        }

        $kecamatanMeraksaAji = [
            "BANGUN REJO",
            "BINA BUMI",
            "KARYA BHAKTI",
            "KECUBUNG RAYA",
            "MARGA JAYA",
            "MULYO AJI",
            "PADUAN RAJAWALI",
            "SUKARAME"
        ];
        foreach ($kecamatanMeraksaAji as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$meraksaAjiId,
            ]);
        }

        $kecamatanRawajituSelatan = [
            "BUMI RATU",
            "GEDUNG KARYA JITU",
            "HARGO MULYO",
            "HARGO REJO",
            "KARYA CIPTA ABADI",
            "KARYA JITU MUKTI",
            "MEDASARI",
            "WONO AGUNG",
            "YUDHA KARYA JITU"
        ];
        foreach ($kecamatanRawajituSelatan as $desaName) {
            Desa::create([
                'nama_desa' => $desaName,
                'kecamatan_id' => KecamatanSeeder::$rawajituSelatanId,
            ]);
        }
    }
}
