<?php

namespace Tests\Feature;

use App\Models\FuelEntry;
use App\Models\InsurancePayment;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class VehiclesTest
 * @package Tests\Feature
 */
class VehiclesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        factory(Vehicle::class, 2)->create([
            'name' => 'test vehicle',
        ]);
        factory(FuelEntry::class, 2)->create([
            'cost' => '4.5',
        ]);
        factory(FuelEntry::class, 3)->create([
            'cost' => '3',
        ]);
        factory(InsurancePayment::class, 2)->create([
            'amount' => '10',
        ]);
        factory(Service::class, 2)->create([
            'total' => '20',
        ]);
    }

    /** @test */
    public function it_should_return_list_of_vehicles_expenses_data()
    {
        $response = $this->get('api/vehicle/expenses');

        $response->assertStatus(200);

        $content = json_decode($response->getContent());

        $this->assertEquals(count($content->expenses), 9);

        $response->assertJsonStructure([
            'expenses' => [
                [
                    'id',
                    'vehicleName',
                    'plate_number',
                    'type',
                    'cost',
                    'createdAt',
                ]
            ],
        ]);
    }

    /** @test */
    public function it_should_filter_vehicles_expenses_data_with_given_filters()
    {
        $response = $this->get('api/vehicle/expenses?min_cost=4&expense_type=fuel');

        $content = json_decode($response->getContent());

        $this->assertEquals(count($content->expenses), 2);
    }
}
