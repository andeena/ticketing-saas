<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        return [
            // Nama unik, aman untuk constraint UNIQUE
            'name' => $this->faker->unique()->company(),
        ];
    }

    /**
     * State: tenant default (jika memang diperlukan)
     * ❗ Jangan dipakai di test otomatis
     */
    public function default(): static
    {
        return $this->state(fn () => [
            'name' => 'Default Tenant',
        ]);
    }

    /**
     * State: tenant dengan slug (optional, future-proof)
     */
    public function withSlug(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $attributes['name'],
                // kalau nanti ada kolom slug
                // 'slug' => Str::slug($attributes['name']),
            ];
        });
    }
}
