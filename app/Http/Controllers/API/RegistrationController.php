<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use App\Models\Guardian;
use App\Models\ParentAccount;
use App\Models\User; // FIX: import User model
use App\Models\AdmissionWave; // Add AdmissionWave model import
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class RegistrationController extends Controller
{
    /**
     * Store a new student registration
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the registration data
            $validator = Validator::make($request->all(), [
                // Student Information
                'full_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\.\']+$/',
                'nickname' => 'nullable|string|max:100|regex:/^[a-zA-Z\s\.\']+$/',
                'family_card_number' => 'required|string|size:16|regex:/^[0-9]{16}$/',
                'national_id_number' => 'required|string|size:16|regex:/^[0-9]{16}$/',
                'birthplace' => 'required|string|max:255|regex:/^[a-zA-Z\s\.,\-]+$/',
                'birthdate' => 'required|date|before:today|after:1900-01-01',
                'gender' => 'required|in:male,female',
                'sibling_name' => 'nullable|string|max:255|regex:/^[a-zA-Z\s\.\']+$/',
                'sibling_class' => 'nullable|string|max:50|regex:/^[a-zA-Z0-9\s\-]+$/',
                'school_choice' => 'required|string|max:255',
                'registration_type' => 'required|string|max:100',
                'selected_class' => 'required|string|max:50',
                'track' => 'required|string|max:100',
                'selection_method' => 'required|string|max:100',
                'previous_school_type' => 'required|string|max:100',
                'previous_school_name' => 'required|string|max:255',
                'registration_info_source' => 'required|string|max:255',
                'registration_reason' => 'nullable|string|max:1000',

                // Guardian Information
                'guardians' => 'required|array|min:1|max:3',
                'guardians.*.type' => 'required|in:father,mother,guardian',
                'guardians.*.name' => 'required|string|max:255|regex:/^[a-zA-Z\s\.\']+$/',
                'guardians.*.job' => 'nullable|string|max:255',
                'guardians.*.company' => 'nullable|string|max:255',
                'guardians.*.email' => 'nullable|email|max:255',
                'guardians.*.phone' => 'nullable|string|min:10|max:15|regex:/^[0-9+]+$/',
                'guardians.*.address' => 'nullable|string|max:500',
            ], [
                // Custom error messages
                'full_name.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, titik, dan tanda kutip.',
                'nickname.regex' => 'Nama panggilan hanya boleh berisi huruf, spasi, titik, dan tanda kutip.',
                'family_card_number.size' => 'Nomor Kartu Keluarga harus terdiri dari 16 digit.',
                'family_card_number.regex' => 'Nomor Kartu Keluarga hanya boleh berisi angka.',
                'national_id_number.size' => 'NIK harus terdiri dari 16 digit.',
                'national_id_number.regex' => 'NIK hanya boleh berisi angka.',
                'birthplace.regex' => 'Tempat lahir hanya boleh berisi huruf, spasi, titik, koma, dan tanda hubung.',
                'birthdate.after' => 'Tanggal lahir tidak valid.',
                'sibling_name.regex' => 'Nama saudara hanya boleh berisi huruf, spasi, titik, dan tanda kutip.',
                'sibling_class.regex' => 'Kelas saudara hanya boleh berisi huruf, angka, spasi, dan tanda hubung.',
                'guardians.*.name.regex' => 'Nama wali hanya boleh berisi huruf, spasi, titik, dan tanda kutip.',
                'guardians.*.email.email' => 'Format email tidak valid.',
                'guardians.*.phone.regex' => 'Format nomor telepon tidak valid. Gunakan format Indonesia (contoh: 08123456789, +6281234567890).',
                'guardians.*.phone.min' => 'Nomor telepon minimal 10 digit.',
                'guardians.*.phone.max' => 'Nomor telepon maksimal 15 digit.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validatedData = $validator->validated();

            // Use database transaction to ensure data consistency
            DB::beginTransaction();

            try {
                // Create student registration
                $studentRegistration = StudentRegistration::create([
                    'full_name' => $validatedData['full_name'],
                    'nickname' => $validatedData['nickname'],
                    'family_card_number' => $validatedData['family_card_number'],
                    'national_id_number' => $validatedData['national_id_number'],
                    'birthplace' => $validatedData['birthplace'],
                    'birthdate' => $validatedData['birthdate'],
                    'gender' => $validatedData['gender'],
                    'sibling_name' => $validatedData['sibling_name'],
                    'sibling_class' => $validatedData['sibling_class'],
                    'school_choice' => $validatedData['school_choice'],
                    'registration_type' => $validatedData['registration_type'],
                    'selected_class' => $validatedData['selected_class'],
                    'track' => $validatedData['track'],
                    'selection_method' => $validatedData['selection_method'],
                    'previous_school_type' => $validatedData['previous_school_type'],
                    'previous_school_name' => $validatedData['previous_school_name'],
                    'registration_info_source' => $validatedData['registration_info_source'],
                    'registration_reason' => $validatedData['registration_reason'],
                ]);

                // Create guardians
                foreach ($validatedData['guardians'] as $guardianData) {
                    Guardian::create([
                        'student_registration_id' => $studentRegistration->id,
                        'type' => $guardianData['type'],
                        'name' => $guardianData['name'],
                        'job' => $guardianData['job'],
                        'company' => $guardianData['company'],
                        'email' => $guardianData['email'],
                        'phone' => $guardianData['phone'],
                        'address' => $guardianData['address'],
                    ]);
                }

                // Create parent user and account based on available guardian email
                $parentEmail = collect($validatedData['guardians'])
                    ->pluck('email')
                    ->filter()
                    ->first();

                $parentName = collect($validatedData['guardians'])
                    ->pluck('name')
                    ->filter()
                    ->first() ?? $validatedData['full_name'] . "'s Parent";

                // Generate a username if possible (based on email local part or name)
                $generatedUsername = null;
                if ($parentEmail) {
                    $localPart = explode('@', $parentEmail)[0];
                    $generatedUsername = Str::slug($localPart);
                } else {
                    $generatedUsername = Str::slug($parentName);
                }
                // Ensure uniqueness by appending numeric suffix if needed
                $baseUsername = $generatedUsername;
                $suffix = 1;
                while ($generatedUsername && User::where('name', $generatedUsername)->exists()) {
                    $generatedUsername = $baseUsername . '-' . $suffix++;
                }

                // Generate a random plaintext password to show on success page
                $plaintextPassword = Str::random(10);

                // Create User for parent auth
                $parentUser = User::create([
                    'name' => $generatedUsername ?: $parentName,
                    'email' => $parentEmail ?: ('parent+' . $studentRegistration->id . '@example.com'),
                    'password' => Hash::make($plaintextPassword),
                    'role' => 'parent',
                    'is_active' => true,
                ]);

                // Create ParentAccount linking to the registration and user
                $parentAccount = ParentAccount::create([
                    'student_registration_id' => $studentRegistration->id,
                    'user_id' => $parentUser->id,
                    'email' => $parentUser->email,
                    'username' => $generatedUsername,
                    'password' => $parentUser->password,
                ]);

                DB::commit();

                // Generate a registration number
                $registrationNumber = 'REG-' . date('Y') . '-' . str_pad($studentRegistration->id, 6, '0', STR_PAD_LEFT);
                
                // Create short-lived success token (10 minutes) to fetch success data without exposing ID
                $successToken = Str::random(40);
                Cache::put('registration_success_' . $successToken, $studentRegistration->id, now()->addMinutes(10));
                
                // Log the registration for tracking
                Log::info('New student registration created', [
                    'registration_id' => $studentRegistration->id,
                    'registration_number' => $registrationNumber,
                    'student_name' => $validatedData['full_name'],
                    'school_choice' => $validatedData['school_choice'],
                    'selected_class' => $validatedData['selected_class']
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran berhasil dikirim!',
                    'data' => [
                        'registration_id' => $studentRegistration->id,
                        'registration_number' => $registrationNumber,
                        'student_name' => $validatedData['full_name'],
                        'school_choice' => $validatedData['school_choice'],
                        'selected_class' => $validatedData['selected_class'],
                        'status' => 'pending_review',
                        'submitted_at' => $studentRegistration->created_at->toISOString(),
                        'parent_account' => [
                            'email' => $parentUser->email,
                            'username' => $generatedUsername,
                            'plaintext_password' => $plaintextPassword,
                        ],
                        'success_token' => $successToken
                    ]
                ], 201);

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Registration submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pendaftaran. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get a specific registration by ID
     */
    public function success(Request $request): JsonResponse
    {
        $authHeader = $request->header('Authorization', '');
        if (!Str::startsWith($authHeader, 'Bearer ')) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing token'
            ], 401);
        }

        $token = trim(substr($authHeader, 7));
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing token'
            ], 401);
        }

        $registrationId = Cache::get('registration_success_' . $token);
        if (!$registrationId) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired token'
            ], 401);
        }

        try {
            $registration = StudentRegistration::with('guardians')->findOrFail($registrationId);
            $parentAccount = ParentAccount::where('student_registration_id', $registrationId)->first();

            $formattedData = [
                'id' => $registration->id,
                'registrationNumber' => 'REG-' . date('Y') . '-' . str_pad($registration->id, 6, '0', STR_PAD_LEFT),
                'student' => [
                    'fullName' => $registration->full_name,
                    'nickname' => $registration->nickname,
                    'birthplace' => $registration->birthplace,
                    'birthdate' => $registration->birthdate,
                    'gender' => $registration->gender,
                    'schoolChoice' => $registration->school_choice,
                    'selectedClass' => $registration->selected_class,
                    'track' => $registration->track,
                    'registrationType' => $registration->registration_type,
                ],
                'guardians' => [
                    'fatherName' => $registration->guardians->where('type', 'father')->first()->name ?? '-',
                    'fatherPhone' => $registration->guardians->where('type', 'father')->first()->phone ?? '-',
                    'fatherEmail' => $registration->guardians->where('type', 'father')->first()->email ?? '-',
                    'motherName' => $registration->guardians->where('type', 'mother')->first()->name ?? '-',
                    'motherPhone' => $registration->guardians->where('type', 'mother')->first()->phone ?? '-',
                    'motherEmail' => $registration->guardians->where('type', 'mother')->first()->email ?? '-',
                ],
                'submittedAt' => $registration->created_at->toISOString(),
                'status' => 'Menunggu Verifikasi',
                'parentAccount' => $parentAccount ? [
                    'email' => $parentAccount->email,
                    'username' => $parentAccount->username,
                ] : null,
            ];

            return response()->json([
                'success' => true,
                'data' => $formattedData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration not found'
            ], 404);
        }
    }

    /**
     * Get available programs
     */
    public function getPrograms(): JsonResponse
    {
        $programs = [
            [
                'id' => 'SD',
                'name' => 'Sekolah Dasar (SD)',
                'description' => 'Program pendidikan dasar untuk anak usia 6-12 tahun',
                'duration' => '6 tahun',
                'classes' => ['1', '2', '3', '4', '5', '6']
            ],
            [
                'id' => 'SMP',
                'name' => 'Sekolah Menengah Pertama (SMP)',
                'description' => 'Program pendidikan menengah pertama untuk anak usia 12-15 tahun',
                'duration' => '3 tahun',
                'classes' => ['7', '8', '9']
            ],
            [
                'id' => 'SMA',
                'name' => 'Sekolah Menengah Atas (SMA)',
                'description' => 'Program pendidikan menengah atas untuk anak usia 15-18 tahun',
                'duration' => '3 tahun',
                'classes' => ['10', '11', '12']
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $programs
        ]);
    }

    /**
     * Get available classes for a specific program
     */
    public function getClasses(string $program): JsonResponse
    {
        $classes = [
            'SD' => [
                ['id' => '1', 'name' => 'Kelas 1', 'capacity' => 30, 'available' => 25],
                ['id' => '2', 'name' => 'Kelas 2', 'capacity' => 30, 'available' => 28],
                ['id' => '3', 'name' => 'Kelas 3', 'capacity' => 30, 'available' => 22],
                ['id' => '4', 'name' => 'Kelas 4', 'capacity' => 30, 'available' => 30],
                ['id' => '5', 'name' => 'Kelas 5', 'capacity' => 30, 'available' => 18],
                ['id' => '6', 'name' => 'Kelas 6', 'capacity' => 30, 'available' => 15]
            ],
            'SMP' => [
                ['id' => '7', 'name' => 'Kelas 7', 'capacity' => 32, 'available' => 30],
                ['id' => '8', 'name' => 'Kelas 8', 'capacity' => 32, 'available' => 25],
                ['id' => '9', 'name' => 'Kelas 9', 'capacity' => 32, 'available' => 20]
            ],
            'SMA' => [
                ['id' => '10', 'name' => 'Kelas 10', 'capacity' => 35, 'available' => 32],
                ['id' => '11', 'name' => 'Kelas 11', 'capacity' => 35, 'available' => 28],
                ['id' => '12', 'name' => 'Kelas 12', 'capacity' => 35, 'available' => 22]
            ]
        ];

        if (!isset($classes[$program])) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $classes[$program]
        ]);
    }

    /**
     * Validate a specific step of the registration form
     */
    public function validateStep(Request $request): JsonResponse
    {
        $step = $request->input('step');
        $data = $request->input('data', []);

        $rules = [];

        switch ($step) {
            case 1:
                $rules = [
                    'full_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\.\']+$/',
                    'nickname' => 'nullable|string|max:100|regex:/^[a-zA-Z\s\.\']+$/',
                    'family_card_number' => 'required|string|size:16|regex:/^[0-9]{16}$/',
                    'national_id_number' => 'required|string|size:16|regex:/^[0-9]{16}$/',
                    'birthplace' => 'required|string|max:255|regex:/^[a-zA-Z\s\.,\-]+$/',
                    'birthdate' => 'required|date|before:today|after:1900-01-01',
                    'gender' => 'required|in:male,female',
                    'sibling_name' => 'nullable|string|max:255|regex:/^[a-zA-Z\s\.\']+$/',
                    'sibling_class' => 'nullable|string|max:50|regex:/^[a-zA-Z0-9\s\-]+$/',
                    'school_choice' => 'required|string|max:255',
                    'registration_type' => 'required|string|max:100',
                    'selected_class' => 'required|string|max:50',
                    'track' => 'required|string|max:100',
                    'selection_method' => 'required|string|max:100',
                    'previous_school_type' => 'required|string|max:100',
                    'previous_school_name' => 'required|string|max:255',
                    'registration_info_source' => 'required|string|max:255',
                    'registration_reason' => 'nullable|string|max:1000',
                ];
                break;
            case 2:
                $rules = [
                    'guardians' => 'required|array|min:1|max:3',
                    'guardians.*.type' => 'required|in:father,mother,guardian',
                    'guardians.*.name' => 'required|string|max:255|regex:/^[a-zA-Z\s\.\']+$/',
                    'guardians.*.job' => 'nullable|string|max:255',
                    'guardians.*.company' => 'nullable|string|max:255',
                    'guardians.*.email' => 'nullable|email|max:255',
                    'guardians.*.phone' => 'nullable|string|min:10|max:15|regex:/^[0-9+]+$/',
                    'guardians.*.address' => 'nullable|string|max:500',
                ];
                break;
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid step'
                ], 400);
        }

        $validator = Validator::make($data, $rules, [
            // Custom error messages
            'full_name.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, titik, dan tanda kutip.',
            'nickname.regex' => 'Nama panggilan hanya boleh berisi huruf, spasi, titik, dan tanda kutip.',
            'family_card_number.size' => 'Nomor Kartu Keluarga harus terdiri dari 16 digit.',
            'family_card_number.regex' => 'Nomor Kartu Keluarga hanya boleh berisi angka.',
            'national_id_number.size' => 'NIK harus terdiri dari 16 digit.',
            'national_id_number.regex' => 'NIK hanya boleh berisi angka.',
            'birthplace.regex' => 'Tempat lahir hanya boleh berisi huruf, spasi, titik, koma, dan tanda hubung.',
            'birthdate.after' => 'Tanggal lahir tidak valid.',
            'sibling_name.regex' => 'Nama saudara hanya boleh berisi huruf, spasi, titik, dan tanda kutip.',
            'sibling_class.regex' => 'Kelas saudara hanya boleh berisi huruf, angka, spasi, dan tanda hubung.',
            'guardians.*.name.regex' => 'Nama wali hanya boleh berisi huruf, spasi, titik, dan tanda kutip.',
            'guardians.*.email.email' => 'Format email tidak valid.',
            'guardians.*.phone.regex' => 'Format nomor telepon tidak valid. Gunakan format Indonesia (contoh: 08123456789, +6281234567890).',
            'guardians.*.phone.min' => 'Nomor telepon minimal 10 digit.',
            'guardians.*.phone.max' => 'Nomor telepon maksimal 15 digit.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Step validation passed'
        ]);
    }

    /**
     * Get admission waves by level
     */
    public function getAdmissionWaves(string $level): JsonResponse
    {
        try {
            // Validate level parameter
            if (!in_array($level, ['kb', 'tk', 'sd'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid level parameter. Must be one of: kb, tk, sd'
                ], 400);
            }

            // Get active admission waves for the specified level
            $admissionWaves = AdmissionWave::where('level', $level)
                ->where('is_active', true)
                ->select('id', 'name', 'level', 'registration_fee', 'final_payment_fee', 'start_date', 'end_date')
                ->orderBy('start_date', 'asc')
                ->get()
                ->map(function ($wave) {
                    return [
                        'id' => $wave->id,
                        'name' => $wave->name,
                        'level' => $wave->level,
                        'registration_fee' => $wave->registration_fee,
                        'final_payment_fee' => $wave->final_payment_fee,
                        'start_date' => $wave->start_date,
                        'end_date' => $wave->end_date,
                        'formatted_start_date' => $wave->formatted_start_date,
                        'formatted_end_date' => $wave->formatted_end_date,
                        'is_open' => $wave->is_open,
                        'status_label' => $wave->status_label
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $admissionWaves,
                'message' => 'Admission waves retrieved successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching admission waves: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve admission waves'
            ], 500);
        }
    }
}