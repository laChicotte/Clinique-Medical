<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    // Définissez le modèle associé à cette factory
    protected $model = \App\Models\Employee::class;

    /**
     * Définissez l'état par défaut du modèle.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'doc_fname' => $this->faker->firstName,
            'doc_lname' => $this->faker->lastName,
            'doc_email' => $this->faker->unique()->safeEmail,
            'doc_number' => $this->faker->numerify('A####'),
            'doc_dpic' => $this->faker->optional()->imageUrl(),
            'doc_dept' => $this->faker->optional()->word,
        ];
    }
}
