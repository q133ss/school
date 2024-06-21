<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['Ученик' => 'student', 'Преподаватель' => 'teacher','Админ' => 'admin'];
        foreach ($roles as $name => $slug){
            Role::create(['name' => $name, 'slug' => $slug]);
        }

        $teacher = User::create([
            'name'     => 'Учитель',
            'phone'    => '+7(111)111-11-11',
            'password' => Hash::make('password'),
            'role_id'  => Role::where('slug', 'teacher')->pluck('id')->first()
        ]);

        $student = User::create([
            'name'     => 'Ученик',
            'phone'    => '+7(222)222-22-22',
            'password' => Hash::make('password'),
            'role_id'  => Role::where('slug', 'student')->pluck('id')->first()
        ]);

        DB::table('student_teacher')
            ->insert([
                'student_id' => $student->id,
                'teacher_id' => $teacher->id
            ]);

        DB::table('student_comments')
            ->insert([
                'student_id' => $student->id,
                'teacher_id' => $teacher->id,
                'comment'    => 'Хороший ученик!'
            ]);

        $lessons = [
          [
              'date'        => now()->addDay()->format('Y-m-d'),
              'time'        => "10:00",
              'price'       => 999,
              'duration'    => "01:30",
              'description' => 'Будем изучать времена в английском языке',
              'student_id'  => $student->id,
              'teacher_id'  => $teacher->id
          ],
            [
                'date'        => now()->addDay()->format('Y-m-d'),
                'time'        => "12:00",
                'price'       => 1200,
                'duration'    => "0:45",
                'description' => 'Разговорный французский',
                'student_id'  => $student->id,
                'teacher_id'  => $teacher->id
            ]
        ];
        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
}
