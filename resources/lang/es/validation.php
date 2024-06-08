<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser una cadena de caracteres.',
    'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
    'max' => [
        'string' => 'El campo :attribute no debe tener más de :max caracteres.',
    ],
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'confirmed' => 'La confirmación del campo :attribute no coincide.',
    'unique' => 'El valor del campo :attribute ya está en uso.',
    'attributes' => [
        'name' => 'Nombre del Cliente',
        'email' => 'Correo electrónico',
        'password' => 'Contraseña',
        'password_confirmation' => 'Confirmar contraseña',
        'codigo' => 'Código de Cliente',
    ],
];
