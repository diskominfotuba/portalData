<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Http;


class DashboardController extends BaseController
{
    public function index()
    {
        // URL untuk mengambil data dari BPS Pendidikan
        $url = 'https://webapi.bps.go.id/v1/api/interoperabilitas/datasource/simdasi/id/25/tahun/2024/id_tabel/a1lFcnlHNXNYMFlueG8xL0ZOZnU0Zz09/wilayah/1808000/key/9c5801d21f56653dacd1bcd2e806b4df';
        // Kesehatan data
        $urlKesehatan = 'https://webapi.bps.go.id/v1/api/view/domain/1808/model/statictable/lang/ind/id/790/key/9c5801d21f56653dacd1bcd2e806b4df';
        // Puskesmas data
        $urlPuskesmas = 'https://webapi.bps.go.id/v1/api/interoperabilitas/datasource/simdasi/id/25/tahun/2020/id_tabel/biszcFRCUnVKUXNnTDZvWnA3ZWtyUT09/wilayah/1808000/key/9c5801d21f56653dacd1bcd2e806b4df';
        // Petani data
        $urlPetani = 'https://webapi.bps.go.id/v1/api/view/domain/1808/model/statictable/lang/ind/id/711/key/9c5801d21f56653dacd1bcd2e806b4df';
        // Umkm data
        $urlUmkm = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1808/var/874/th/123/key/9c5801d21f56653dacd1bcd2e806b4df';
        // Jumlah Pasar data
        $urlPasar = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1808/var/383/th/122/key/9c5801d21f56653dacd1bcd2e806b4df';

        $jumlah_sekolah_sma = 0;
        $jumlah_guru = 0;
        $jumlah_medis = 0;
        $jumlah_puskesmas = 0;
        $jumlah_petani_pengguna_lahan = 0;
        $jumlah_petani_gurem = 0;
        $jumlah_umkm = 0;
        $jumlah_pasar = 0;




        $response = Http::get($url);
        $responseKesehatan = Http::get($urlKesehatan);
        $responsePuskesmas = Http::get($urlPuskesmas);
        $responsePetani = Http::get($urlPetani);
        $responseUmkm = Http::get($urlUmkm);
        $responsePasar = Http::get($urlPasar);




        if ($response->ok()) {
            $json = $response->json();
            $districtData = $json['data'][1]['data'] ?? [];

            foreach ($districtData as $row) {
                // Lewatkan baris agregat total kabupaten (Tulangbawang) Karena nanti akan diambil dari masing-masing kecamatan
                if (($row['label'] ?? '') === 'Tulangbawang') {
                    continue;
                }

                $value_sekolah = $row['variables']['bzp5c0dw1o']['value'] ?? null;
                $value_guru = $row['variables']['1qdxx3jt99']['value'] ?? null;

                if ($value_sekolah !== null && $value_sekolah !== '-') {
                    $jumlah_sekolah_sma += (int) str_replace('.', '', $value_sekolah);
                }

                if ($value_guru !== null && $value_guru !== '-') {
                    $jumlah_guru += (int) str_replace('.', '', $value_guru);
                }
            }
        }

        if ($responseKesehatan->ok()) {
            // Ambil HTML yang masih dalam format entity
            $htmlEntity = $responseKesehatan->json()['data']['table'] ?? '';

            // Decode HTML entities menjadi HTML normal
            $html = html_entity_decode($htmlEntity);

            // Load ke DOM
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML($html);
            $rows = $dom->getElementsByTagName('tr');

            foreach ($rows as $row) {
                $cells = $row->getElementsByTagName('td');

                if ($cells->length === 2) {
                    $jumlah = trim($cells->item(1)->nodeValue);

                    if (is_numeric($jumlah)) {
                        $jumlah_medis += (int) str_replace('.', '', $jumlah);
                    }
                }
            }
        }

        // Proses data Puskesmas
        if ($responsePuskesmas->ok()) {
            $jsonPuskesmas = $responsePuskesmas->json();
            $puskesmasData = $jsonPuskesmas['data'][1]['data'] ?? [];

            foreach ($puskesmasData as $row) {
                // Lewatkan baris agregat total kabupaten (Tulangbawang)
                if (($row['label'] ?? '') === 'Tulangbawang') {
                    continue;
                }

                // Ambil data Puskesmas Rawat Inap (u0sajl9b2phdy3mtdnf7)
                $puskesmas_rawat_inap = $row['variables']['u0sajl9b2phdy3mtdnf7']['value'] ?? null;
                // Ambil data Puskesmas Non Rawat Inap (jjjpp63h67ld08stv8oy)
                $puskesmas_non_rawat_inap = $row['variables']['jjjpp63h67ld08stv8oy']['value'] ?? null;

                // Hitung Puskesmas Rawat Inap
                if ($puskesmas_rawat_inap !== null && $puskesmas_rawat_inap !== '–' && $puskesmas_rawat_inap !== '...') {
                    $jumlah_puskesmas += (int) str_replace('.', '', $puskesmas_rawat_inap);
                }

                // Hitung Puskesmas Non Rawat Inap
                if ($puskesmas_non_rawat_inap !== null && $puskesmas_non_rawat_inap !== '–' && $puskesmas_non_rawat_inap !== '...') {
                    $jumlah_puskesmas += (int) str_replace('.', '', $puskesmas_non_rawat_inap);
                }
            }
        }

        // Pertanian - Petani
        if ($responsePetani->ok()) {
            $htmlEntity = $responsePetani->json()['data']['table'] ?? '';
            $html = html_entity_decode($htmlEntity);

            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML($html);
            $rows = $dom->getElementsByTagName('tr');

            foreach ($rows as $row) {
                $cells = $row->getElementsByTagName('td');

                if ($cells->length === 3) {
                    $kecamatan = trim($cells->item(0)->nodeValue);

                    // Lewatkan baris total "Tulang Bawang"
                    if (strtolower($kecamatan) === 'tulang bawang') {
                        continue;
                    }

                    $penggunaLahan = trim($cells->item(1)->nodeValue);
                    $petaniGurem = trim($cells->item(2)->nodeValue);

                    $penggunaLahan = str_replace(' ', '', $penggunaLahan);
                    $petaniGurem = str_replace(' ', '', $petaniGurem);

                    if (is_numeric($penggunaLahan)) {
                        $jumlah_petani_pengguna_lahan += (int) $penggunaLahan;
                    }

                    if (is_numeric($petaniGurem)) {
                        $jumlah_petani_gurem += (int) $petaniGurem;
                    }
                }
            }
        }

        // Proses data UMKM
        if ($responseUmkm->ok()) {
            $jsonUmkm = $responseUmkm->json();
            $datacontent = $jsonUmkm['datacontent'] ?? [];

            // Ambil data dari key 487401230 jika tersedia
            if (isset($datacontent['487401230'])) {
                $jumlah_umkm = (int) $datacontent['487401230'];
            }
        }

        // Proses data Pasar
        if ($responsePasar->ok()) {
            $jsonPasar = $responsePasar->json();
            $datacontentPasar = $jsonPasar['datacontent'] ?? [];

            $jumlah_pasar = (int) ($datacontentPasar['5938301220'] ?? 0);
        }



        return view('dashboard_monitoring.index', compact(
            'jumlah_sekolah_sma',
            'jumlah_guru',
            'jumlah_medis',
            'jumlah_puskesmas',
            'jumlah_petani_pengguna_lahan',
            'jumlah_petani_gurem',
            'jumlah_umkm',
            'jumlah_pasar'

        ));
    }




    public function show()
    {
        return view('dashboard_monitoring.detail');
    }
}
