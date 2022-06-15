<?php

namespace App\Http\Livewire;

use App\Models\People as PeopleModel;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class People extends Component
{
    public $rules = [
        'firstName' => ['required', 'string', 'min:3'],
        'lastName' => ['required', 'string', 'min:5'],
        'age' => ['required', 'numeric', 'min:18', 'max:100'],
    ];

    public $filter = '';
    public $firstName;
    public $lastName;
    public $age;

    public function create()
    {
        $this->validate();

        PeopleModel::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'age' => $this->age,
        ]);
    }

    public function update(PeopleModel $person, $index, $data)
    {
        $validator = Validator::make($data, [
            'first_name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:5'],
            'age' => ['required', 'numeric', 'min:18', 'max:100'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            foreach ($errors as $key => $error) {
                $this->addError("{$index}_{$key}", head($error));
            }
            return;
        }
        $person->update($data);
    }

    public function render()
    {
        return view('livewire.people')
            ->with([
                'people' => PeopleModel::query()
                    ->where('first_name', 'LIKE', '%' . $this->filter . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $this->filter . '%')
                    ->get(),
            ])
            ->extends('layouts.app')
            ->section('content');
    }
}
