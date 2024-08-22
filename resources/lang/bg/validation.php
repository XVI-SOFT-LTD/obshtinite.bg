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

    "accepted" => "Трябва да приемете :attribute.",
    "active_url" => "Полето :attribute не е валиден URL адрес.",
    "after" => "Полето :attribute трябва да бъде дата след :date.",
    "alpha" => "Полето :attribute трябва да съдържа само букви.",
    "alpha_dash" => "Полето :attribute трябва да съдържа само букви, цифри, долна черта и тире.",
    "alpha_num" => "Полето :attribute трябва да съдържа само букви и цифри.",
    "array" => "Полето :attribute трябва да бъде масив.",
    "before" => "Полето :attribute трябва да бъде дата преди :date.",
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    "between" => [
        "numeric" => "Полето :attribute трябва да бъде между :min и :max.",
        "file" => "Полето :attribute трябва да бъде между :min и :max килобайта.",
        "string" => "Полето :attribute трябва да бъде между :min и :max знака.",
        "array" => "Полето :attribute трябва да има между :min - :max елемента.",
    ],

    "boolean" => "Полето :attribute трябва да съдържа Да или Не",
    "confirmed" => "Полето :attribute не е потвърдено.",
    "date" => "Полето :attribute не е валидна дата.",
    "date_format" => "Полето :attribute не е във формат :format.",
    "different" => "Полетата :attribute и :other трябва да са различни.",
    "digits" => "Полето :attribute трябва да има :digits цифри.",
    "digits_between" => "Полето :attribute трябва да има между :min и :max цифри.",
    "email" => "Полето :attribute е в невалиден формат.",
    "exists" => "Избранато поле :attribute вече съществува.",
    "filled" => "Полето :attribute е задължително.",
    "image" => "Полето :attribute трябва да бъде изображение.",
    "in" => "Избраното поле :attribute е невалидно.",
    "in_array" => "Полето :attribute липсва в :other.",
    "integer" => "Полето :attribute трябва да бъде цяло число.",
    "ip" => "Полето :attribute трябва да бъде валиден IP адрес.",
    "ipv4" => "Полето :attribute трябва да бъде валиден IPv4 адрес.",
    "ipv6" => "Полето :attribute трябва да бъде валиден IPv6 адрес.",
    "json" => "Полето :attribute трябва да бъде JSON низ.",
    'current_password' => 'The password is incorrect.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'file' => 'The :attribute must be a file.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => ':attribute трябва да бъде снимка.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    "max" => [
        "numeric" => "Полето :attribute трябва да бъде по-малко от :max.",
        "file" => "Полето :attribute трябва да бъде по-малко от :max килобайта.",
        "string" => "Полето :attribute трябва да бъде по-малко от :max знака.",
        "array" => "Полето :attribute трябва да има по-малко от :max елемента.",
    ],
    "mimes" => "Полето :attribute трябва да бъде файл от тип: :values.",
    "min" => [
        "numeric" => "Полето :attribute трябва да бъде минимум :min.",
        "file" => "Полето :attribute трябва да бъде минимум :min килобайта.",
        "string" => "Полето :attribute трябва да бъде минимум :min знака.",
        "array" => "Полето :attribute трябва има минимум :min елемента.",
    ],
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_regex' => 'The :attribute format is invalid.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    "not_in" => "Избраното поле :attribute е невалидно.",
    "numeric" => "Полето :attribute трябва да бъде число.",
    "regex" => "Полето :attribute е в невалиден формат.",
    "required" => "Полето :attribute е задължително.",
    "required_if" => "Полето :attribute се изисква, когато :other е :value.",
    "required_unless" => "Полето :attribute се изисква, освен ако :other не е :values.",
    "required_with" => "Полето :attribute се изисква, когато :values има стойност.",
    "required_with_all" => "Полето :attribute е задължително, когато :values имат стойност.",
    "required_without" => "Полето :attribute се изисква, когато :values няма стойност.",
    "required_without_all" => "Полето :attribute се изисква, когато никое от полетата :values няма стойност.",
    "same" => "Полетата :attribute и :other трябва да съвпадат.",
    "size" => [
        "numeric" => "Полето :attribute трябва да бъде :size.",
        "file" => "Полето :attribute трябва да бъде :size килобайта.",
        "string" => "Полето :attribute трябва да бъде :size знака.",
        "array" => "Полето :attribute трябва да има :size елемента.",
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'uploaded' => 'The :attribute failed to upload.',
    'uuid' => 'The :attribute must be a valid UUID.',
    "string" => "Полето :attribute трябва да бъде знаков низ.",
    "timezone" => "Полето :attribute трябва да съдържа валидна часова зона.",
    "unique" => "Полето :attribute вече съществува.",
    "url" => "Полето :attribute е в невалиден формат.",

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

    "attributes" => [
        "username" => "Потребителско име",
        'fullname' => 'Пълно име',
        "password" => "Парола",
        "email" => "E-mail",
        "phone" => "Телефон",
        "mobile" => "GSM",
        "age" => "Възраст",
        "sex" => "Пол",
        "gender" => "Пол",
        "day" => "Ден",
        "month" => "Месец",
        "year" => "Година",
        "hour" => "Час",
        "minute" => "Минута",
        "second" => "Секунда",
        "title" => "Заглавие",
        "content" => "Съдържание",
        "description" => "Описание",
        "excerpt" => "Откъс",
        "date" => "Дата",
        "time" => "Време",
        "available" => "Достъпен",
        "size" => "Размер",
        "recaptcha_response_field" => "Рекапча",
        "subject" => "Заглавие",
        "message" => "Съобщение",
        'formMode' => 'формата',
        'create' => 'създаване',
        'logo' => 'Лого',
        'terms' => 'Общи условия за ползване',

        // custom attributes - bg
        "i18n.1.name" => "Име [bg]",
        "i18n.1.description" => "Описание [bg]",
        "i18n.1.first_name" => "Име [bg]",
        "i18n.1.last_name" => "Фамилия [bg]",
        "i18n.1.city" => "Град [bg]",
        "i18n.1.country" => "Държава [bg]",
        "i18n.1.address" => "Адрес [bg]",

        // custom attributes - en
        "i18n.2.name" => "Име [en]",
        "i18n.2.description" => "Описание [en]",
        "i18n.2.first_name" => "Име [en]",
        "i18n.2.last_name" => "Фамилия [en]",
        "i18n.2.city" => "Град [en]",
        "i18n.2.country" => "Държава [en]",
        "i18n.2.address" => "Адрес [en]",
    ],

];
