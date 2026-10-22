<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
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

        $roleId = DB::table('m_role')->insertGetId([
            'nmrol' => 'Superadmin',
            'crtdt' => now(),
            'upddt' => now(),
        ], 'idrol');

        $userId = User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('superadmin@mail.com'),
        ])->id;

        DB::table('m_urole')->insert([
            'idusr' => $userId,
            'idrol' => $roleId,
        ]);

        DB::table('m_param')->insert([
            ['pidprm' => 'GRP_MNU', 'valprm' => 'DAS', 'valprm1' => 'Monitor', 'dscprm' => 'Dashboard', 'seqprm' => 1, 'crtdt' => now(), 'upddt' => now()],
            ['pidprm' => 'GRP_MNU', 'valprm' => 'MST', 'valprm1' => 'Layers', 'dscprm' => 'Master Data', 'seqprm' => 2, 'crtdt' => now(), 'upddt' => now()],
            ['pidprm' => 'GRP_MNU', 'valprm' => 'TRN', 'valprm1' => 'ArrowRightLeft', 'dscprm' => 'Transaction', 'seqprm' => 3, 'crtdt' => now(), 'upddt' => now()],
            ['pidprm' => 'GRP_MNU', 'valprm' => 'REP', 'valprm1' => 'Files', 'dscprm' => 'Report', 'seqprm' => 4, 'crtdt' => now(), 'upddt' => now()],
            ['pidprm' => 'GRP_MNU', 'valprm' => 'SET', 'valprm1' => 'Settings', 'dscprm' => 'Settings', 'seqprm' => 5, 'crtdt' => now(), 'upddt' => now()],
        ]);

        DB::table('m_menu')->insert([
            ['grpmnu' => 'DAS', 'nmmnu' => 'Dashboard Utama', 'urlmnu' => '/das_dashboard_utama', 'ordmnu' => 901, 'crtdt' => now()],
            ['grpmnu' => 'SET', 'nmmnu' => 'Menu', 'urlmnu' => '/set_menu', 'ordmnu' => 401, 'crtdt' => now()],
            ['grpmnu' => 'SET', 'nmmnu' => 'Role', 'urlmnu' => '/set_role', 'ordmnu' => 402, 'crtdt' => now()],
            ['grpmnu' => 'SET', 'nmmnu' => 'User', 'urlmnu' => '/set_user', 'ordmnu' => 403, 'crtdt' => now()],

        ]);

        DB::table('m_rmenu')->insert([
            ['idrol' => 1, 'idmnu' => 1, 'viwrmn' => false],
            ['idrol' => 1, 'idmnu' => 2, 'viwrmn' => false],
            ['idrol' => 1, 'idmnu' => 3, 'viwrmn' => false],
            ['idrol' => 1, 'idmnu' => 4, 'viwrmn' => false],
        ]);

    }
}
