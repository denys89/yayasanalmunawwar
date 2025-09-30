import React from 'react';
import { CheckCircle, Circle, CreditCard, FileText, Shield, Users, ArrowRight } from 'lucide-react';
import { cn } from '../utils/cn';

interface ProcessStep {
  id: number;
  title: string;
  description: string;
  status: 'completed' | 'current' | 'pending';
  icon: React.ReactNode;
}

interface RegistrationProcessProps {
  className?: string;
}

const RegistrationProcess: React.FC<RegistrationProcessProps> = ({ className }) => {
  const steps: ProcessStep[] = [
    {
      id: 1,
      title: 'Proses Pembayaran Formulir',
      description: 'Pembayaran formulir pendaftaran telah selesai',
      status: 'completed',
      icon: <CreditCard className="h-5 w-5" />
    },
    {
      id: 2,
      title: 'Pengisian Data Siswa',
      description: 'Lengkapi data pribadi dan akademik siswa',
      status: 'current',
      icon: <FileText className="h-5 w-5" />
    },
    {
      id: 3,
      title: 'Verifikasi Data Siswa',
      description: 'Verifikasi dan validasi data yang telah diisi',
      status: 'pending',
      icon: <Shield className="h-5 w-5" />
    },
    {
      id: 4,
      title: 'Proses Seleksi',
      description: 'Menunggu hasil proses seleksi penerimaan',
      status: 'pending',
      icon: <Users className="h-5 w-5" />
    }
  ];

  const getStepIcon = (step: ProcessStep) => {
    if (step.status === 'completed') {
      return <CheckCircle className="h-6 w-6 text-green-500" />;
    }
    return <Circle className="h-6 w-6 text-gray-300" />;
  };

  const getStepClasses = (step: ProcessStep) => {
    const baseClasses = "flex items-center p-3 sm:p-4 rounded-lg border transition-all duration-200";
    
    if (step.status === 'completed') {
      return `${baseClasses} bg-green-50 border-green-200 dark:bg-green-900/20 dark:border-green-800`;
    } else if (step.status === 'current') {
      return `${baseClasses} bg-blue-50 border-blue-200 dark:bg-blue-900/20 dark:border-blue-800 ring-2 ring-blue-500/20`;
    } else {
      return `${baseClasses} bg-gray-50 border-gray-200 dark:bg-gray-800 dark:border-gray-700`;
    }
  };

  return (
    <div className={cn('bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 sm:p-6', className)}>
      <div className="mb-6">
        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
          <h3 className="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">Proses Pendaftaran</h3>
          <div className="flex items-center space-x-2">
            <button className="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-xs sm:text-sm font-medium dark:bg-blue-900/30 dark:text-blue-300">
              Proses Daftar
            </button>
            <button className="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg text-xs sm:text-sm font-medium dark:bg-gray-800 dark:text-gray-300">
              Jadwal Kegiatan
            </button>
          </div>
        </div>
        
        <p className="text-sm text-gray-600 dark:text-gray-400">
          Selamat saat ini Anda telah terdaftar sebagai Calon Peserta Didik Baru INSAN CENDEKIA MADANI MIDDLE SCHOOL PROGRAM. Lanjutkan proses pembayaran formulir untuk melanjutkan proses pendaftaran.
        </p>
      </div>

      <div className="space-y-3 sm:space-y-4 mb-6">
        {steps.map((step, index) => (
          <div key={step.id} className="relative">
            <div className={getStepClasses(step)}>
              <div className="flex items-center space-x-3 sm:space-x-4 flex-1">
                <div className="flex-shrink-0">
                  {getStepIcon(step)}
                </div>
                <div className="flex-shrink-0 hidden sm:block">
                  <div className={`p-2 rounded-lg ${
                    step.status === 'completed' 
                      ? 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400'
                      : step.status === 'current'
                      ? 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400'
                      : 'bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500'
                  }`}>
                    {step.icon}
                  </div>
                </div>
                <div className="flex-1 min-w-0">
                  <h4 className={cn(
                    'text-sm sm:text-base font-medium',
                    step.status === 'completed' ? 'text-green-900 dark:text-green-100' :
                    step.status === 'current' ? 'text-blue-900 dark:text-blue-100' : 'text-gray-500 dark:text-gray-400'
                  )}>
                    {step.title}
                  </h4>
                  <p className={cn(
                    'text-xs sm:text-sm mt-1',
                    step.status === 'completed' ? 'text-green-700 dark:text-green-300' :
                    step.status === 'current' ? 'text-blue-700 dark:text-blue-300' : 'text-gray-400 dark:text-gray-500'
                  )}>
                    {step.description}
                  </p>
                </div>
              </div>
            </div>
            
            {/* Connector line */}
            {index < steps.length - 1 && (
              <div className="absolute left-3 top-full w-0.5 h-3 bg-gray-200 dark:bg-gray-700 hidden sm:block"></div>
            )}
          </div>
        ))}
      </div>

      <div className="flex flex-col sm:flex-row gap-3 sm:gap-4">
        <button className="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2 text-sm sm:text-base">
          <CreditCard className="h-4 w-4" />
          Lanjutkan Pembayaran
        </button>
        <button className="flex-1 sm:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 py-2.5 px-4 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2 text-sm sm:text-base">
          Lihat Detail
          <ArrowRight className="h-4 w-4" />
        </button>
      </div>
    </div>
  );
};

export default RegistrationProcess;