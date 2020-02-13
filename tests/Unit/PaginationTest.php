<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Refuge;

class PaginationTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @test
     */
    public function refuge_length_method_returns_int()
    {
        $refuges = factory(Refuge::class, 3)->make();
        $refugesList = Refuge::paginate(5);
        $length = Refuge::length($refuges, $refugesList->perPage());
        $this->assertIsInt($length);
    }
}
