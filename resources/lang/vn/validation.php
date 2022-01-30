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

    'payment' => [
        'name' => [
            'required' => 'Họ tên không được để trống',
            'max' => 'Họ tên không được quá 45 ký tự',
            'min' =>  'Họ tên phải có ít nhất 6 ký tự'
        ],
        'email' => [
            'required' => 'Email không được để trống',
            'max' => 'Email không được quá 45 ký tự',
            'email' => 'Email phải có định dạng @gmail.com',
            'min' =>  'Email phải có ít nhất 6 ký tự'
        ],
        'phone' => [
            'required' => 'Số điện thoại không được để trống',
            'max' => 'Số điện thoại phải có 10 số',
            'min' => 'Số điện thoại phải có 10 số',
            'number' => 'Số điện thoại phải là dạng số và đủ 10 số',
        ],
        'district' => [
            'required' => 'Quận, Huyện không được để trống',
        ],
        'ward' => [
            'required' => 'Phường, Xã không được để trống',
        ],
        'city' => [
            'required' => 'Tỉnh, Thành phố không được để trống',
        ],
        'address' => [
            'required' => 'Địa chỉ không được để trống',
            'max' => 'Địa chỉ không được quá 255 ký tự',
        ],
        'content' => [
            'required' => 'Nội dung không được để trống'
        ]
    ],
   

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
