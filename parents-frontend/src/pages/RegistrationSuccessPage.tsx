import React, { useEffect, useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { 
  CheckCircleIcon, 
  DocumentTextIcon,
  CalendarIcon,
  PhoneIcon,
  EnvelopeIcon,
  HomeIcon,
  PrinterIcon
} from '@heroicons/react/24/outline';

// API Configuration
const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api';

interface RegistrationData {
  id: string;
  registrationNumber: string;
  student: {
    fullName: string;
    nickname: string;
    birthplace: string;
    birthdate: string;
    gender: string;
    schoolChoice: string;
    selectedClass: string;
    track: string;
    registrationType: string;
  };
  guardians: {
    fatherName: string;
    fatherPhone: string;
    fatherEmail: string;
    motherName: string;
    motherPhone: string;
    motherEmail: string;
  };
  submittedAt: string;
  status: string;
  parentAccount?: {
    email: string;
    username: string;
    plaintext_password?: string;
  } | null;
}

const RegistrationSuccessPage: React.FC = () => {
  // Removed useParams-based ID dependency in favor of token-based retrieval
  const location = useLocation();
  const [registrationData, setRegistrationData] = useState<RegistrationData | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchRegistrationData = async () => {
      try {
        // Support token passed via URL query (?token=...) and persist to sessionStorage for subsequent visits
        const searchParams = new URLSearchParams(location.search);
        const tokenFromQuery = searchParams.get('token');
        if (tokenFromQuery) {
          sessionStorage.setItem('registration_success_token', tokenFromQuery);
        }
        const token = tokenFromQuery || sessionStorage.getItem('registration_success_token');

        if (!token) {
          setError('Token tidak ditemukan');
          setLoading(false);
          return;
        }

        const response = await fetch(`${API_BASE_URL}/registration/success`, {
          headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`
          }
        });

        if (response.ok) {
          const data = await response.json();
          const stateParentAccount = (location.state as any)?.parentAccount;
          const merged = {
            ...data.data,
            parentAccount: stateParentAccount ?? data.data.parentAccount ?? null,
          } as RegistrationData;
          setRegistrationData(merged);
        } else {
          if (response.status === 401 || response.status === 404) {
            setError('Token tidak valid atau sudah kadaluarsa');
          } else {
            setError('Terjadi kesalahan saat mengambil data pendaftaran');
          }
        }
      } catch (error) {
        console.error('Error fetching registration data:', error);
        setError('Terjadi kesalahan saat mengambil data pendaftaran');
      } finally {
        setLoading(false);
      }
    };

    fetchRegistrationData();
  }, [location]);

  const handlePrint = () => {
    window.print();
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center p-6">
        <div className="text-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-[#28a745] mx-auto mb-4"></div>
          <p className="text-base text-[#6c757d]">Memuat data pendaftaran...</p>
        </div>
      </div>
    );
  }

  if (error || !registrationData) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center p-6">
        <div className="text-center max-w-md mx-auto">
          <div className="mb-6">
            <DocumentTextIcon className="w-16 h-16 text-red-500 mx-auto" />
          </div>
          <h1 className="text-2xl font-bold text-[#333333] mb-4">
            Data Tidak Ditemukan
          </h1>
          <p className="text-base text-[#6c757d] mb-8 leading-relaxed">
            {error || 'Data pendaftaran tidak dapat ditemukan'}
          </p>
          <Link 
            to="/register" 
            className="inline-flex items-center justify-center px-6 py-3 bg-[#28a745] text-white text-base font-medium rounded-lg hover:bg-[#218838] focus:outline-none focus:ring-2 focus:ring-[#28a745] focus:ring-opacity-50 transition-all duration-200 shadow-lg hover:shadow-xl"
          >
            Daftar Ulang
          </Link>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-white">
      <div className="max-w-4xl mx-auto px-6 py-12">
        {/* Success Header */}
        <div className="text-center mb-12">
          <div className="mb-6">
            <CheckCircleIcon className="w-16 h-16 text-[#28a745] mx-auto" />
          </div>
          <h1 className="text-2xl md:text-3xl lg:text-4xl font-bold text-[#333333] mb-4 leading-tight">
            Pendaftaran Berhasil!
          </h1>
          <p className="text-lg text-[#6c757d] mb-6 leading-relaxed max-w-2xl mx-auto">
            Terima kasih telah mendaftar di Yayasan Al Munawwar
          </p>
          <div className="inline-flex items-center px-4 py-2 bg-[#28a745] text-white text-lg font-semibold rounded-lg shadow-md">
            Nomor Pendaftaran: <span className="ml-2 font-bold">{registrationData.registrationNumber}</span>
          </div>
        </div>

        {/* Registration Details */}
        <div className="bg-white shadow-xl rounded-2xl border border-[#dee2e6] overflow-hidden mb-8">
          {/* Header */}
          <div className="bg-[#28a745] text-white px-8 py-6">
            <div className="flex items-center justify-between">
              <div>
                <h2 className="text-2xl font-bold mb-2">
                  Bukti Pendaftaran Siswa
                </h2>
                <p className="text-green-100 text-base">
                  Yayasan Al Munawwar
                </p>
              </div>
              <button
                onClick={handlePrint}
                className="inline-flex items-center px-4 py-2 bg-white text-[#28a745] border border-white rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all duration-200 print:hidden font-semibold"
              >
                <PrinterIcon className="w-5 h-5 mr-2" />
                Cetak
              </button>
            </div>
          </div>

          <div className="px-8 py-8 space-y-12">
            {/* Student Information */}
            <div>
              <h3 className="text-xl font-bold text-[#333333] mb-6 flex items-center">
                <DocumentTextIcon className="w-6 h-6 mr-3 text-[#28a745]" />
                Informasi Siswa
              </h3>
              <div className="bg-[#f8f9fa] rounded-xl p-6 border border-[#dee2e6]">
                <div className="grid md:grid-cols-2 gap-6">
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      Nama Lengkap
                    </label>
                    <p className="text-base text-[#333333] font-medium">
                      {registrationData.student.fullName}
                    </p>
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      Nama Panggilan
                    </label>
                    <p className="text-base text-[#333333] font-medium">
                      {registrationData.student.nickname || '-'}
                    </p>
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      Tempat, Tanggal Lahir
                    </label>
                    <p className="text-base text-[#333333] font-medium">
                      {registrationData.student.birthplace}, {new Date(registrationData.student.birthdate).toLocaleDateString('id-ID')}
                    </p>
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      Jenis Kelamin
                    </label>
                    <p className="text-base text-[#333333] font-medium">
                      {registrationData.student.gender === 'male' ? 'Laki-laki' : 'Perempuan'}
                    </p>
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      Sekolah Pilihan
                    </label>
                    <p className="text-base text-[#333333] font-medium">
                      {registrationData.student.schoolChoice}
                    </p>
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      Kelas & Track
                    </label>
                    <p className="text-base text-[#333333] font-medium">
                      Kelas {registrationData.student.selectedClass} - {registrationData.student.track}
                    </p>
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      Jenis Pendaftaran
                    </label>
                    <span className="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                      {registrationData.student.registrationType}
                    </span>
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      Status Pendaftaran
                    </label>
                    <span className="inline-flex items-center px-3 py-1 bg-[#28a745] text-white text-sm font-medium rounded-full">
                      {registrationData.status}
                    </span>
                  </div>
                </div>
              </div>
            </div>

            {/* Guardian Information */}
            <div>
              <h3 className="text-xl font-bold text-[#333333] mb-6 flex items-center">
                <PhoneIcon className="w-6 h-6 mr-3 text-[#28a745]" />
                Informasi Kontak Orang Tua
              </h3>
              <div className="bg-[#f8f9fa] rounded-xl p-6 border border-[#dee2e6]">
                <div className="grid md:grid-cols-2 gap-8">
                  <div>
                    <h4 className="font-bold text-[#333333] mb-4 text-lg">Ayah</h4>
                    <div className="space-y-3">
                      <p className="text-base text-[#333333]">
                        <span className="font-semibold">Nama:</span> {registrationData.guardians.fatherName}
                      </p>
                      <p className="text-base text-[#333333] flex items-center">
                        <PhoneIcon className="w-4 h-4 mr-2 text-[#6c757d]" />
                        {registrationData.guardians.fatherPhone || '-'}
                      </p>
                      <p className="text-base text-[#333333] flex items-center">
                        <EnvelopeIcon className="w-4 h-4 mr-2 text-[#6c757d]" />
                        {registrationData.guardians.fatherEmail || '-'}
                      </p>
                    </div>
                  </div>
                  <div>
                    <h4 className="font-bold text-[#333333] mb-4 text-lg">Ibu</h4>
                    <div className="space-y-3">
                      <p className="text-base text-[#333333]">
                        <span className="font-semibold">Nama:</span> {registrationData.guardians.motherName}
                      </p>
                      <p className="text-base text-[#333333] flex items-center">
                        <PhoneIcon className="w-4 h-4 mr-2 text-[#6c757d]" />
                        {registrationData.guardians.motherPhone || '-'}
                      </p>
                      <p className="text-base text-[#333333] flex items-center">
                        <EnvelopeIcon className="w-4 h-4 mr-2 text-[#6c757d]" />
                        {registrationData.guardians.motherEmail || '-'}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {/* Submission Info */}
            <div>
              <h3 className="text-xl font-bold text-[#333333] mb-6 flex items-center">
                <CalendarIcon className="w-6 h-6 mr-3 text-[#28a745]" />
                Informasi Pendaftaran
              </h3>
              <div className="bg-[#f8f9fa] rounded-xl p-6 border border-[#dee2e6]">
                <div className="grid md:grid-cols-2 gap-6">
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      Tanggal Pendaftaran
                    </label>
                    <p className="text-base text-[#333333] font-medium">
                      {new Date(registrationData!.submittedAt).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                      })}
                    </p>
                  </div>
                  <div>
                    <label className="block text-sm font-semibold text-[#333333] mb-2">
                      ID Pendaftaran
                    </label>
                    <p className="text-base text-[#333333] font-mono font-medium">
                      {registrationData!.id}
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {/* Parent Account Information */}
            {registrationData?.parentAccount && (
              <div className="mt-6">
                <h3 className="text-xl font-semibold text-dark mb-4 flex items-center">
                  <HomeIcon className="w-6 h-6 mr-2 text-primary" />
                  Akun Orang Tua
                </h3>
                <div className="info-section">
                  <div className="grid md:grid-cols-2 gap-6">
                    <div>
                      <label className="info-label">Email</label>
                      <p className="info-value">{registrationData.parentAccount.email}</p>
                    </div>
                    <div>
                      <label className="info-label">Username</label>
                      <p className="info-value">{registrationData.parentAccount.username}</p>
                    </div>
                    {registrationData.parentAccount.plaintext_password && (
                      <div className="md:col-span-2 print:hidden">
                        <div className="alert alert-warning">
                          <p className="text-sm">
                            Simpan kredensial di bawah ini. Password hanya ditampilkan sekali untuk alasan keamanan.
                          </p>
                          <div className="mt-3">
                            <label className="info-label">Password Sementara</label>
                            <p className="info-value font-mono">
                              {registrationData.parentAccount.plaintext_password}
                            </p>
                          </div>
                        </div>
                      </div>
                    )}
                  </div>
                  <div className="flex gap-3 mt-4 print:hidden">
                    <Link to="/login" className="btn btn-primary">
                      Masuk ke Portal Orang Tua
                    </Link>
                  </div>
                </div>
              </div>
            )}

            {/* Next Steps */}
            <div>
              <h3 className="text-xl font-bold text-[#333333] mb-6 flex items-center">
                <DocumentTextIcon className="w-6 h-6 mr-3 text-[#28a745]" />
                Langkah Selanjutnya
              </h3>
              <div className="bg-[#f8f9fa] rounded-xl p-6 border border-[#dee2e6]">
                <div className="space-y-4">
                  <div className="flex items-start">
                    <div className="flex-shrink-0 w-8 h-8 bg-[#28a745] text-white rounded-full flex items-center justify-center text-sm font-bold mr-4">
                      1
                    </div>
                    <div>
                      <h4 className="font-bold text-[#333333] text-lg mb-2">Tunggu Konfirmasi</h4>
                      <p className="text-base text-[#6c757d] leading-relaxed">
                        Tim kami akan meninjau pendaftaran Anda dan mengirimkan konfirmasi melalui email dalam 1-2 hari kerja.
                      </p>
                    </div>
                  </div>
                  <div className="flex items-start">
                    <div className="flex-shrink-0 w-8 h-8 bg-[#28a745] text-white rounded-full flex items-center justify-center text-sm font-bold mr-4">
                      2
                    </div>
                    <div>
                      <h4 className="font-bold text-[#333333] text-lg mb-2">Siapkan Dokumen</h4>
                      <p className="text-base text-[#6c757d] leading-relaxed">
                        Siapkan dokumen asli yang diperlukan untuk verifikasi saat proses penerimaan.
                      </p>
                    </div>
                  </div>
                  <div className="flex items-start">
                    <div className="flex-shrink-0 w-8 h-8 bg-[#28a745] text-white rounded-full flex items-center justify-center text-sm font-bold mr-4">
                      3
                    </div>
                    <div>
                      <h4 className="font-bold text-[#333333] text-lg mb-2">Pantau Status</h4>
                      <p className="text-base text-[#6c757d] leading-relaxed">
                        Pantau status pendaftaran melalui dashboard atau hubungi kami jika ada pertanyaan.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Action Buttons */}
        <div className="flex flex-col sm:flex-row gap-4 pt-8 print:hidden">
          <button
            onClick={handlePrint}
            className="flex-1 bg-[#28a745] hover:bg-[#218838] text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-[#28a745]/30 flex items-center justify-center text-base"
          >
            <PrinterIcon className="w-5 h-5 mr-3" />
            Cetak Bukti Pendaftaran
          </button>
          <button
            onClick={() => navigate('/dashboard')}
            className="flex-1 bg-[#f8f9fa] hover:bg-[#e9ecef] text-[#333333] font-semibold py-4 px-6 rounded-xl border border-[#dee2e6] transition-all duration-200 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-[#dee2e6]/50 flex items-center justify-center text-base"
          >
            <HomeIcon className="w-5 h-5 mr-3" />
            Kembali ke Dashboard
          </button>
        </div>
      </div>
    </div>
  );
};

export default RegistrationSuccessPage;