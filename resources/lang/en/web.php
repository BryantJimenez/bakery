<?php

return [
    'menu' => [
        'menu' => 'Menu',
        'home' => 'Home',
        'sign in' => 'Sign In',
        'sign up' => 'Sign Up',
        'checkout' => 'Checkout',
        'languages' => 'Languages',
        'dashboard' => 'Dashboard',
        'profile' => 'My Profile',
        'logout' => 'Logout'
    ],

    'cart' => [
        'header' => [
            'empty' => 'Empty Order',
            'total' => 'Total',
            'button' => 'Checkout'
        ],
        'card' => [
            'title' => 'Order Summary',
            'empty' => 'Empty Order',
            'subtotal' => 'Subtotal',
            'delivery' => 'Delivery',
            'total' => 'Total',
            'buttons' => [
                'checkout' => 'Order Now',
                'mobile' => 'View Order'
            ]
        ]
    ],

    'shop' => [
        'categories' => 'Categories',
        'choose a type of' => 'Choose a type of :category',
        'you can choose' => 'You can choose:',
        'not available' => 'Not Available',
        'empty' => 'There are no products, try to change category',
        'modal' => [
            'choices' => [
                'choose' => 'Choose :max :attribute',
                'choose at least' => 'Choose at least :min :attribute (Maximum :max)',
                'choose maximum' => 'Choose max :max :attribute'
            ],
            'buttons' => [
                'undo' => 'Back',
                'cancel' => 'Cancel',
                'add cart' => 'Add to Cart',
                'continue' => 'Continue'
            ]
        ]
    ],

    'checkout' => [
        'title' => 'Checkout',
        'personal details' => 'Personal Details',
        'shipping' => [
            'title' => 'Method of Delivery',
            'label' => 'Where do we send it?'
        ],
        'payment' => 'Payment Method',
        'button' => 'Buy',
        'login' => [
            'title' => 'Log in to your account',
            'description' => 'To complete the order log in to your account',
            'button' => 'Sign In'
        ],
        'register' => [
            'title' => 'Creat your account',
            'description' => 'If you don\'t have an account yet',
            'button' => 'Sign Up'
        ]
    ],

    'profile' => [
        'title' => 'Profile',
        'orders' => [
            'title' => 'Orders',
            'table' => [
                'total' => 'Total',
                'state' => 'State',
                'date' => 'Date',
                'actions' => 'Actions',
                'show' => 'View Order',
                'empty' => 'It has not placed any orders'
            ]
        ],
        'settings' => [
            'title' => 'Settings',
            'information personal' => 'Personal Information'
        ]
    ],

    'order' => [
        'title' => 'Order Details',
        'info' => [
            'date' => 'Order date',
            'method' => 'Payment method',
            'total' => 'Order total',
            'state' => [
                'order' => 'Order state',
                'payment' => 'Payment state'
            ]
        ]
    ],

    'notifications' => [
        'success' => [
            'titles' => [
                'buy' => 'Successful Purchase'
            ],

            'messages' => [
                'buy' => 'The purchase has been completed successfully.'
            ]
        ],

        'error' => [
            'titles' => [
                'buy' => 'Failed Purchase',
                'cart' => 'Empty Cart'
            ],

            'messages' => [
                'cart' => 'The cart does not have any products.',
                'categories' => [
                    '404' => [
                        'title' => 'Category Not Found',
                        'msg' => 'An error occurred during the process, please try again.'
                    ]
                ],

                'products' => [
                    '404' => [
                        'title' => 'Product Not Found',
                        'msg' => 'An error occurred during the process, please try again.'
                    ]
                ],

                'complements' => [
                    '404' => [
                        'title' => 'Complement Not Available',
                        'msg' => 'An error occurred during the process, please try again.'
                    ]
                ]
            ]
        ]
    ]
];

?>