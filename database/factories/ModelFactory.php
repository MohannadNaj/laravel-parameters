<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Parameter\Parameter::class, function (Faker\Generator $faker) {
    $type = collect(Parameter\ParametersManager::$supportedTypes)->except(param()->count() > 2? null : 2)->random();
    $name= substr($faker->slug, 0, 10);

    if($type == 'boolean')
    {
    	$value = $faker->boolean;
    } else if($type == 'integer')
    {
    	$value = $faker->randomNumber(3);
    } else if($type == 'file')
    {
    	$value = $faker->image(public_path('vendor/parameters/images'));
    } else if($type == 'textfield')
    {
    	$value = implode(',', $faker->words(3));
    } else if($type == 'text')
    {
    	$value = implode(',', $faker->paragraphs(3));
    } else if($type == 'group')
    {
    	$column1 = $faker->word;
    	$column2 = $faker->word;

    	$param1 = param()->random();
    	$param2 = param()->where('id','!=',$param1->id)->random();

    	$value = [$column1 => $param1->type, $column2 => $param2->type,
    				'rows'=>[$param1->id, $param2->id,] ];
    }

    $res = [
        'name' => $name,
        'type' => $type,
        'value' => $value,
        'label' => $name . '_lang',
    ];
    return $res;
});
