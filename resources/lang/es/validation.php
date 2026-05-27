<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'unique' => 'El campo :attribute ya ha sido registrado.',
    'confirmed' => 'La contraseñas deben ser iguales.',
    'min' => [
        'string' => 'El campo :attribute debe contener al menos :min caracteres.',
    ],

    // Aquí abajo podés personalizar cómo se lee cada campo en tus formularios
    'attributes' => [
        'password' => 'contraseña',
        'email' => 'correo electrónico',
        'name' => 'nombre',
    ],
];