import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { 
  ChevronLeftIcon, 
  ChevronRightIcon, 
  UserIcon, 
  UsersIcon,
  CheckCircleIcon,
  ExclamationTriangleIcon,
  HomeIcon,
  ArrowRightOnRectangleIcon
} from '@heroicons/react/24/outline';

// API Configuration
const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api';
const PARENT_API_BASE_URL = import.meta.env.VITE_PARENT_API_URL || 'http://127.0.0.1:8000/api/parent';

interface StudentData {
  fullName: string;
  nickname: string;
  familyCardNumber: string;
  nationalIdNumber: string;
  birthplace: string;
  birthdate: string;
  gender: string;
  siblingName: string;
  siblingClass: string;
  schoolChoice: string;
  registrationType: string;
  admissionWaveId: string;
  selectedClass: string;
  track: string;
  selectionMethod: string;
  previousSchoolType: string;
  previousSchoolName: string;
  registrationInfoSource: string;
  registrationReason: string;
}

interface GuardianData {
  fatherName: string;
  fatherJob: string;
  fatherCompany: string;
  fatherEmail: string;
  fatherPhone: string;
  motherName: string;
  motherJob: string;
  motherCompany: string;
  motherEmail: string;
  motherPhone: string;
  guardianName: string;
  guardianJob: string;
  guardianCompany: string;
  guardianEmail: string;
  guardianPhone: string;
  guardianAddress: string;
}

interface FormData {
  student: StudentData;
  guardians: GuardianData;
}

interface ValidationErrors {
  [key: string]: string;
}

interface ValidationResult {
  isValid: boolean;
  errors: ValidationErrors;
}

interface AdmissionWave {
  id: number;
  name: string;
  level: string;
  registration_fee: number;
  final_payment_fee: number;
  start_date: number;
  end_date: number;
  formatted_start_date: string;
  formatted_end_date: string;
  is_open: boolean;
  status_label: string;
}

const RegistrationPage: React.FC = () => {
  const navigate = useNavigate();
  const [currentStep, setCurrentStep] = useState(1);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [errors, setErrors] = useState<ValidationErrors>({});
  const [isValidating, setIsValidating] = useState(false);
  const [admissionWaves, setAdmissionWaves] = useState<AdmissionWave[]>([]);
  const [loadingAdmissionWaves, setLoadingAdmissionWaves] = useState(false);
  const [formData, setFormData] = useState<FormData>({
    student: {
      fullName: '',
      nickname: '',
      familyCardNumber: '',
      nationalIdNumber: '',
      birthplace: '',
      birthdate: '',
      gender: '',
      siblingName: '',
      siblingClass: '',
      schoolChoice: '',
      registrationType: '',
      admissionWaveId: '',
      selectedClass: '',
      track: '',
      selectionMethod: '',
      previousSchoolType: '',
      previousSchoolName: '',
      registrationInfoSource: '',
      registrationReason: ''
    },
    guardians: {
      fatherName: '',
      fatherJob: '',
      fatherCompany: '',
      fatherEmail: '',
      fatherPhone: '',
      motherName: '',
      motherJob: '',
      motherCompany: '',
      motherEmail: '',
      motherPhone: '',
      guardianName: '',
      guardianJob: '',
      guardianCompany: '',
      guardianEmail: '',
      guardianPhone: '',
      guardianAddress: ''
    }
  });

  // Validation functions
  const validateRequired = (value: string, fieldName: string): string => {
    if (!value || value.trim() === '') {
      return `${fieldName} wajib diisi`;
    }
    return '';
  };

  const validateEmail = (email: string): string => {
    if (!email) return '';
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      return 'Format email tidak valid';
    }
    return '';
  };

  const validatePhone = (phone: string): string => {
    if (!phone) return '';
    const phoneRegex = /^[0-9+]+$/;
    if (!phoneRegex.test(phone)) {
      return 'Nomor telepon hanya boleh berisi angka dan tanda +';
    }
    if (phone.length < 10 || phone.length > 15) {
      return 'Nomor telepon harus antara 10-15 digit';
    }
    return '';
  };

  const validateName = (name: string): string => {
    if (!name) return '';
    const nameRegex = /^[a-zA-Z\s.']+$/;
    if (!nameRegex.test(name)) {
      return 'Nama hanya boleh berisi huruf, spasi, titik, dan tanda kutip';
    }
    return '';
  };

  const validateCardNumber = (cardNumber: string, fieldName: string): string => {
    if (!cardNumber) return `${fieldName} wajib diisi`;
    if (cardNumber.length !== 16) {
      return `${fieldName} harus terdiri dari 16 digit`;
    }
    const numberRegex = /^[0-9]{16}$/;
    if (!numberRegex.test(cardNumber)) {
      return `${fieldName} hanya boleh berisi angka`;
    }
    return '';
  };

  const validateBirthplace = (birthplace: string): string => {
    if (!birthplace) return 'Tempat lahir wajib diisi';
    const birthplaceRegex = /^[a-zA-Z\s.,-]+$/;
    if (!birthplaceRegex.test(birthplace)) {
      return 'Tempat lahir hanya boleh berisi huruf, spasi, titik, koma, dan tanda hubung';
    }
    return '';
  };

  const validateBirthdate = (birthdate: string): string => {
    if (!birthdate) return 'Tanggal lahir wajib diisi';
    const date = new Date(birthdate);
    const today = new Date();
    const minDate = new Date('1900-01-01');
    
    if (date >= today) {
      return 'Tanggal lahir harus sebelum hari ini';
    }
    if (date < minDate) {
      return 'Tanggal lahir tidak valid';
    }
    return '';
  };

  const validateSiblingClass = (siblingClass: string): string => {
    if (!siblingClass) return '';
    const classRegex = /^[a-zA-Z0-9\s-]+$/;
    if (!classRegex.test(siblingClass)) {
      return 'Kelas saudara hanya boleh berisi huruf, angka, spasi, dan tanda hubung';
    }
    return '';
  };

  // Client-side validation for student data
  const validateStudentData = (studentData: StudentData): ValidationResult => {
    const errors: ValidationErrors = {};

    // Required fields validation
    const fullNameRequiredError = validateRequired(studentData.fullName, 'Nama lengkap');
    const fullNameFormatError = fullNameRequiredError ? '' : validateName(studentData.fullName);
    const fullNameError = fullNameRequiredError || fullNameFormatError;
    if (fullNameError) errors.fullName = fullNameError;

    const nicknameError = validateName(studentData.nickname);
    if (nicknameError) errors.nickname = nicknameError;

    const familyCardError = validateCardNumber(studentData.familyCardNumber, 'Nomor Kartu Keluarga');
    if (familyCardError) errors.familyCardNumber = familyCardError;

    const nationalIdError = validateCardNumber(studentData.nationalIdNumber, 'NIK');
    if (nationalIdError) errors.nationalIdNumber = nationalIdError;

    const birthplaceError = validateBirthplace(studentData.birthplace);
    if (birthplaceError) errors.birthplace = birthplaceError;

    const birthdateError = validateBirthdate(studentData.birthdate);
    if (birthdateError) errors.birthdate = birthdateError;

    const genderError = validateRequired(studentData.gender, 'Jenis kelamin');
    if (genderError) errors.gender = genderError;

    const siblingNameError = validateName(studentData.siblingName);
    if (siblingNameError) errors.siblingName = siblingNameError;

    const siblingClassError = validateSiblingClass(studentData.siblingClass);
    if (siblingClassError) errors.siblingClass = siblingClassError;

    const schoolChoiceError = validateRequired(studentData.schoolChoice, 'Pilihan sekolah');
    if (schoolChoiceError) errors.schoolChoice = schoolChoiceError;

    const registrationTypeError = validateRequired(studentData.registrationType, 'Jenis pendaftaran');
    if (registrationTypeError) errors.registrationType = registrationTypeError;

    const selectedClassError = validateRequired(studentData.selectedClass, 'Kelas yang dipilih');
    if (selectedClassError) errors.selectedClass = selectedClassError;

    const trackError = validateRequired(studentData.track, 'Track');
    if (trackError) errors.track = trackError;

    const selectionMethodError = validateRequired(studentData.selectionMethod, 'Metode seleksi');
    if (selectionMethodError) errors.selectionMethod = selectionMethodError;

    const previousSchoolTypeError = validateRequired(studentData.previousSchoolType, 'Jenis sekolah sebelumnya');
    if (previousSchoolTypeError) errors.previousSchoolType = previousSchoolTypeError;

    const previousSchoolNameError = validateRequired(studentData.previousSchoolName, 'Nama sekolah sebelumnya');
    if (previousSchoolNameError) errors.previousSchoolName = previousSchoolNameError;

    const registrationInfoSourceError = validateRequired(studentData.registrationInfoSource, 'Sumber informasi pendaftaran');
    if (registrationInfoSourceError) errors.registrationInfoSource = registrationInfoSourceError;

    return {
      isValid: Object.keys(errors).length === 0,
      errors
    };
  };

  // Client-side validation for guardian data
  const validateGuardianData = (guardianData: GuardianData): ValidationResult => {
    const errors: ValidationErrors = {};

    // Check if at least one guardian is provided
    const hasAnyGuardian = guardianData.fatherName || guardianData.motherName || guardianData.guardianName;
    if (!hasAnyGuardian) {
      errors.guardians = 'Minimal satu data wali harus diisi';
      return { isValid: false, errors };
    }

    // Require address if any guardian is provided
    const addressError = validateRequired(guardianData.guardianAddress, 'Alamat');
    if (addressError) {
      errors.guardianAddress = addressError;
    }

    // Validate father data if provided
    if (guardianData.fatherName) {
      const fatherNameError = validateName(guardianData.fatherName);
      if (fatherNameError) errors.fatherName = fatherNameError;

      const fatherEmailError = validateEmail(guardianData.fatherEmail);
      if (fatherEmailError) errors.fatherEmail = fatherEmailError;

      const fatherPhoneError = validatePhone(guardianData.fatherPhone);
      if (fatherPhoneError) errors.fatherPhone = fatherPhoneError;
    }

    // Validate mother data if provided
    if (guardianData.motherName) {
      const motherNameError = validateName(guardianData.motherName);
      if (motherNameError) errors.motherName = motherNameError;

      const motherEmailError = validateEmail(guardianData.motherEmail);
      if (motherEmailError) errors.motherEmail = motherEmailError;

      const motherPhoneError = validatePhone(guardianData.motherPhone);
      if (motherPhoneError) errors.motherPhone = motherPhoneError;
    }

    // Validate guardian data if provided
    if (guardianData.guardianName) {
      const guardianNameError = validateName(guardianData.guardianName);
      if (guardianNameError) errors.guardianName = guardianNameError;

      const guardianEmailError = validateEmail(guardianData.guardianEmail);
      if (guardianEmailError) errors.guardianEmail = guardianEmailError;

      const guardianPhoneError = validatePhone(guardianData.guardianPhone);
      if (guardianPhoneError) errors.guardianPhone = guardianPhoneError;
    }

    return {
      isValid: Object.keys(errors).length === 0,
      errors
    };
  };

  // Fetch admission waves when school choice changes
  const fetchAdmissionWaves = async (level: string) => {
    if (!level) {
      setAdmissionWaves([]);
      return;
    }

    setLoadingAdmissionWaves(true);
    try {
      const response = await fetch(`${PARENT_API_BASE_URL}/admission-waves/by-level?level=${level}`);
      const result = await response.json();
      
      if (response.ok && result.success) {
        setAdmissionWaves(result.data);
      } else {
        console.error('Failed to fetch admission waves:', result);
        setAdmissionWaves([]);
      }
    } catch (error) {
      console.error('Error fetching admission waves:', error);
      setAdmissionWaves([]);
    } finally {
      setLoadingAdmissionWaves(false);
    }
  };

  // Function to get available class options based on school choice
  const getClassOptions = (schoolChoice: string) => {
    switch (schoolChoice) {
      case 'kb':
        return [
          { value: 'kb', label: 'KB' }
        ];
      case 'tk':
        return [
          { value: 'tk_a', label: 'TK A' },
          { value: 'tk_b', label: 'TK B' }
        ];
      case 'sd':
        return [
          { value: '1', label: 'Kelas 1' },
          { value: '2', label: 'Kelas 2' },
          { value: '3', label: 'Kelas 3' },
          { value: '4', label: 'Kelas 4' },
          { value: '5', label: 'Kelas 5' },
          { value: '6', label: 'Kelas 6' }
        ];
      default:
        return [];
    }
  };

  // Enhanced input change handlers with real-time validation for student fields
  const handleStudentInputChange = (
    e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>
  ) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      student: {
        ...prev.student,
        [name]: value,
      },
    }));

    // Fetch admission waves when school choice changes
    if (name === 'schoolChoice') {
      fetchAdmissionWaves(value);
      // Reset admission wave selection and selected class when school choice changes
      setFormData(prev => ({
        ...prev,
        student: {
          ...prev.student,
          schoolChoice: value,
          admissionWaveId: '',
          selectedClass: '' // Reset selected class when school choice changes
        }
      }));
    }

    let fieldError = '';
    switch (name) {
      case 'fullName':
        fieldError = validateRequired(value, 'Nama lengkap') || validateName(value);
        break;
      case 'nickname':
        fieldError = validateName(value);
        break;
      case 'familyCardNumber':
        fieldError = validateCardNumber(value, 'Nomor Kartu Keluarga');
        break;
      case 'nationalIdNumber':
        fieldError = validateCardNumber(value, 'NIK');
        break;
      case 'birthplace':
        fieldError = validateBirthplace(value);
        break;
      case 'birthdate':
        fieldError = validateBirthdate(value);
        break;
      case 'gender':
        fieldError = validateRequired(value, 'Jenis kelamin');
        break;
      case 'siblingName':
        fieldError = validateName(value);
        break;
      case 'siblingClass':
        fieldError = validateSiblingClass(value);
        break;
      case 'schoolChoice':
        fieldError = validateRequired(value, 'Pilihan sekolah');
        break;
      case 'registrationType':
        fieldError = validateRequired(value, 'Jenis pendaftaran');
        break;
      case 'selectedClass':
        fieldError = validateRequired(value, 'Kelas yang dipilih');
        break;
      case 'track':
        fieldError = validateRequired(value, 'Track');
        break;
      case 'selectionMethod':
        fieldError = validateRequired(value, 'Metode seleksi');
        break;
      case 'previousSchoolType':
        fieldError = validateRequired(value, 'Jenis sekolah sebelumnya');
        break;
      case 'previousSchoolName':
        fieldError = validateRequired(value, 'Nama sekolah sebelumnya');
        break;
      case 'registrationInfoSource':
        fieldError = validateRequired(value, 'Sumber informasi pendaftaran');
        break;
      case 'registrationReason':
        fieldError = '';
        break;
    }

    setErrors((prev) => ({
      ...prev,
      [name]: fieldError,
    }));
  };

  // Enhanced client-side validation before server call
  const validateStepClientSide = (step: number): boolean => {
    if (step === 1) {
      const validation = validateStudentData(formData.student);
      setErrors(validation.errors);
      return validation.isValid;
    } else if (step === 2) {
      const validation = validateGuardianData(formData.guardians);
      setErrors(validation.errors);
      return validation.isValid;
    }
    return true;
  };

  const handleGuardianInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      guardians: {
        ...prev.guardians,
        [name]: value
      }
    }));

    // Real-time validation for guardian fields
    let fieldError = '';

    if (name === 'guardianAddress') {
      fieldError = validateRequired(value, 'Alamat');
    } else if (name.includes('Name')) {
      fieldError = validateName(value);
    } else if (name.includes('Email')) {
      fieldError = validateEmail(value);
    } else if (name.includes('Phone')) {
      fieldError = validatePhone(value);
    }

    // Update errors state
    setErrors(prev => ({
      ...prev,
      [name]: fieldError
    }));
  };

  const validateStep = async (step: number) => {
    try {
      // First perform client-side validation
      if (!validateStepClientSide(step)) {
        return false;
      }

      let data;
      if (step === 1) {
        // Transform student data to match backend field names for validation
        data = {
          full_name: formData.student.fullName,
          nickname: formData.student.nickname,
          family_card_number: formData.student.familyCardNumber,
          national_id_number: formData.student.nationalIdNumber,
          birthplace: formData.student.birthplace,
          birthdate: formData.student.birthdate,
          gender: formData.student.gender,
          sibling_name: formData.student.siblingName,
          sibling_class: formData.student.siblingClass,
          school_choice: formData.student.schoolChoice,
          registration_type: formData.student.registrationType,
          selected_class: formData.student.selectedClass,
          track: formData.student.track,
          selection_method: formData.student.selectionMethod,
          previous_school_type: formData.student.previousSchoolType,
          previous_school_name: formData.student.previousSchoolName,
          registration_info_source: formData.student.registrationInfoSource,
          registration_reason: formData.student.registrationReason
        };
      } else if (step === 2) {
        // Transform guardian data
        const guardians: any[] = [];

        if (formData.guardians.fatherName) {
          guardians.push({
            type: 'father',
            name: formData.guardians.fatherName,
            job: formData.guardians.fatherJob,
            company: formData.guardians.fatherCompany,
            email: formData.guardians.fatherEmail,
            phone: formData.guardians.fatherPhone,
            address: formData.guardians.guardianAddress
          });
        }

        if (formData.guardians.motherName) {
          guardians.push({
            type: 'mother',
            name: formData.guardians.motherName,
            job: formData.guardians.motherJob,
            company: formData.guardians.motherCompany,
            email: formData.guardians.motherEmail,
            phone: formData.guardians.motherPhone,
            address: formData.guardians.guardianAddress
          });
        }

        if (formData.guardians.guardianName) {
          guardians.push({
            type: 'guardian',
            name: formData.guardians.guardianName,
            job: formData.guardians.guardianJob,
            company: formData.guardians.guardianCompany,
            email: formData.guardians.guardianEmail,
            phone: formData.guardians.guardianPhone,
            address: formData.guardians.guardianAddress
          });
        }

        data = { guardians };
      }

      const response = await fetch(`${API_BASE_URL}/registration/validate-step`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          step,
          data
        }),
      });

      const result = await response.json();

      if (response.ok) {
        // Validation succeeded: do not redirect here; just clear errors and allow proceeding to next step
        setErrors({});
        return true;
      } else {
        const normalizedErrors: ValidationErrors = {};
        if (result.errors) {
          Object.keys(result.errors).forEach((key) => {
            const messages = result.errors[key];
            normalizedErrors[key] = Array.isArray(messages) ? messages[0] : messages;
          });
        }
        setErrors(normalizedErrors);
        return false;
      }
    } catch (error) {
      console.error('Validation error:', error);
      setErrors({ general: 'An error occurred during validation. Please try again.' });
      return false;
    }
  };

  // Helper function to scroll to and focus on the first invalid field
  const scrollToFirstError = (errors: ValidationErrors) => {
    const errorKeys = Object.keys(errors);
    if (errorKeys.length === 0) return;

    const firstErrorField = errorKeys[0];
    
    // Try to find the input element by name attribute
    const inputElement = document.querySelector(`input[name="${firstErrorField}"], select[name="${firstErrorField}"], textarea[name="${firstErrorField}"]`) as HTMLElement;
    
    if (inputElement) {
      // Scroll to the element with smooth behavior
      inputElement.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center',
        inline: 'nearest'
      });
      
      // Focus on the element after a short delay to ensure scroll completes
      setTimeout(() => {
        inputElement.focus();
        
        // Add a subtle highlight effect by temporarily adding a class
        inputElement.classList.add('ring-2', 'ring-red-500', 'ring-opacity-50');
        setTimeout(() => {
          inputElement.classList.remove('ring-2', 'ring-red-500', 'ring-opacity-50');
        }, 2000);
      }, 300);
    }
  };

  const nextStep = async () => {
    if (currentStep < 3) {
      setIsValidating(true);
      const isValid = await validateStep(currentStep);
      if (isValid) {
        setCurrentStep(currentStep + 1);
      } else {
        // Scroll to and focus on the first invalid field
        scrollToFirstError(errors);
      }
      setIsValidating(false);
    }
  };

  const prevStep = () => {
    if (currentStep > 1) {
      setCurrentStep(currentStep - 1);
    }
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);

    try {
      // Transform guardian data to match backend expectations
      const guardians = [];
      
      // Add father if name is provided
      if (formData.guardians.fatherName) {
        guardians.push({
          type: 'father',
          name: formData.guardians.fatherName,
          job: formData.guardians.fatherJob,
          company: formData.guardians.fatherCompany,
          email: formData.guardians.fatherEmail,
          phone: formData.guardians.fatherPhone,
          address: formData.guardians.guardianAddress
        });
      }
      
      // Add mother if name is provided
      if (formData.guardians.motherName) {
        guardians.push({
          type: 'mother',
          name: formData.guardians.motherName,
          job: formData.guardians.motherJob,
          company: formData.guardians.motherCompany,
          email: formData.guardians.motherEmail,
          phone: formData.guardians.motherPhone,
          address: formData.guardians.guardianAddress
        });
      }
      
      // Add guardian if name is provided
      if (formData.guardians.guardianName) {
        guardians.push({
          type: 'guardian',
          name: formData.guardians.guardianName,
          job: formData.guardians.guardianJob,
          company: formData.guardians.guardianCompany,
          email: formData.guardians.guardianEmail,
          phone: formData.guardians.guardianPhone,
          address: formData.guardians.guardianAddress
        });
      }

      const submissionData = {
        // Transform student data to match backend field names
        full_name: formData.student.fullName,
        nickname: formData.student.nickname,
        family_card_number: formData.student.familyCardNumber,
        national_id_number: formData.student.nationalIdNumber,
        birthplace: formData.student.birthplace,
        birthdate: formData.student.birthdate,
        gender: formData.student.gender,
        sibling_name: formData.student.siblingName,
        sibling_class: formData.student.siblingClass,
        school_choice: formData.student.schoolChoice,
        registration_type: formData.student.registrationType,
        selected_class: formData.student.selectedClass,
        track: formData.student.track,
        selection_method: formData.student.selectionMethod,
        previous_school_type: formData.student.previousSchoolType,
        previous_school_name: formData.student.previousSchoolName,
        registration_info_source: formData.student.registrationInfoSource,
        registration_reason: formData.student.registrationReason,
        admission_wave_id: formData.student.admissionWaveId,
        guardians: guardians
      };

      const response = await fetch(`${API_BASE_URL}/registration`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(submissionData),
      });

      const result = await response.json();

      if (response.ok) {
        // Store success token securely in session storage and navigate to success page without exposing ID
        if (result?.data?.success_token) {
          try {
            sessionStorage.setItem('registration_success_token', result.data.success_token);
          } catch (e) {
            console.warn('Unable to store success token in sessionStorage', e);
          }
        }
        navigate(`/registration/success`, {
          state: {
            parentAccount: result.data.parent_account
          }
        });
      } else {
        setErrors(result.errors || {});
        // If there are validation errors, go back to the appropriate step
        if (result.errors) {
          const hasStudentErrors = Object.keys(result.errors).some(key => 
            ['full_name', 'nickname', 'family_card_number', 'national_id_number', 'birthplace', 'birthdate', 'gender', 'sibling_name', 'sibling_class', 'school_choice', 'registration_type', 'selected_class', 'track', 'selection_method', 'previous_school_type', 'previous_school_name', 'registration_info_source', 'registration_reason'].includes(key)
          );
          if (hasStudentErrors) {
            setCurrentStep(1);
          } else {
            setCurrentStep(2);
          }
        }
      }
    } catch (error) {
      console.error('Submission error:', error);
      alert('Terjadi kesalahan saat mengirim data. Silakan coba lagi.');
    } finally {
      setIsSubmitting(false);
    }
  };

  const renderStepContent = () => {
    switch (currentStep) {
      case 1:
        return (
          <div className="space-y-8">
            <div className="text-center mb-8">
              <div className="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-full mb-4">
                <UserIcon className="w-8 h-8 text-primary-600" />
              </div>
              <h3 className="text-2xl font-bold text-gray-900 mb-2">
                Informasi Siswa
              </h3>
              <p className="text-gray-600">
                Masukkan data lengkap siswa yang akan didaftarkan
              </p>
            </div>

            {/* Student Data Section */}
            <div className="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
              <div className="flex items-center mb-6">
                <div className="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full mr-3">
                  <UserIcon className="w-5 h-5 text-blue-600" />
                </div>
                <h4 className="text-lg font-semibold text-gray-900">Data Siswa</h4>
              </div>
              
              <div className="grid md:grid-cols-2 gap-6">
                {/* Full Name */}
                <div className="form-group">
                  <label className="form-label">Nama Lengkap *</label>
                  <input
                    type="text"
                    name="fullName"
                    value={formData.student.fullName}
                    onChange={handleStudentInputChange}
                    className="form-input"
                    placeholder="Masukkan nama lengkap siswa"
                    required
                  />
                  {errors.fullName && <div className="form-error">{errors.fullName}</div>}
                </div>

                {/* Nickname */}
                <div className="form-group">
                  <label className="form-label">Nama Panggilan</label>
                  <input
                    type="text"
                    name="nickname"
                    value={formData.student.nickname}
                    onChange={handleStudentInputChange}
                    className="form-input"
                    placeholder="Nama panggilan"
                  />
                </div>

                {/* Family Card Number */}
                <div className="form-group">
                  <label className="form-label">Nomor Kartu Keluarga *</label>
                  <input
                    type="text"
                    name="familyCardNumber"
                    value={formData.student.familyCardNumber}
                    onChange={handleStudentInputChange}
                    className="form-input"
                    placeholder="16 digit nomor KK"
                    required
                  />
                  {errors.familyCardNumber && <div className="form-error">{errors.familyCardNumber}</div>}
                </div>

                {/* National ID Number */}
                <div className="form-group">
                  <label className="form-label">NIK (Nomor Induk Kependudukan) *</label>
                  <input
                    type="text"
                    name="nationalIdNumber"
                    value={formData.student.nationalIdNumber}
                    onChange={handleStudentInputChange}
                    className="form-input"
                    placeholder="16 digit NIK"
                    required
                  />
                  {errors.nationalIdNumber && <div className="form-error">{errors.nationalIdNumber}</div>}
                </div>

                {/* Birthplace */}
                <div className="form-group">
                  <label className="form-label">Tempat Lahir *</label>
                  <input
                    type="text"
                    name="birthplace"
                    value={formData.student.birthplace}
                    onChange={handleStudentInputChange}
                    className="form-input"
                    placeholder="Masukkan tempat lahir"
                    required
                  />
                  {errors.birthplace && <div className="form-error">{errors.birthplace}</div>}
                </div>

                {/* Birthdate */}
                <div className="form-group">
                  <label className="form-label">Tanggal Lahir *</label>
                  <input
                    type="date"
                    name="birthdate"
                    value={formData.student.birthdate}
                    onChange={handleStudentInputChange}
                    className="form-input"
                    required
                  />
                  {errors.birthdate && <div className="form-error">{errors.birthdate}</div>}
                </div>

                {/* Gender */}
                <div className="form-group">
                  <label className="form-label">Jenis Kelamin *</label>
                  <select
                    name="gender"
                    value={formData.student.gender}
                    onChange={handleStudentInputChange}
                    className="form-select"
                    required
                  >
                    <option value="">Pilih jenis kelamin</option>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                  </select>
                  {errors.gender && <div className="form-error">{errors.gender}</div>}
                </div>

                {/* Sibling Name */}
                <div className="form-group">
                  <label className="form-label">Nama Saudara (jika bersekolah di ICM)</label>
                  <input
                    type="text"
                    name="siblingName"
                    value={formData.student.siblingName}
                    onChange={handleStudentInputChange}
                    className="form-input"
                    placeholder="Nama saudara kandung"
                  />
                </div>

                {/* Sibling Class */}
                <div className="form-group">
                  <label className="form-label">Kelas Saudara</label>
                  <input
                    type="text"
                    name="siblingClass"
                    value={formData.student.siblingClass}
                    onChange={handleStudentInputChange}
                    className="form-input"
                    placeholder="Kelas saudara kandung"
                  />
                </div>
              </div>
            </div>

            {/* School Data Section */}
            <div className="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
              <div className="flex items-center mb-6">
                <div className="flex items-center justify-center w-8 h-8 bg-green-100 rounded-full mr-3">
                  <svg className="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                  </svg>
                </div>
                <h4 className="text-lg font-semibold text-gray-900">Data Sekolah</h4>
              </div>
              
              <div className="grid md:grid-cols-2 gap-6">
                {/* School Choice */}
                <div className="form-group">
                  <label className="form-label">Pilihan Sekolah *</label>
                  <select
                    name="schoolChoice"
                    value={formData.student.schoolChoice}
                    onChange={handleStudentInputChange}
                    className="form-select"
                    required
                  >
                    <option value="">Pilih sekolah</option>
                    <option value="kb">KB (Kelompok Bermain)</option>
                    <option value="tk">TK (Tingkat Kelas)</option>
                    <option value="sd">SD (Sekolah Dasar)</option>
                  </select>
                  {errors.schoolChoice && <div className="form-error">{errors.schoolChoice}</div>}
                </div>

                {/* Selected Class */}
                <div className="form-group">
                  <label className="form-label">Kelas yang Dipilih *</label>
                  <select
                    name="selectedClass"
                    value={formData.student.selectedClass}
                    onChange={handleStudentInputChange}
                    className="form-select"
                    required
                  >
                    <option value="">Pilih kelas</option>
                    {getClassOptions(formData.student.schoolChoice).map((option) => (
                      <option key={option.value} value={option.value}>
                        {option.label}
                      </option>
                    ))}
                  </select>
                  {errors.selectedClass && <div className="form-error">{errors.selectedClass}</div>}
                </div>

                {/* Registration Type */}
                <div className="form-group">
                  <label className="form-label">Jenis Pendaftaran *</label>
                  <select
                    name="registrationType"
                    value={formData.student.registrationType}
                    onChange={handleStudentInputChange}
                    className="form-select"
                    required
                  >
                    <option value="">Pilih jenis pendaftaran</option>
                    <option value="Booking Seat">Booking Seat</option>
                    <option value="Inden">Inden</option>
                    <option value="Regular">Regular</option>
                  </select>
                  {errors.registrationType && <div className="form-error">{errors.registrationType}</div>}
                </div>



                {/* Admission Wave */}
                {formData.student.schoolChoice && (
                  <div className="form-group">
                    <label className="form-label">Gelombang Pendaftaran *</label>
                    <select
                      name="admissionWaveId"
                      value={formData.student.admissionWaveId}
                      onChange={handleStudentInputChange}
                      className="form-select"
                      required
                      disabled={loadingAdmissionWaves}
                    >
                      <option value="">
                        {loadingAdmissionWaves 
                          ? 'Memuat gelombang...' 
                          : admissionWaves.length === 0 
                            ? 'Tidak ada gelombang tersedia' 
                            : 'Pilih gelombang pendaftaran'
                        }
                      </option>
                      {admissionWaves.map((wave) => (
                        <option key={wave.id} value={wave.id}>
                          {wave.name}
                        </option>
                      ))}
                    </select>
                    {errors.admissionWaveId && <div className="form-error">{errors.admissionWaveId}</div>}
                  </div>
                )}

                {/* Track */}
                <div className="form-group">
                  <label className="form-label">Track *</label>
                  <select
                    name="track"
                    value={formData.student.track}
                    onChange={handleStudentInputChange}
                    className="form-select"
                    required
                  >
                    <option value="">Pilih track</option>
                    <option value="Regular">Regular</option>
                    <option value="Other">Other</option>
                  </select>
                  {errors.track && <div className="form-error">{errors.track}</div>}
                </div>

                {/* Selection Method */}
                <div className="form-group">
                  <label className="form-label">Metode Seleksi *</label>
                  <select
                    name="selectionMethod"
                    value={formData.student.selectionMethod}
                    onChange={handleStudentInputChange}
                    className="form-select"
                  >
                    <option value="">Pilih metode seleksi</option>
                    <option value="Tes Tulis">Tes Tulis</option>
                    <option value="Wawancara">Wawancara</option>
                    <option value="Portofolio">Portofolio</option>
                  </select>
                  {errors.selectionMethod && <div className="form-error">{errors.selectionMethod}</div>}
                </div>

                {/* Previous School Type */}
                <div className="form-group">
                  <label className="form-label">Jenis Sekolah Sebelumnya *</label>
                  <select
                    name="previousSchoolType"
                    value={formData.student.previousSchoolType}
                    onChange={handleStudentInputChange}
                    className="form-select"
                  >
                    <option value="">Pilih jenis sekolah</option>
                    <option value="Negeri">Negeri</option>
                    <option value="Swasta">Swasta</option>
                    <option value="Madrasah">Madrasah</option>
                    <option value="Internasional">Internasional</option>
                    <option value="Homeschooling">Homeschooling</option>
                  </select>
                  {errors.previousSchoolType && <div className="form-error">{errors.previousSchoolType}</div>}
                </div>

                {/* Previous School Name */}
                <div className="form-group">
                  <label className="form-label">Nama Sekolah Sebelumnya *</label>
                  <input
                    type="text"
                    name="previousSchoolName"
                    value={formData.student.previousSchoolName}
                    onChange={handleStudentInputChange}
                    className="form-input"
                    placeholder="Masukkan nama sekolah sebelumnya"
                  />
                  {errors.previousSchoolName && <div className="form-error">{errors.previousSchoolName}</div>}
                </div>

                {/* Registration Info Source */}
                <div className="form-group">
                  <label className="form-label">Sumber Informasi Pendaftaran *</label>
                  <select
                    name="registrationInfoSource"
                    value={formData.student.registrationInfoSource}
                    onChange={handleStudentInputChange}
                    className="form-select"
                  >
                    <option value="">Pilih sumber informasi</option>
                    <option value="Website">Website</option>
                    <option value="Media Sosial">Media Sosial</option>
                    <option value="Teman/Keluarga">Teman/Keluarga</option>
                    <option value="Brosur">Brosur</option>
                  </select>
                  {errors.registrationInfoSource && <div className="form-error">{errors.registrationInfoSource}</div>}
                </div>

                {/* Registration Reason */}
                <div className="form-group md:col-span-2">
                  <label className="form-label">Alasan Memilih Sekolah Ini</label>
                  <textarea
                    name="registrationReason"
                    value={formData.student.registrationReason}
                    onChange={handleStudentInputChange}
                    className="form-textarea"
                    placeholder="Jelaskan alasan memilih sekolah ini"
                    rows={4}
                  />
                  {errors.registrationReason && <div className="form-error">{errors.registrationReason}</div>}
                </div>
              </div>
            </div>
          </div>
        );

      case 2:
        return (
          <div className="space-y-6">
            <div className="text-center mb-8">
              <div className="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-full mb-4">
                <UsersIcon className="w-8 h-8 text-primary-600" />
              </div>
              <h3 className="text-2xl font-bold text-gray-900 mb-2">
                Informasi Orang Tua/Wali
              </h3>
              <p className="text-gray-600">
                Masukkan data lengkap orang tua dan wali siswa
              </p>
            </div>

            {/* Father Information */}
            <div>
              <h3 className="text-lg font-medium text-gray-900 mb-4">Data Ayah</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="form-group">
                  <label className="form-label">Nama Ayah *</label>
                  <input
                    type="text"
                    name="fatherName"
                    value={formData.guardians.fatherName}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan nama ayah"
                  />
                  {errors['guardians.0.name'] && <div className="form-error">{errors['guardians.0.name']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Pekerjaan Ayah *</label>
                  <input
                    type="text"
                    name="fatherJob"
                    value={formData.guardians.fatherJob}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan pekerjaan ayah"
                  />
                  {errors['guardians.0.job'] && <div className="form-error">{errors['guardians.0.job']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Perusahaan/Instansi Ayah</label>
                  <input
                    type="text"
                    name="fatherCompany"
                    value={formData.guardians.fatherCompany}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan perusahaan/instansi ayah"
                  />
                  {errors['guardians.0.company'] && <div className="form-error">{errors['guardians.0.company']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Email Ayah *</label>
                  <input
                    type="email"
                    name="fatherEmail"
                    value={formData.guardians.fatherEmail}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan email ayah"
                  />
                  {errors['guardians.0.email'] && <div className="form-error">{errors['guardians.0.email']}</div>}
                </div>

                <div className="form-group md:col-span-2">
                  <label className="form-label">Nomor Telepon Ayah *</label>
                  <input
                    type="tel"
                    name="fatherPhone"
                    value={formData.guardians.fatherPhone}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan nomor telepon ayah"
                  />
                  {errors['guardians.0.phone'] && <div className="form-error">{errors['guardians.0.phone']}</div>}
                </div>
              </div>
            </div>

            {/* Mother Information */}
            <div>
              <h3 className="text-lg font-medium text-gray-900 mb-4">Data Ibu</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="form-group">
                  <label className="form-label">Nama Ibu *</label>
                  <input
                    type="text"
                    name="motherName"
                    value={formData.guardians.motherName}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan nama ibu"
                  />
                  {errors['guardians.1.name'] && <div className="form-error">{errors['guardians.1.name']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Pekerjaan Ibu *</label>
                  <input
                    type="text"
                    name="motherJob"
                    value={formData.guardians.motherJob}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan pekerjaan ibu"
                  />
                  {errors['guardians.1.job'] && <div className="form-error">{errors['guardians.1.job']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Perusahaan/Instansi Ibu</label>
                  <input
                    type="text"
                    name="motherCompany"
                    value={formData.guardians.motherCompany}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan perusahaan/instansi ibu"
                  />
                  {errors['guardians.1.company'] && <div className="form-error">{errors['guardians.1.company']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Email Ibu *</label>
                  <input
                    type="email"
                    name="motherEmail"
                    value={formData.guardians.motherEmail}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan email ibu"
                  />
                  {(errors.motherEmail || errors['guardians.1.email']) && <div className="form-error">{errors.motherEmail || errors['guardians.1.email']}</div>}
                </div>

                <div className="form-group md:col-span-2">
                  <label className="form-label">Nomor Telepon Ibu *</label>
                  <input
                    type="tel"
                    name="motherPhone"
                    value={formData.guardians.motherPhone}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan nomor telepon ibu"
                  />
                  {(errors.motherPhone || errors['guardians.1.phone']) && <div className="form-error">{errors.motherPhone || errors['guardians.1.phone']}</div>}
                </div>
              </div>
            </div>

            {/* Guardian Information */}
            <div>
              <h3 className="text-lg font-medium text-gray-900 mb-4">Data Wali (Opsional)</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="form-group">
                  <label className="form-label">Nama Wali</label>
                  <input
                    type="text"
                    name="guardianName"
                    value={formData.guardians.guardianName}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan nama wali"
                  />
                  {(errors.guardianName || errors['guardians.2.name']) && <div className="form-error">{errors.guardianName || errors['guardians.2.name']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Pekerjaan Wali</label>
                  <input
                    type="text"
                    name="guardianJob"
                    value={formData.guardians.guardianJob}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan pekerjaan wali"
                  />
                  {errors['guardians.2.job'] && <div className="form-error">{errors['guardians.2.job']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Perusahaan/Instansi Wali</label>
                  <input
                    type="text"
                    name="guardianCompany"
                    value={formData.guardians.guardianCompany}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan perusahaan/instansi wali"
                  />
                  {errors['guardians.2.company'] && <div className="form-error">{errors['guardians.2.company']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Email Wali</label>
                  <input
                    type="email"
                    name="guardianEmail"
                    value={formData.guardians.guardianEmail}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan email wali"
                  />
                  {(errors.guardianEmail || errors['guardians.2.email']) && <div className="form-error">{errors.guardianEmail || errors['guardians.2.email']}</div>}
                </div>

                <div className="form-group">
                  <label className="form-label">Nomor Telepon Wali</label>
                  <input
                    type="tel"
                    name="guardianPhone"
                    value={formData.guardians.guardianPhone}
                    onChange={handleGuardianInputChange}
                    className="form-input"
                    placeholder="Masukkan nomor telepon wali"
                  />
                  {(errors.guardianPhone || errors['guardians.2.phone']) && <div className="form-error">{errors.guardianPhone || errors['guardians.2.phone']}</div>}
                </div>

                <div className="form-group md:col-span-2">
                  <label className="form-label">Alamat Lengkap *</label>
                  <textarea
                    name="guardianAddress"
                    value={formData.guardians.guardianAddress}
                    onChange={handleGuardianInputChange}
                    className="form-textarea"
                    placeholder="Masukkan alamat lengkap"
                    rows={4}
                  />
                  {(errors.guardianAddress || errors.address || errors['guardians.0.address'] || errors['guardians.1.address'] || errors['guardians.2.address']) && (
                    <div className="form-error">{errors.guardianAddress || errors.address || errors['guardians.0.address'] || errors['guardians.1.address'] || errors['guardians.2.address']}</div>
                  )}
                </div>
              </div>
            </div>
          </div>
        );

      case 3:
        return (
          <div className="space-y-6">
            <div className="text-center mb-8">
              <div className="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-full mb-4">
                <CheckCircleIcon className="w-8 h-8 text-primary-600" />
              </div>
              <h3 className="text-2xl font-bold text-gray-900 mb-2">
                Konfirmasi Data
              </h3>
              <p className="text-gray-600">
                Periksa kembali data yang telah Anda masukkan sebelum mengirim pendaftaran
              </p>
            </div>

            <div className="alert alert-info">
              <ExclamationTriangleIcon className="w-5 h-5 mr-2" />
              Mohon periksa kembali data yang telah Anda masukkan sebelum mengirim pendaftaran.
            </div>

            {/* Student Data Review */}
            <div>
              <h3 className="text-lg font-medium text-gray-900 mb-4">Data Siswa</h3>
              <div className="bg-gray-50 p-6 rounded-lg">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                  <div><strong>Nama Lengkap:</strong> {formData.student.fullName}</div>
                  <div><strong>Nama Panggilan:</strong> {formData.student.nickname}</div>
                  <div><strong>NIK:</strong> {formData.student.nationalIdNumber}</div>
                  <div><strong>Tempat, Tanggal Lahir:</strong> {formData.student.birthplace}, {formData.student.birthdate}</div>
                  <div><strong>Jenis Kelamin:</strong> {formData.student.gender}</div>
                  <div><strong>Pilihan Sekolah:</strong> {formData.student.schoolChoice}</div>
                  <div><strong>Kelas:</strong> {formData.student.selectedClass}</div>
                </div>
              </div>
            </div>

            {/* Guardian Data Review */}
            <div>
              <h3 className="text-lg font-medium text-gray-900 mb-4">Data Orang Tua/Wali</h3>
              <div className="bg-gray-50 p-6 rounded-lg">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                  <div><strong>Nama Ayah:</strong> {formData.guardians.fatherName}</div>
                  <div><strong>Pekerjaan Ayah:</strong> {formData.guardians.fatherJob}</div>
                  <div><strong>Email Ayah:</strong> {formData.guardians.fatherEmail}</div>
                  <div><strong>Telepon Ayah:</strong> {formData.guardians.fatherPhone}</div>
                  <div><strong>Nama Ibu:</strong> {formData.guardians.motherName}</div>
                  <div><strong>Pekerjaan Ibu:</strong> {formData.guardians.motherJob}</div>
                  <div><strong>Email Ibu:</strong> {formData.guardians.motherEmail}</div>
                  <div><strong>Telepon Ibu:</strong> {formData.guardians.motherPhone}</div>
                  {formData.guardians.guardianName && (
                    <>
                      <div><strong>Nama Wali:</strong> {formData.guardians.guardianName}</div>
                      <div><strong>Pekerjaan Wali:</strong> {formData.guardians.guardianJob}</div>
                    </>
                  )}
                </div>
                <div className="mt-4">
                  <div><strong>Alamat:</strong> {formData.guardians.guardianAddress}</div>
                </div>
              </div>
            </div>
          </div>
        );

      default:
        return null;
    }
  }

  return (
    <div className="min-h-screen bg-gray-50 py-8">
      <div className="container">
        {/* Top Navigation */}
        <div className="max-w-4xl mx-auto mb-4">
          <div className="flex justify-end space-x-3">
            <Link
              to="/"
              className="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium text-primary-600 hover:text-primary-700 hover:bg-primary-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
            >
              <HomeIcon className="w-5 h-5 mr-2" />
              Beranda
            </Link>
            <Link
              to="/login"
              className="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium text-primary-600 hover:text-primary-700 hover:bg-primary-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
            >
              <ArrowRightOnRectangleIcon className="w-5 h-5 mr-2" />
              Masuk
            </Link>
          </div>
        </div>
        {/* Header */}
        <div className="text-center mb-8">
          <h1 className="page-title">Pendaftaran Siswa Baru</h1>
          <p className="page-subtitle">Yayasan Al-Munawwar</p>
        </div>

        {/* Progress Bar */}
        <div className="max-w-3xl mx-auto mb-8">
          <div className="flex items-center justify-between mb-4">
            <div className="flex items-center">
              <div className={`flex items-center justify-center w-8 h-8 rounded-full ${
                currentStep >= 1 ? 'bg-primary-600 text-white' : 'bg-gray-300 text-gray-600'
              }`}>
                <UserIcon className="w-4 h-4" />
              </div>
              <span className="ml-2 text-sm font-medium text-gray-700">Informasi Siswa</span>
            </div>
            
            <div className={`flex-1 h-1 mx-4 rounded ${
              currentStep >= 2 ? 'bg-primary-600' : 'bg-gray-300'
            }`} />
            
            <div className="flex items-center">
              <div className={`flex items-center justify-center w-8 h-8 rounded-full ${
                currentStep >= 2 ? 'bg-primary-600 text-white' : 'bg-gray-300 text-gray-600'
              }`}>
                <UsersIcon className="w-4 h-4" />
              </div>
              <span className="ml-2 text-sm font-medium text-gray-700">Informasi Orang Tua/Wali</span>
            </div>
            
            <div className={`flex-1 h-1 mx-4 rounded ${
              currentStep >= 3 ? 'bg-primary-600' : 'bg-gray-300'
            }`} />
            
            <div className="flex items-center">
              <div className={`flex items-center justify-center w-8 h-8 rounded-full ${
                currentStep >= 3 ? 'bg-primary-600 text-white' : 'bg-gray-300 text-gray-600'
              }`}>
                <CheckCircleIcon className="w-4 h-4" />
              </div>
              <span className="ml-2 text-sm font-medium text-gray-700">Konfirmasi Data</span>
            </div>
          </div>
        </div>

        {/* Form Card */}
        <div className="max-w-4xl mx-auto">
          <div className="card">
            <div className="card-header">
              <h2 className="text-xl font-semibold text-gray-900">
                {currentStep === 1 && 'Langkah 1: Informasi Siswa'}
                {currentStep === 2 && 'Langkah 2: Informasi Orang Tua/Wali'}
                {currentStep === 3 && 'Langkah 3: Konfirmasi Data'}
              </h2>
            </div>
            
            <div className="card-body">
              {renderStepContent()}
            </div>
            
            <div className="card-footer">
              <div className="flex justify-between">
                <button
                  type="button"
                  onClick={prevStep}
                  disabled={currentStep === 1}
                  className="btn btn-secondary disabled:opacity-50"
                >
                  <ChevronLeftIcon className="w-4 h-4 mr-2" />
                  Sebelumnya
                </button>
                
                {currentStep < 3 ? (
                  <button
                    type="button"
                    onClick={nextStep}
                    disabled={isValidating}
                    className="btn btn-primary disabled:opacity-50"
                  >
                    {isValidating ? 'Memeriksa...' : 'Selanjutnya'}
                    <ChevronRightIcon className="w-4 h-4 ml-2" />
                  </button>
                ) : (
                  <button
                    type="button"
                    onClick={handleSubmit}
                    disabled={isSubmitting}
                    className="btn btn-primary disabled:opacity-50"
                  >
                    {isSubmitting ? 'Mengirim...' : 'Kirim Pendaftaran'}
                  </button>
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default RegistrationPage;