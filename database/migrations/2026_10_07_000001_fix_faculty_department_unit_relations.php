<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix departments.faculty_id - make it nullable but with proper foreign key
        Schema::table('departments', function (Blueprint $table) {
            $table->foreign('faculty_id')->references('id')->on('faculties')->nullOnDelete();
        });

        // Fix units.department_id - make it nullable but with proper foreign key
        Schema::table('units', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')->nullOnDelete();
        });

        // Create default faculty if not exists
        $defaultFaculty = DB::table('faculties')->where('name', 'Fakultas Umum')->first();
        if (!$defaultFaculty) {
            $defaultFacultyId = DB::table('faculties')->insertGetId([
                'name' => 'Fakultas Umum',
                'code' => 'FU',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $defaultFacultyId = $defaultFaculty->id;
        }

        // Update departments with NULL faculty_id to default faculty
        DB::table('departments')->whereNull('faculty_id')->update(['faculty_id' => $defaultFacultyId]);

        // Create default department if not exists
        $defaultDepartment = DB::table('departments')->where('name', 'Jurusan Umum')->first();
        if (!$defaultDepartment) {
            $defaultDepartmentId = DB::table('departments')->insertGetId([
                'faculty_id' => $defaultFacultyId,
                'name' => 'Jurusan Umum',
                'code' => 'JU',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $defaultDepartmentId = $defaultDepartment->id;
        }

        // Update units with NULL department_id to default department
        DB::table('units')->whereNull('department_id')->update(['department_id' => $defaultDepartmentId]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration cannot be reversed as it modifies existing data
    }
};
