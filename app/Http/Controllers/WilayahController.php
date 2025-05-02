<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        // Simpan API key & URL dasar di .env
        $this->apiKey  = config('services.binderbyte.key');
        $this->baseUrl = 'https://api.binderbyte.com/wilayah';
    }

    public function getProvinces()
    {
        $response = Http::get("{$this->baseUrl}/provinsi", [
            'api_key' => $this->apiKey,
        ]);

        return response()->json($response->json()['data'] ?? []);
    }

    public function getRegencies($province_id)
    {
        $response = Http::get("{$this->baseUrl}/kabupaten", [
            'id_provinsi' => $province_id,
            'api_key'      => $this->apiKey,
        ]);

        return response()->json($response->json()['data'] ?? []);
    }

    public function getDistricts($regency_id)
    {
        $response = Http::get("{$this->baseUrl}/kecamatan", [
            'id_kabupaten' => $regency_id,
            'api_key'      => $this->apiKey,
        ]);

        return response()->json($response->json()['data'] ?? []);
    }

    public function getVillages($district_id)
    {
        $response = Http::get("{$this->baseUrl}/kelurahan", [
            'id_kecamatan' => $district_id,
            'api_key'      => $this->apiKey,
        ]);

        return response()->json($response->json()['data'] ?? []);
    }
}
