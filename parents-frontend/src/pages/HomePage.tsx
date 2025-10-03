import React from 'react';
import { Link } from 'react-router-dom';
import { 
  AcademicCapIcon, 
  UserGroupIcon, 
  ChartBarIcon, 
  BellIcon,
  ArrowRightIcon,
  PhoneIcon,
  EnvelopeIcon,
  MapPinIcon
} from '@heroicons/react/24/outline';

const HomePage: React.FC = () => {
  return (
    <div className="min-h-screen bg-gradient-to-br from-primary-50 to-primary-100">
      {/* Header */}
      <header className="bg-white/80 backdrop-blur-sm shadow-sm">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
          <div className="text-center">
            <h1 className="text-4xl font-bold text-gray-900 mb-2">
              Parent Portal
            </h1>
            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
              Portal khusus untuk orang tua siswa Yayasan Al-Munawwar. 
              Pantau perkembangan akademik anak, komunikasi dengan sekolah, dan kelola administrasi dengan mudah.
            </p>
          </div>
        </div>
      </header>

      {/* Main Content */}
      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        {/* About Section */}
        <section className="mb-16">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-gray-900 mb-4">
              Tentang Parent Portal
            </h2>
            <p className="text-lg text-gray-600 max-w-4xl mx-auto">
              Parent Portal adalah platform digital yang memungkinkan orang tua untuk tetap terhubung 
              dengan perkembangan pendidikan anak di Yayasan Al-Munawwar.
            </p>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div className="card p-6 hover:shadow-lg transition-shadow">
              <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <AcademicCapIcon className="w-6 h-6 text-blue-600" />
              </div>
              <h3 className="text-lg font-semibold text-gray-900 mb-2">
                Monitoring Akademik
              </h3>
              <p className="text-gray-600">
                Pantau nilai, kehadiran, dan perkembangan akademik anak secara real-time.
              </p>
            </div>

            <div className="card p-6 hover:shadow-lg transition-shadow">
              <div className="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                <UserGroupIcon className="w-6 h-6 text-primary-600" />
              </div>
              <h3 className="text-lg font-semibold text-gray-900 mb-2">
                Komunikasi Sekolah
              </h3>
              <p className="text-gray-600">
                Terima pengumuman penting dan berkomunikasi langsung dengan guru.
              </p>
            </div>

            <div className="card p-6 hover:shadow-lg transition-shadow">
              <div className="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                <ChartBarIcon className="w-6 h-6 text-purple-600" />
              </div>
              <h3 className="text-lg font-semibold text-gray-900 mb-2">
                Laporan Pembayaran
              </h3>
              <p className="text-gray-600">
                Kelola pembayaran SPP dan biaya sekolah dengan mudah dan transparan.
              </p>
            </div>

            <div className="card p-6 hover:shadow-lg transition-shadow">
              <div className="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                <BellIcon className="w-6 h-6 text-orange-600" />
              </div>
              <h3 className="text-lg font-semibold text-gray-900 mb-2">
                Notifikasi Real-time
              </h3>
              <p className="text-gray-600">
                Dapatkan notifikasi langsung untuk setiap update penting tentang anak.
              </p>
            </div>
          </div>
        </section>

        {/* Registration Section */}
        <section className="mb-16">
          <div className="card rounded-2xl overflow-hidden">
            <div className="md:flex">
              <div className="md:w-1/2 p-8 lg:p-12">
                <h2 className="text-3xl font-bold text-gray-900 mb-4">
                  Pendaftaran Siswa Baru
                </h2>
                <p className="text-lg text-gray-600 mb-6">
                  Daftarkan anak Anda untuk menjadi bagian dari keluarga besar Yayasan Al-Munawwar. 
                  Proses pendaftaran yang mudah dan terintegrasi dengan sistem sekolah.
                </p>
                <ul className="space-y-3 mb-8">
                  <li className="flex items-center text-gray-700">
                    <div className="w-2 h-2 bg-primary-500 rounded-full mr-3"></div>
                    Formulir pendaftaran online
                  </li>
                  <li className="flex items-center text-gray-700">
                    <div className="w-2 h-2 bg-primary-500 rounded-full mr-3"></div>
                    Upload dokumen persyaratan
                  </li>
                  <li className="flex items-center text-gray-700">
                    <div className="w-2 h-2 bg-primary-500 rounded-full mr-3"></div>
                    Tracking status pendaftaran
                  </li>
                  <li className="flex items-center text-gray-700">
                    <div className="w-2 h-2 bg-primary-500 rounded-full mr-3"></div>
                    Konfirmasi penerimaan otomatis
                  </li>
                </ul>
                <Link
                  to="/register"
                  className="btn btn-primary inline-flex items-center px-6 py-3 font-semibold"
                >
                  Daftar Sekarang
                  <ArrowRightIcon className="w-5 h-5 ml-2" />
                </Link>
              </div>
              <div className="md:w-1/2 bg-gradient-to-br from-primary-500 to-primary-600 p-8 lg:p-12 flex items-center justify-center">
                <div className="text-center text-white">
                  <AcademicCapIcon className="w-24 h-24 mx-auto mb-6 opacity-80" />
                  <h3 className="text-2xl font-bold mb-2">Bergabunglah dengan Kami</h3>
                  <p className="text-primary-100">
                    Wujudkan masa depan cerah untuk anak Anda bersama Yayasan Al-Munawwar
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Login Section */}
        <section className="mb-16">
          <div className="card rounded-2xl overflow-hidden">
            <div className="md:flex">
              <div className="md:w-1/2 bg-gradient-to-br from-primary-500 to-primary-600 p-8 lg:p-12 flex items-center justify-center">
                <div className="text-center text-white">
                  <UserGroupIcon className="w-24 h-24 mx-auto mb-6 opacity-80" />
                  <h3 className="text-2xl font-bold mb-2">Selamat Datang Kembali</h3>
                  <p className="text-primary-100">
                    Akses portal orang tua untuk memantau perkembangan anak Anda
                  </p>
                </div>
              </div>
              <div className="md:w-1/2 p-8 lg:p-12">
                <h2 className="text-3xl font-bold text-gray-900 mb-4">
                  Login Orang Tua
                </h2>
                <p className="text-lg text-gray-600 mb-6">
                  Sudah memiliki akun? Masuk ke portal orang tua untuk mengakses informasi 
                  lengkap tentang perkembangan akademik dan administrasi anak Anda.
                </p>
                <ul className="space-y-3 mb-8">
                  <li className="flex items-center text-gray-700">
                    <div className="w-2 h-2 bg-primary-500 rounded-full mr-3"></div>
                    Dashboard monitoring lengkap
                  </li>
                  <li className="flex items-center text-gray-700">
                    <div className="w-2 h-2 bg-primary-500 rounded-full mr-3"></div>
                    Riwayat pembayaran dan tagihan
                  </li>
                  <li className="flex items-center text-gray-700">
                    <div className="w-2 h-2 bg-primary-500 rounded-full mr-3"></div>
                    Komunikasi dengan guru
                  </li>
                  <li className="flex items-center text-gray-700">
                    <div className="w-2 h-2 bg-primary-500 rounded-full mr-3"></div>
                    Pengumuman dan notifikasi
                  </li>
                </ul>
                <Link
                  to="/login"
                  className="btn btn-primary inline-flex items-center px-6 py-3 font-semibold"
                >
                  Masuk ke Portal
                  <ArrowRightIcon className="w-5 h-5 ml-2" />
                </Link>
              </div>
            </div>
          </div>
        </section>
      </main>

      {/* Footer */}
      <footer className="bg-white border-t border-gray-200 text-gray-700">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <div className="grid md:grid-cols-3 gap-8">
            <div>
              <h3 className="text-xl font-bold mb-4 text-gray-900">Yayasan Al-Munawwar</h3>
              <p className="text-gray-600 mb-4">
                Lembaga pendidikan Islam yang berkomitmen untuk membentuk generasi 
                yang berakhlak mulia dan berprestasi.
              </p>
              <p className="text-sm text-gray-500">
                © 2024 Yayasan Al-Munawwar. All rights reserved.
              </p>
            </div>
            
            <div>
              <h4 className="text-lg font-semibold mb-4 text-gray-900">Kontak Kami</h4>
              <div className="space-y-3">
                <div className="flex items-center text-gray-600">
                  <PhoneIcon className="w-5 h-5 mr-3 text-gray-400" />
                  <span>+62 21 1234 5678</span>
                </div>
                <div className="flex items-center text-gray-600">
                  <EnvelopeIcon className="w-5 h-5 mr-3 text-gray-400" />
                  <span>info@almunawwar.sch.id</span>
                </div>
                <div className="flex items-center text-gray-600">
                  <MapPinIcon className="w-5 h-5 mr-3 text-gray-400" />
                  <span>Jl. Pendidikan No. 123, Jakarta</span>
                </div>
              </div>
            </div>

            <div>
              <h4 className="text-lg font-semibold mb-4 text-gray-900">Tautan Cepat</h4>
              <div className="grid grid-cols-2 gap-2 text-sm">
                <Link to="/register" className="text-primary-600 hover:text-primary-700">Pendaftaran</Link>
                <Link to="/login" className="text-primary-600 hover:text-primary-700">Login</Link>
                <Link to="/dashboard" className="text-primary-600 hover:text-primary-700">Dashboard</Link>
                <Link to="/payments" className="text-primary-600 hover:text-primary-700">Pembayaran</Link>
              </div>
            </div>
          </div>
        </div>

        {/* Decorative blobs */}
        <div className="relative">
          <div className="absolute -top-40 -right-32 w-80 h-80 bg-primary-200 rounded-full opacity-20 blur-3xl"></div>
          <div className="absolute -bottom-40 -left-32 w-80 h-80 bg-primary-300 rounded-full opacity-20 blur-3xl"></div>
        </div>
      </footer>
    </div>
  );
};

export default HomePage;