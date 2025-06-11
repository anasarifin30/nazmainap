<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu Nazmainap?',
                'answer' => 'Nazmainap adalah platform pemesanan homestay milik warga desa wisata Pacitan. Kami menyediakan pengalaman menginap yang unik dan nyaman di homestay yang dikelola langsung oleh BumDes.',
                'order' => 1,
                'is_active' => true
            ],
            [
                'question' => 'Bagaimana cara memesan homestay?',
                'answer' => 'Anda dapat memesan homestay dengan cara: 1) Pilih lokasi dan tanggal menginap, 2) Pilih homestay yang diinginkan, 3) Isi data pemesanan, 4) Lakukan pembayaran secara online. Proses pemesanan sangat mudah dan aman.',
                'order' => 2,
                'is_active' => true
            ],
            [
                'question' => 'Metode pembayaran apa saja yang tersedia?',
                'answer' => 'Kami menerima berbagai metode pembayaran online seperti transfer bank (BCA, BNI, BRI, Mandiri), e-wallet (GoPay, ShopeePay), dan kartu kredit. Semua transaksi menggunakan sistem pembayaran Midtrans yang aman.',
                'order' => 3,
                'is_active' => true
            ],
            [
                'question' => 'Apakah bisa membatalkan pemesanan?',
                'answer' => 'Pemesanan dapat dibatalkan sebelum batas waktu pembayaran (10 menit setelah checkout). Setelah pembayaran berhasil, pembatalan mengikuti kebijakan masing-masing homestay. Silakan hubungi pemilik homestay untuk informasi lebih lanjut.',
                'order' => 4,
                'is_active' => true
            ],
            [
                'question' => 'Bagaimana jika ada masalah saat menginap?',
                'answer' => 'Jika ada masalah saat menginap, Anda dapat langsung menghubungi pemilik homestay melalui WhatsApp yang tersedia di halaman detail homestay. Tim BumDes juga siap membantu menyelesaikan masalah yang terjadi.',
                'order' => 5,
                'is_active' => true
            ],
            [
                'question' => 'Apakah homestay sudah terverifikasi?',
                'answer' => 'Ya, semua homestay yang tersedia di platform Nazmainap sudah melalui proses verifikasi oleh BumDes. Kami memastikan kualitas dan keamanan homestay sesuai dengan standar yang ditetapkan.',
                'order' => 6,
                'is_active' => true
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}