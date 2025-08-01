<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use DOMDocument;


class DashboardController extends BaseController
{
    // Endpoint URLs
    private const URLS = [
        'pendidikan' => 'https://webapi.bps.go.id/v1/api/interoperabilitas/datasource/simdasi/id/25/tahun/2024/id_tabel/a1lFcnlHNXNYMFlueG8xL0ZOZnU0Zz09/wilayah/1808000/key/9c5801d21f56653dacd1bcd2e806b4df',
        'kesehatan' => 'https://webapi.bps.go.id/v1/api/view/domain/1808/model/statictable/lang/ind/id/790/key/9c5801d21f56653dacd1bcd2e806b4df',
        'puskesmas' => 'https://webapi.bps.go.id/v1/api/interoperabilitas/datasource/simdasi/id/25/tahun/2020/id_tabel/biszcFRCUnVKUXNnTDZvWnA3ZWtyUT09/wilayah/1808000/key/9c5801d21f56653dacd1bcd2e806b4df',
        'petani' => 'https://webapi.bps.go.id/v1/api/view/domain/1808/model/statictable/lang/ind/id/711/key/9c5801d21f56653dacd1bcd2e806b4df',
        'umkm' => 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1808/var/874/th/123/key/9c5801d21f56653dacd1bcd2e806b4df',
        'pasar' => 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1808/var/383/th/122/key/9c5801d21f56653dacd1bcd2e806b4df',
        'penduduk' => 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1808/var/1233/th/123/key/9c5801d21f56653dacd1bcd2e806b4df',
        'parawisata' => 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1808/var/1313/th/124/key/9c5801d21f56653dacd1bcd2e806b4df',
    ];

    public function index()
    {
        $jumlah_sekolah_sma = 0;
        $jumlah_guru = 0;
        $jumlah_medis = 0;
        $jumlah_puskesmas = 0;
        $jumlah_petani_pengguna_lahan = 0;
        $jumlah_petani_gurem = 0;

        // Pendidikan
        [$jumlah_sekolah_sma, $jumlah_guru] = $this->getPendidikanData();

        // Kesehatan
        $jumlah_medis = $this->parseJumlahFromStaticHtml(self::URLS['kesehatan']);

        // Puskesmas
        $jumlah_puskesmas = $this->getPuskesmas();

        // Petani
        [$jumlah_petani_pengguna_lahan, $jumlah_petani_gurem] = $this->getPetani();

        // Data Langsung via Key
        $jumlah_umkm = $this->getJumlahFromDatacontent(self::URLS['umkm'], '487401230');
        $jumlah_pasar = $this->getJumlahFromDatacontent(self::URLS['pasar'], '5938301220');
        $jumlah_penduduk = $this->getJumlahFromDatacontent(self::URLS['penduduk'], '591233631230');
        $jumlah_parawisata = $this->getJumlahFromDatacontent(self::URLS['parawisata'], '9131301240');

        return view('dashboard_monitoring.index', compact(
            'jumlah_sekolah_sma',
            'jumlah_guru',
            'jumlah_medis',
            'jumlah_puskesmas',
            'jumlah_petani_pengguna_lahan',
            'jumlah_petani_gurem',
            'jumlah_umkm',
            'jumlah_pasar',
            'jumlah_penduduk',
            'jumlah_parawisata'
        ));
    }

    private function getJumlahFromDatacontent($url, $key)
    {
        $response = Http::get($url);
        if ($response->ok()) {
            $data = $response->json()['datacontent'] ?? [];
            return (int) ($data[$key] ?? 0);
        }
        return 0;
    }

    private function parseJumlahFromStaticHtml($url)
    {
        $response = Http::get($url);
        if (!$response->ok()) return 0;

        $html = html_entity_decode($response->json()['data']['table'] ?? '');
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $rows = $dom->getElementsByTagName('tr');
        $total = 0;

        foreach ($rows as $row) {
            $cells = $row->getElementsByTagName('td');
            if ($cells->length === 2) {
                $jumlah = trim($cells->item(1)->nodeValue);
                if (is_numeric($jumlah)) {
                    $total += (int) str_replace('.', '', $jumlah);
                }
            }
        }

        return $total;
    }

    private function getPendidikanData()
    {
        $response = Http::get(self::URLS['pendidikan']);
        $jumlah_sekolah = $jumlah_guru = 0;

        if ($response->ok()) {
            $data = $response->json()['data'][1]['data'] ?? [];
            foreach ($data as $row) {
                if (($row['label'] ?? '') === 'Tulangbawang') continue;

                $sekolah = $row['variables']['bzp5c0dw1o']['value'] ?? null;
                $guru = $row['variables']['1qdxx3jt99']['value'] ?? null;

                if (is_numeric(str_replace('.', '', $sekolah))) {
                    $jumlah_sekolah += (int) str_replace('.', '', $sekolah);
                }

                if (is_numeric(str_replace('.', '', $guru))) {
                    $jumlah_guru += (int) str_replace('.', '', $guru);
                }
            }
        }

        return [$jumlah_sekolah, $jumlah_guru];
    }

    private function getPuskesmas()
    {
        $response = Http::get(self::URLS['puskesmas']);
        $jumlah = 0;

        if ($response->ok()) {
            $data = $response->json()['data'][1]['data'] ?? [];
            foreach ($data as $row) {
                if (($row['label'] ?? '') === 'Tulangbawang') continue;

                $inap = $row['variables']['u0sajl9b2phdy3mtdnf7']['value'] ?? null;
                $non_inap = $row['variables']['jjjpp63h67ld08stv8oy']['value'] ?? null;

                foreach ([$inap, $non_inap] as $val) {
                    if ($val !== null && $val !== '–' && $val !== '...') {
                        $jumlah += (int) str_replace('.', '', $val);
                    }
                }
            }
        }

        return $jumlah;
    }

    private function getPetani()
    {
        $response = Http::get(self::URLS['petani']);
        $html = html_entity_decode($response->json()['data']['table'] ?? '');
        $jumlah_pengguna = $jumlah_gurem = 0;

        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $rows = $dom->getElementsByTagName('tr');

        foreach ($rows as $row) {
            $cells = $row->getElementsByTagName('td');
            if ($cells->length === 3) {
                $kecamatan = strtolower(trim($cells->item(0)->nodeValue));
                if ($kecamatan === 'tulang bawang') continue;

                $pengguna = str_replace(' ', '', trim($cells->item(1)->nodeValue));
                $gurem = str_replace(' ', '', trim($cells->item(2)->nodeValue));

                if (is_numeric($pengguna)) $jumlah_pengguna += (int)$pengguna;
                if (is_numeric($gurem)) $jumlah_gurem += (int)$gurem;
            }
        }

        return [$jumlah_pengguna, $jumlah_gurem];
    }


    public function show()
    {
        return view('dashboard_monitoring.detail');
    }
}
