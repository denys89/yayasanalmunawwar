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
    academicYear: string;
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
      <div className="page-container">
        <div className="loading-container">
          <div className="loading-spinner"></div>
          <p className="text-muted">Memuat data pendaftaran...</p>
        </div>
      </div>
    );
  }

  if (error || !registrationData) {
    return (
      <div className="page-container">
        <div className="error-container">
          <div className="error-icon">
            <DocumentTextIcon className="w-8 h-8 text-danger" />
          </div>
          <h1 className="text-2xl font-semibold text-dark mb-2">
            Data Tidak Ditemukan
          </h1>
          <p className="text-muted mb-6">
            {error || 'Data pendaftaran tidak dapat ditemukan'}
          </p>
          <Link 
            to="/register" 
            className="btn btn-primary"
          >
            Daftar Ulang
          </Link>
        </div>
      </div>
    );
  }

  return (
    <div className="page-container">
      {/* Success Header */}
      <div className="text-center mb-8">
        <div className="success-icon-container">
          <CheckCircleIcon className="w-12 h-12 text-success" />
        </div>
        <h1 className="text-3xl md:text-4xl font-bold text-dark mb-2">
          Pendaftaran Berhasil!
        </h1>
        <p className="text-lg text-muted mb-4">
          Terima kasih telah mendaftar di Yayasan Al Munawwar
        </p>
        <div className="badge badge-success">
          Nomor Pendaftaran: <span className="font-bold">{registrationData.registrationNumber}</span>
        </div>
      </div>

      {/* Registration Details */}
      <div className="max-w-4xl mx-auto">
        <div className="card">
          {/* Header */}
          <div className="card-header bg-primary text-white">
            <div className="flex items-center justify-between">
              <div>
                <h2 className="text-2xl font-bold mb-1">
                  Bukti Pendaftaran Siswa
                </h2>
                <p className="text-primary-100">
                  Yayasan Al Munawwar - {registrationData.student.academicYear}
                </p>
              </div>
              <button
                onClick={handlePrint}
                className="btn btn-outline btn-sm text-white border-white hover:bg-white hover:text-primary print:hidden"
              >
                <PrinterIcon className="w-5 h-5 mr-2" />
                Cetak
              </button>
            </div>
          </div>

          <div className="card-body space-y-8">
            {/* Student Information */}
            <div>
              <h3 className="text-xl font-semibold text-dark mb-4 flex items-center">
                <DocumentTextIcon className="w-6 h-6 mr-2 text-primary" />
                Informasi Siswa
              </h3>
              <div className="info-section">
                <div className="grid md:grid-cols-2 gap-6">
                  <div>
                    <label className="info-label">
                      Nama Lengkap
                    </label>
                    <p className="info-value">
                      {registrationData.student.fullName}
                    </p>
                  </div>
                  <div>
                    <label className="info-label">
                      Nama Panggilan
                    </label>
                    <p className="info-value">
                      {registrationData.student.nickname || '-'}
                    </p>
                  </div>
                  <div>
                    <label className="info-label">
                      Tempat, Tanggal Lahir
                    </label>
                    <p className="info-value">
                      {registrationData.student.birthplace}, {new Date(registrationData.student.birthdate).toLocaleDateString('id-ID')}
                    </p>
                  </div>
                  <div>
                    <label className="info-label">
                      Jenis Kelamin
                    </label>
                    <p className="info-value">
                      {registrationData.student.gender === 'male' ? 'Laki-laki' : 'Perempuan'}
                    </p>
                  </div>
                  <div>
                    <label className="info-label">
                      Sekolah Pilihan
                    </label>
                    <p className="info-value">
                      {registrationData.student.schoolChoice}
                    </p>
                  </div>
                  <div>
                    <label className="info-label">
                      Kelas & Track
                    </label>
                    <p className="info-value">
                      Kelas {registrationData.student.selectedClass} - {registrationData.student.track}
                    </p>
                  </div>
                  <div>
                    <label className="info-label">
                      Jenis Pendaftaran
                    </label>
                    <span className="badge badge-info">
                      {registrationData.student.registrationType}
                    </span>
                  </div>
                  <div>
                    <label className="info-label">
                      Status Pendaftaran
                    </label>
                    <span className="badge badge-success">
                      {registrationData.status}
                    </span>
                  </div>
                </div>
              </div>
            </div>

            {/* Guardian Information */}
            <div>
              <h3 className="text-xl font-semibold text-dark mb-4 flex items-center">
                <PhoneIcon className="w-6 h-6 mr-2 text-primary" />
                Informasi Kontak Orang Tua
              </h3>
              <div className="info-section">
                <div className="grid md:grid-cols-2 gap-8">
                  <div>
                    <h4 className="font-semibold text-dark mb-3">Ayah</h4>
                    <div className="space-y-2">
                      <p className="text-dark">
                        <span className="font-medium">Nama:</span> {registrationData.guardians.fatherName}
                      </p>
                      <p className="text-dark flex items-center">
                        <PhoneIcon className="w-4 h-4 mr-2 text-muted" />
                        {registrationData.guardians.fatherPhone || '-'}
                      </p>
                      <p className="text-dark flex items-center">
                        <EnvelopeIcon className="w-4 h-4 mr-2 text-muted" />
                        {registrationData.guardians.fatherEmail || '-'}
                      </p>
                    </div>
                  </div>
                  <div>
                    <h4 className="font-semibold text-dark mb-3">Ibu</h4>
                    <div className="space-y-2">
                      <p className="text-dark">
                        <span className="font-medium">Nama:</span> {registrationData.guardians.motherName}
                      </p>
                      <p className="text-dark flex items-center">
                        <PhoneIcon className="w-4 h-4 mr-2 text-muted" />
                        {registrationData.guardians.motherPhone || '-'}
                      </p>
                      <p className="text-dark flex items-center">
                        <EnvelopeIcon className="w-4 h-4 mr-2 text-muted" />
                        {registrationData.guardians.motherEmail || '-'}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {/* Submission Info */}
            <div>
              <h3 className="text-xl font-semibold text-dark mb-4 flex items-center">
                <CalendarIcon className="w-6 h-6 mr-2 text-primary" />
                Informasi Pendaftaran
              </h3>
              <div className="info-section">
                <div className="grid md:grid-cols-2 gap-6">
                  <div>
                    <label className="info-label">
                      Tanggal Pendaftaran
                    </label>
                    <p className="info-value">
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
                    <label className="info-label">
                      ID Pendaftaran
                    </label>
                    <p className="info-value font-mono">
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
            <div className="alert alert-info">
              <h3 className="text-lg font-semibold text-info-dark mb-3">
                Langkah Selanjutnya
              </h3>
              <div className="space-y-3 text-info-dark">
                <div className="flex items-start">
                  <div className="step-number">
                    1
                  </div>
                  <p>Tim kami akan menghubungi Anda dalam 1-2 hari kerja untuk konfirmasi dan jadwal tes seleksi.</p>
                </div>
                <div className="flex items-start">
                  <div className="step-number">
                    2
                  </div>
                  <p>Siapkan dokumen yang diperlukan: fotokopi KK, akta kelahiran, dan rapor terakhir.</p>
                </div>
                <div className="flex items-start">
                  <div className="step-number">
                    3
                  </div>
                  <p>Simpan bukti pendaftaran ini sebagai referensi saat berkomunikasi dengan sekolah.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Action Buttons */}
        <div className="flex flex-col sm:flex-row gap-4 mt-8 print:hidden">
          <Link 
            to="/" 
            className="btn btn-secondary flex-1"
          >
            <HomeIcon className="w-5 h-5 mr-2" />
            Kembali ke Beranda
          </Link>
          <button
            onClick={handlePrint}
            className="btn btn-outline flex-1"
          >
            <PrinterIcon className="w-5 h-5 mr-2" />
            Cetak Bukti Pendaftaran
          </button>
          <Link 
            to="/register" 
            className="btn btn-primary flex-1"
          >
            <DocumentTextIcon className="w-5 h-5 mr-2" />
            Daftar Siswa Lain
          </Link>
        </div>
      </div>
    </div>
  );
};

export default RegistrationSuccessPage;