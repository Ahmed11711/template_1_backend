<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedShippingMethods();
        $this->seedGovernoratesWithBranches();
    }

    /**
     * طرق الشحن الأساسية.
     * الأدمن بيفعّل واحدة منهم بس عادة (is_active) حسب سياسة المتجر.
     */
    private function seedShippingMethods(): void
    {
        DB::table('shipping_methods')->insert([
            [
                'name'              => 'شحن مجاني',
                'type'              => 'free',
                'flat_rate'         => null,
                'percentage_value'  => null,
                'is_active'         => false,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'مبلغ ثابت لكل الطلبات',
                'type'              => 'flat',
                'flat_rate'         => 50.00,
                'percentage_value'  => null,
                'is_active'         => false,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'نسبة من إجمالي المشتريات',
                'type'              => 'percentage',
                'flat_rate'         => null,
                'percentage_value'  => 5.00,
                'is_active'         => false,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'حسب المحافظة',
                'type'              => 'governorate',
                'flat_rate'         => null,
                'percentage_value'  => null,
                'is_active'         => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }

    /**
     * المحافظات المصرية + فروع/مناطق تفصيلية لبعضها (اختياري تزودها براحتك).
     */
    private function seedGovernoratesWithBranches(): void
    {
        $governorates = [
            [
                'name'  => 'القاهرة',
                'price' => 50.00,
                'branches' => [
                    ['name' => 'الدقي',        'price' => 55.00],
                    ['name' => 'المهندسين',     'price' => 55.00],
                    ['name' => 'مدينة نصر',      'price' => 60.00],
                    ['name' => 'مصر الجديدة',    'price' => 60.00],
                    ['name' => 'المعادي',       'price' => 60.00],
                    ['name' => 'التجمع الخامس',  'price' => 70.00],
                    ['name' => 'الشروق',        'price' => 70.00],
                    ['name' => 'وسط البلد',      'price' => 50.00],
                ],
            ],
            [
                'name'  => 'الجيزة',
                'price' => 50.00,
                'branches' => [
                    ['name' => '6 أكتوبر',       'price' => 60.00],
                    ['name' => 'الشيخ زايد',     'price' => 65.00],
                    ['name' => 'فيصل',          'price' => 55.00],
                    ['name' => 'الهرم',         'price' => 55.00],
                    ['name' => 'العجوزة',       'price' => 55.00],
                ],
            ],
            [
                'name'  => 'الإسكندرية',
                'price' => 60.00,
                'branches' => [
                    ['name' => 'سموحة',         'price' => 65.00],
                    ['name' => 'محرم بك',       'price' => 60.00],
                    ['name' => 'العصافرة',      'price' => 65.00],
                    ['name' => 'برج العرب',      'price' => 75.00],
                ],
            ],
            [
                'name'  => 'الدقهلية',
                'price' => 65.00,
                'branches' => [
                    ['name' => 'المنصورة',      'price' => 65.00],
                    ['name' => 'طلخا',         'price' => 70.00],
                ],
            ],
            [
                'name'  => 'البحيرة',
                'price' => 70.00,
                'branches' => [],
            ],
            [
                'name'  => 'الفيوم',
                'price' => 70.00,
                'branches' => [],
            ],
            [
                'name'  => 'الغربية',
                'price' => 65.00,
                'branches' => [
                    ['name' => 'طنطا',         'price' => 65.00],
                    ['name' => 'المحلة الكبرى',  'price' => 65.00],
                ],
            ],
            [
                'name'  => 'الإسماعيلية',
                'price' => 70.00,
                'branches' => [],
            ],
            [
                'name'  => 'المنوفية',
                'price' => 65.00,
                'branches' => [],
            ],
            [
                'name'  => 'المنيا',
                'price' => 80.00,
                'branches' => [],
            ],
            [
                'name'  => 'القليوبية',
                'price' => 55.00,
                'branches' => [
                    ['name' => 'بنها',         'price' => 55.00],
                    ['name' => 'شبرا الخيمة',    'price' => 55.00],
                ],
            ],
            [
                'name'  => 'الوادي الجديد',
                'price' => 100.00,
                'branches' => [],
            ],
            [
                'name'  => 'السويس',
                'price' => 70.00,
                'branches' => [],
            ],
            [
                'name'  => 'اسوان',
                'price' => 100.00,
                'branches' => [],
            ],
            [
                'name'  => 'اسيوط',
                'price' => 85.00,
                'branches' => [],
            ],
            [
                'name'  => 'بني سويف',
                'price' => 75.00,
                'branches' => [],
            ],
            [
                'name'  => 'بورسعيد',
                'price' => 70.00,
                'branches' => [],
            ],
            [
                'name'  => 'دمياط',
                'price' => 70.00,
                'branches' => [],
            ],
            [
                'name'  => 'الشرقية',
                'price' => 65.00,
                'branches' => [
                    ['name' => 'الزقازيق',      'price' => 65.00],
                    ['name' => 'العاشر من رمضان', 'price' => 70.00],
                ],
            ],
            [
                'name'  => 'جنوب سيناء',
                'price' => 100.00,
                'branches' => [],
            ],
            [
                'name'  => 'كفر الشيخ',
                'price' => 70.00,
                'branches' => [],
            ],
            [
                'name'  => 'مطروح',
                'price' => 100.00,
                'branches' => [],
            ],
            [
                'name'  => 'الأقصر',
                'price' => 90.00,
                'branches' => [],
            ],
            [
                'name'  => 'قنا',
                'price' => 90.00,
                'branches' => [],
            ],
            [
                'name'  => 'شمال سيناء',
                'price' => 100.00,
                'branches' => [],
            ],
            [
                'name'  => 'سوهاج',
                'price' => 90.00,
                'branches' => [],
            ],
            [
                'name'  => 'البحر الأحمر',
                'price' => 100.00,
                'branches' => [],
            ],
        ];

        foreach ($governorates as $gov) {
            $governorateId = DB::table('shipping_governorates')->insertGetId([
                'name'       => $gov['name'],
                'price'      => $gov['price'],
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!empty($gov['branches'])) {
                $branchRows = array_map(function ($branch) use ($governorateId) {
                    return [
                        'shipping_governorate_id' => $governorateId,
                        'name'                    => $branch['name'],
                        'price'                   => $branch['price'],
                        'is_active'               => true,
                        'created_at'              => now(),
                        'updated_at'              => now(),
                    ];
                }, $gov['branches']);

                DB::table('shipping_governorate_branches')->insert($branchRows);
            }
        }
    }
}
