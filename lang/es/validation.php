<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El atributo :attribute debe ser aceptado.',
    'accepted_if' => 'El atributo :attribute debe ser aceptado cuando :other es :value.',
    'active_url' => 'El atributo :attribute no contiene una URL valida.',
    'after' => 'El atributo :attribute debe ser una fecha luego de :date.',
    'after_or_equal' => 'El atributo :attribute debe ser una fecha luego o igual a :date.',
    'alpha' => 'El atributo :attribute solo puede contener letras.',
    'alpha_dash' => 'El atributo :attribute solo puede contener letras, números, puntuaciones y underscores.',
    'alpha_num' => 'El atributo :attribute solo puede contener letras y números.',
    'array' => 'El atributo :attribute debe ser un arreglo.',
    'before' => 'El atributo :attribute debe ser una fecha antes de :date.',
    'before_or_equal' => 'El atributo :attribute debe ser una fecha antes o igual a :date.',
    'between' => [
        'array' => 'El atributo :attribute debe contener objetos entre :min y :max .',
        'file' => 'El atributo :attribute debe estar entre :min y :max kilobytes.',
        'numeric' => 'El atributo :attribute debe estar entre :min y :max.',
        'string' => 'El atributo :attribute debe estar entre :min y :max caracteres.',
    ],
    'boolean' => 'El atributo :attribute debe ser verdadero o falso.',
    'confirmed' => 'El atributo :attribute no esta confirmado.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El atributo :attribute no es una fecha valida.',
    'date_equals' => 'El atributo :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El atributo :attribute no cumple el formato :format.',
    'declined' => 'El atributo :attribute debe ser declinado.',
    'declined_if' => 'El atributo :attribute debe ser declinado cuando :other es :value.',
    'different' => 'El atributo :attribute y :other deben ser diferentes.',
    'digits' => 'El atributo :attribute debe tener :digits dígitos.',
    'digits_between' => 'El atributo :attribute debe contener entre :min y :max dígitos.',
    'dimensions' => 'El atributo :attribute tiene una dimension invalida.',
    'distinct' => 'El atributo :attribute contiene valores duplicados.',
    'doesnt_start_with' => 'El atributo :attribute no debe iniciar con: :values.',
    'email' => 'El atributo :attribute no es un correo valido.',
    'ends_with' => 'El atributo :attribute debe terminar con: :values.',
    'enum' => 'El atributo seleccionado :attribute es invalido.',
    'exists' => 'El atributo seleccionado :attribute es invalido.',
    'file' => 'El atributo :attribute debe ser un archivo.',
    'filled' => 'El atributo :attribute debe contener un valor.',
    'gt' => [
        'array' => 'El atributo :attribute debe contener al menos :value objetos.',
        'file' => 'El atributo :attribute debe ser mayor que :value kilobytes.',
        'numeric' => 'El atributo :attribute debe ser mayor que :value.',
        'string' => 'El atributo :attribute debe ser mayor que :value characters.',
    ],
    'gte' => [
        'array' => 'El atributo :attribute debe contener :value objetos o mas.',
        'file' => 'El atributo :attribute debe ser mayor o igual a :value kilobytes.',
        'numeric' => 'El atributo :attribute debe ser mayor o igual a :value.',
        'string' => 'El atributo :attribute debe ser mayor o igual a :value characters.',
    ],
    'image' => 'El atributo :attribute debe ser una imagen.',
    'in' => 'El atributo seleccionado :attribute es invalido.',
    'in_array' => 'El atributo :attribute no existe en :other.',
    'integer' => 'El atributo :attribute debe ser un numero.',
    'ip' => 'El atributo :attribute debe ser una dirección IP.',
    'ipv4' => 'El atributo :attribute debe ser una dirección IPv4.',
    'ipv6' => 'El atributo :attribute debe ser una dirección IPv6.',
    'json' => 'El atributo :attribute debe ser un JSON.',
    'lt' => [
        'array' => 'El atributo :attribute debe tener al menos :value objetos.',
        'file' => 'El atributo :attribute debe contener menos que :value kilobytes.',
        'numeric' => 'El atributo :attribute debe contener menos que :value.',
        'string' => 'El atributo :attribute debe contener menos que :value caracteres.',
    ],
    'lte' => [
        'array' => 'El atributo :attribute no debe tener mas de :value objetos.',
        'file' => 'El atributo :attribute debe contener al menos :value kilobytes.',
        'numeric' => 'El atributo :attribute debe contener al menos :value.',
        'string' => 'El atributo :attribute debe contener al menos :value caracteres.',
    ],
    'mac_address' => 'El atributo :attribute debe contener una MAC address.',
    'max' => [
        'array' => 'El atributo :attribute no puede contener mas que :max objetos.',
        'file' => 'El atributo :attribute no puede contener mas de :max kilobytes.',
        'numeric' => 'El atributo :attribute no puede contener mas de :max.',
        'string' => 'El atributo :attribute no puede contener mas de :max caracteres.',
    ],
    'mimes' => 'El atributo :attribute debe ser un archivo del tipo: :values.',
    'mimetypes' => 'El atributo :attribute debe ser un archivo del tipo: :values.',
    'min' => [
        'array' => 'El atributo :attribute debe tener al menos :min objetos.',
        'file' => 'El atributo :attribute debe contener al menos :min kilobytes.',
        'numeric' => 'El atributo :attribute debe contener al menos :min.',
        'string' => 'El atributo :attribute debe contener al menos :min caracteres.',
    ],
    'multiple_of' => 'El atributo :attribute debe ser múltiplo de :value.',
    'not_in' => 'El atributo seleccionado :attribute es invalido.',
    'not_regex' => 'El formato del atributo :attribute es invalido.',
    'numeric' => 'El atributo :attribute debe ser un numero.',
    'password' => [
        'letters' => 'El atributo :attribute debe contener al menos un carácter.',
        'mixed' => 'El atributo :attribute debe contener al menos una mayúscula y una minúscula.',
        'numbers' => 'El atributo :attribute debe contener al menos un numero.',
        'symbols' => 'El atributo :attribute debe contener al menos un símbolo.',
        'uncompromised' => 'El atributo :attribute parece ser comprometido, por favor elija otra :attribute.',
    ],
    'present' => 'El atributo :attribute debe estar presente.',
    'prohibited' => 'El atributo :attribute esta prohibido.',
    'prohibited_if' => 'El atributo :attribute esta prohibido cuando :other es :value.',
    'prohibited_unless' => 'El atributo :attribute esta prohibido hasta que :other es :values.',
    'prohibits' => 'El atributo :attribute prohíbe que :other este presente.',
    'regex' => 'El atributo :attribute formato invalido.',
    'required' => 'El atributo :attribute es requerido.',
    'required_array_keys' => 'El atributo :attribute debe contener registros para: :values.',
    'required_if' => 'El atributo :attribute es requerido cuando :other es :value.',
    'required_unless' => 'El atributo :attribute es requerido mientras que :other sea :values.',
    'required_with' => 'El atributo :attribute es requerido cuando :values esta presente.',
    'required_with_all' => 'El atributo :attribute es requerido cuando :values esta presente.',
    'required_without' => 'El atributo :attribute es requerido cuando :values no esta presente.',
    'required_without_all' => 'El atributo :attribute es requerido cuando ningún :values esta presente.',
    'same' => 'El atributo :attribute y :other deben ser iguales.',
    'size' => [
        'array' => 'El atributo :attribute debe estar en :size objetos.',
        'file' => 'El atributo :attribute debe ser de :size kilobytes.',
        'numeric' => 'El atributo :attribute debe ser de :size.',
        'string' => 'El atributo :attribute debe ser de :size caracteres.',
    ],
    'starts_with' => 'El atributo :attribute debe iniciar con uno de los siguientes: :values.',
    'string' => 'El atributo :attribute debe ser un texto',
    'timezone' => 'El atributo :attribute debe contener una zona horaria.',
    'unique' => 'El atributo :attribute ya ha sido usado.',
    'uploaded' => 'El atributo :attribute fallo al cargarse.',
    'url' => 'El atributo :attribute debe ser una URL. valida',
    'uuid' => 'El atributo :attribute debe ser un UUID. valida',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
