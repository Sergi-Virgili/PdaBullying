<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Http\Resources\Type as TypeResource;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function create(string $model, array $atributes = [])
    {
        $type = factory("App\\$model")->create($atributes);

        return new TypeResource($type);
    }
}
