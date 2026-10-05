<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Assignment;
use App\Models\Category;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Department;
use App\Models\Extracurricular;
use App\Models\Grade;
use App\Models\Profile;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Submission;
use App\Models\Tag;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ///================================
        /////// 1. USER (Buat admin & user)
        ///================================
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        Profile::create([
            'user_id' => $admin->id,
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
            'birth_date' => '1985-05-15',
        ]);


        // == Buat 5 user Dosen
        $dosenUsers = [];
        $dosenNames = ['Prof. Dr. Moh. Farozin, M.Pd.', 'Prof. Dr. Muhammad Nur Wangid, M.Si.', 'Dr. Suwarjo, M.Si.', 'Prof. Dr. Budi Astuti, M.Si.', 'Prof. Dr. Edi Purwanta, M.Pd.'];
        foreach ($dosenNames as $i => $name) {
            $user = User::create([
                'name' =>$name,
                'email' => 'dosen' . ($i + 1) . '@siakad.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
            
            Profile::create([
                'user_id' => $user->id,
                'phone' => '0812345678' . ($i + 10),
                'address' => 'Jl. Dosen No. ' . ($i + 1),
                'birth_date' => '198' . $i . '-0' . ($i + 1) . '-10',
            ]);

            $dosenUsers[] = $user;
        }

        // === Buat 10 user mahasiswa
        $mhsUsers = [];
        $mhsNames = ['Imam Nurimbawan', 'Eka Aryani', 'Dewi Rahmawati', 'Khoerul Anwar', 'Syaban Ratri',
                        'Luky Kurniawan', 'Endah Rahmawati', 'Husen Raya', 'Ari Untung', 'Khusnul Khotimah'];
        foreach ($mhsNames as $i =>$name) {
            $user = User::create([
                'name' => $name,
                'email' => 'mahasiswa' . ($i + 1) . '@siakad.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);

            Profile::create([
                'user_id' => $user->id,
                'phone' => '0856789012' . ($i + 10),
                'address' => 'Jl. Mahasiswa No. ' . ($i + 1),
                'birth_date' => '200' . ($i % 5) . '-0' . (($i % 9) + 1) . '-' . (($i + 1) * 2),
            ]);
            $mhsUsers[] = $user;
        }


        ///===================
        //// 2. DEPARTMENTS
        ///===================

        $departments = [];
        $deptData = [
            ['name' => 'Teknik Informatika', 'code' => 'TI', 'description' => 'Jurusan Teknik Informatika'],
            ['name' => 'Psikologi', 'code' => 'PS', 'description' => 'Jurusan Psikologi'],
            ['name' => 'Hukum', 'code' => 'HK', 'description' => 'Jurusan Hukum'],
            ['name' => 'Seni', 'code' => 'SN', 'description' => 'Jurusan Seni'],
            ['name' => 'Kedokteran', 'code' => 'KD', 'description' => 'Jurusan Kedokteran'],
        ];
        foreach ($deptData as $d) {
            $departments[] = Department::create($d);
        }


        ///===============
        //// 3. TEACHERS
        ///===============

        $teachers = [];
        $specializations = ['Artificial Intelligence', 'Psikologi Konseling', 'Hukum Perdata', 'Seni Musik', 'Jantung Coroner'];
        foreach ($dosenUsers as $i => $user) {
            $teachers[] = Teacher::create([
                'user_id' => $user->id,
                'department_id' => $departments[$i]->id,
                'nip' => '19800' . ($i + 1) . '0101' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'specialization' => $specializations[$i],
            ]);
        }

        ///==============
        //// 4. STUDENTS
        ///==============

        $students = [];
        foreach ($mhsUsers as $i => $user) {
            $students[] = Student::create([
                'user_id' => $user->id,
                'department_id' => $departments[$i % 5]->id,
                'nim' => '2024' . str_pad($i + 1, 6, '0', STR_PAD_LEFT),
                'semester' => rand(1, 8),
            ]);
        }


        ///=================
        //// 5. CATEGORIES
        ///=================

        $categories = [];
        $catData = [
            ['name' => 'Pemrograman', 'description' => 'Mata kuliah terkait pemrograman'],
            ['name' => 'Konseling Individu', 'description' => 'Mata kuliah terkait konseling'],
            ['name' => 'Tipikor', 'description' => 'Mata kuliah terkait pidana kosrupsi'],
            ['name' => 'Alat Musik Petik', 'description' => 'Mata kuliah terkait pembelajaran alat musik yang dipetik'],
            ['name' => 'Jantung', 'description' => 'Mata kuliah terkait masalah jantung manusia'],
        ];
        foreach ($catData as $c) {
            $categories[] = Category::create($c);
        }


        ///==============
        //// 6. COURSES
        ///==============

        $courses = [];
        $coursesData = [
            ['category_id' => 1, 'department_id' => 1, 'code' => 'TI101', 'name' => 'Pemrograman Web', 'credits' => 3, 'description' => 'Dasar pemrograman web dengan HTML, CSS, JS'],
            ['category_id' => 1, 'department_id' => 1, 'code' => 'TI102', 'name' => 'Pemrograman Mobile', 'credits' => 3, 'description' => 'Pengembangan aplikasi mobile'],
            ['category_id' => 2, 'department_id' => 2, 'code' => 'KI201', 'name' => 'Cognitive Therapy', 'credits' => 3, 'description' => 'Konseling dengan pendekatan kognitif'],
            ['category_id' => 3, 'department_id' => 3, 'code' => 'HU101', 'name' => 'Korupsi APBN', 'credits' => 3, 'description' => 'Pelanggaran hukum korupsi APBN'],
            ['category_id' => 4, 'department_id' => 4, 'code' => 'SI101', 'name' => 'Gitar', 'credits' => 2, 'description' => 'Praktik Gitar'],
            ['category_id' => 1, 'department_id' => 1, 'code' => 'TI301', 'name' => 'Framework Laravel', 'credits' => 3, 'description' => 'Pengembangan web dengan Laravel'],
            ['category_id' => 4, 'department_id' => 4, 'code' => 'SN101', 'name' => 'Violin', 'credits' => 2, 'description' => 'Praktik Violin'],
            ['category_id' => 5, 'department_id' => 5, 'code' => 'KJ101', 'name' => 'Fungsi Jantung', 'credits' => 3, 'description' => 'Cara Kerja Jantung'],
            ['category_id' => 2, 'department_id' => 2, 'code' => 'KI202', 'name' => 'Reality Therapy', 'credits' => 3, 'description' => 'Konseling dengan pendekatan Reality Therapy'],
            ['category_id' => 3, 'department_id' => 3, 'code' => 'HU401', 'name' => 'Korupsi APBD', 'credits' => 3, 'description' => 'Pelanggaran hukum korupsi APBD'],
        ];
        foreach ($coursesData as $c) {
            $courses[] = Course::create($c);
        }


        ///=================
        //// 7. CLASSROOMS
        ///=================

        $classrooms = [];
        $roomData = [
            ['name' => 'Lab Komputer 1', 'building' => 'Gedung A', 'capacity' => 40],
            ['name' => 'Lab Komputer 2', 'building' => 'Gedung A', 'capacity' => 35],
            ['name' => 'Ruang 301', 'building' => 'Gedung B', 'capacity' => 50],
            ['name' => 'Ruang 302', 'building' => 'Gedung B', 'capacity' => 45],
            ['name' => 'Aula Utama', 'building' => 'Gedung C', 'capacity' => 200],
            ['name' => 'Lab Jaringan', 'building' => 'Gedung A', 'capacity' => 30],
        ];
        foreach ($roomData as $r) {
            $classrooms[] = Classroom::create($r);
        }


        ///================
        //// 8. SCHEDULES
        ///================

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        foreach ($courses as $i => $course) {
            Schedule::create([
                'course_id' => $course->id,
                'teacher_id' => $teachers[$i % 5]->id,
                'classroom_id' => $classrooms[$i % 6]->id,
                'day' => $days[$i % 5],
                'start_time' => sprintf('%02d:00', 7 + ($i % 5) * 2),
                'end_time' => sprintf('%02d:40', 8 + ($i % 5) * 2),
            ]);
        }


        ///====================================================
        //// 9. ENROLLMENTS (many to many: Students & Courses)
        ///====================================================

        foreach ($students as $i => $student) {
            // Setiap mahasiswa mengambil 3-4 mata kuliah
            $courseIds = collect($courses)->random(rand(3, 4))->pluck('id');
            foreach ($courseIds as $courseId) {
                $student->courses()->attach($courseId, [
                    'academic_year' => '2025/2026',
                    'semester' => $i % 2 == 0 ? 'Ganjil' : 'Genap',
                    'status' => 'active',
                ]);
            }
        }


        ///==================
        //// 10. ASSIGNMENTS
        ///==================

        $assignments = [];
        foreach ($courses as $course) {
            for ($j = 1; $j <=2; $j++) {
                $assignments[] = Assignment::create([
                    'course_id' => $course->id,
                    'title' => 'Tugas ' . $j . ' - ' . $course->name,
                    'description' => 'Deskripsi tugas ' . $j . ' untuk mata kuliah ' . $course->name,
                    'due_date' => now()->addDays(rand(7, 30)),
                ]);
            }
        }



        ///==================
        //// 11. SUBMISSIONS
        ///==================

        foreach ($assignments as $assignment) {
            $randomStudents = collect($students)->random(rand(3, 5));
            foreach ($randomStudents as $student) {
                Submission::create([
                    'assignment_id' => $assignment->id,
                    'student_id' => $student->id,
                    'file_path' => 'submissions/tugas_' . $student->nim . '_' . $assignment->id . '.pdf',
                    'notes' => 'Pengumpulan tugas oleh ' . $student->user->name,
                    'submitted_at' => now()->subDays(rand(1, 5)),
                    'score' => rand(60, 100),
                ]);
            }
        }



        ///=============
        //// 12. GRADES
        ///=============

        $gradeLetters = ['A', 'B+', 'B', 'B-', 'C', 'D', 'E'];
        foreach ($students as $student) {
            $endrolledCourses = $student->courses;
            foreach ($endrolledCourses as $course) {
                $midterm = rand(50, 100);
                $final = rand(50, 100);
                $avg = ($midterm + $final) / 2;

                if ($avg >=85) $letter = 'A';
                elseif ($avg >= 80) $letter = 'B+';
                elseif ($avg >= 70) $letter = 'B';
                elseif ($avg >= 65) $letter = 'B-';
                elseif ($avg >= 55) $letter = 'C';
                elseif ($avg >= 45) $letter = 'D';
                else $letter = 'E';

                Grade::create([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'academic_year' => '2025/2026',
                    'midterm_score' => $midterm,
                    'final_score' => $final,
                    'grade_letter' => $letter,
                ]);
            }
        }


        ///====================
        //// 13. ANNOUNCEMENTS
        ///====================

        $announcementData = [
            ['title' => 'Jadwal UTS Semester Ganjil 2025/2026', 'content' => 'Ujian Tengah Semester akan dilaksanakan pada tanggal 15-22 Oktober 2025.', 'is_published' => true],
            ['title' => 'Pendaftaran Semester Baru', 'content' => 'Pendaftaran mata kuliah semester baru dibuka mulai 1 September 2025.', 'is_published' => true],
            ['title' => 'Libur Nasional', 'content' => 'Perkuliahan diliburkan pada tanggal 17 Agustus 2025.', 'is_published' => true],
            ['title' => 'Workshop Laravel', 'content' => 'Workshop Laravel akan diadakan pada tanggal 25 September 2025 di Lab Komputer 1.', 'is_published' => false],
            ['title' => 'Wisuda Periode Oktober', 'content' => 'Wisuda periode Oktober 2025 akan dilaksanakan pada tanggal 30 Oktober 2025.', 'is_published' => true],
        ];
        foreach ($announcementData as $a) {
            Announcement::create(array_merge($a, ['user_id' => $admin->id]));
        }


        ///===========
        //// 14. TAGS
        ///===========

        $tags = [];
        $tagData = [
            ['name' => 'Backend', 'slug' => 'backend'],
            ['name' => 'Frontend', 'slug' => 'frontend'],
            ['name' => 'Database', 'slug' => 'database'],
            ['name' => 'AI/ML', 'slug' => 'ai-ml'],
            ['name' => 'Wajib', 'slug' => 'wajib'],
            ['name' => 'Pilihan', 'slug' => 'pilihan'],
            ['name' => 'Praktikum', 'slug' => 'praktikum'],
        ];
        foreach ($tagData as $t) {
            $tags[] = Tag::create($t);
        }


        ///===============================================
        //// 15. COURSE_TAG (many to many: Course & Tags)
        ///===============================================

        foreach ($courses as $course) {
            $tagId = collect($tags)->random(rand(2, 4))->pluck('id');
            $course->tags()->attach($tagId);
        }


        ///=======================
        //// 16. EXTRACURRICULARS
        ///=======================

        $extras = [];
        $extraData = [
            ['name' => 'Klub Pemrograman', 'description' => 'Klub untuk belajar dan berlatih pemrograman', 'max_members' => 50],
            ['name' => 'Basket', 'description' => 'Tim basket universitas', 'max_members' => 20],
            ['name' => 'Paduan Suara', 'description' => 'Kelompok paduan suara universitas', 'max_members' => 40],
            ['name' => 'Robotika', 'description' => 'Klub robotika dan IoT', 'max_members' => 30],
            ['name' => 'English Club', 'description' => 'Klub bahasa Inggris', 'max_members' => 60],
        ];
        foreach ($extraData as $e) {
            $extras[] = Extracurricular::create($e);
        }


        ///=========================================================================
        //// 17. EXTRACURRICULAR_STUDENT (many to many: Student & Extracurriculars)
        ///=========================================================================

        $roles = ['member', 'leader', 'secretary'];
        foreach ($students as $i => $student) {
            $extraIds = collect($extras)->random(rand(1, 3))->pluck('id');
            foreach ($extraIds as $j => $extraId) {
                $student->extracurriculars()->attach($extraId, [
                    'joined_at' => now()->subMonths(rand(1, 12))->format('Y-m-d'),
                    'role' => $j === 0 && $i < 5 ? $roles[$i % 3] : 'member',
                ]);
            }
        }

    }
}
