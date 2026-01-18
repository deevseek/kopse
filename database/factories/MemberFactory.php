<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition(): array
    {
        $memberType = $this->faker->randomElement(['SISWA', 'GURU', 'KARYAWAN']);
        $status = $this->faker->randomElement(['AKTIF', 'AKTIF', 'AKTIF', 'LULUS', 'KELUAR']);

        return [
            'name' => $this->faker->name(),
            'member_type' => $memberType,
            'class_name' => $memberType === 'SISWA'
                ? $this->faker->randomElement(['VII A', 'VII B', 'VIII A', 'VIII B', 'IX A', 'IX B'])
                : null,
            'gender' => $this->faker->randomElement(['L', 'P']),
            'phone' => $this->faker->optional()->phoneNumber(),
            'address' => $this->faker->optional()->address(),
            'join_date' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'status' => $status,
        ];
    }
}
