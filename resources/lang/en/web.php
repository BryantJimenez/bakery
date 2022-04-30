<?php

return [
    'menu' => [
        'menu' => 'Menu',
        'home' => 'Home',
        'shop' => 'Shop',
        'sign in' => 'Sign In',
        'sign up' => 'Sign Up',
        'checkout' => 'Checkout',
        'languages' => 'Languages',
        'points' => ':points pts',
        'dashboard' => 'Dashboard',
        'profile' => 'My Profile',
        'logout' => 'Logout'
    ],

    'home' => [
        'banner' => [
            'heading' => 'Welcome',
            'title' => 'Eat <span class="font-weight-light">Healthy</span><br>Set Healthy',
            'button' => 'Online Order',
            'text' => 'The perfect themplate for your restaurant , cafe or pub. Create a full-flavored site that will wow the crowd.'
        ],
        'products' => [
            'heading' => 'Restaurant',
            'title' => 'Menu',
            'all' => 'All',
            'button' => 'View All'
        ],
        'about' => [
            'heading' => 'Our History',
            'title' => 'Few Words About Us',
            'paragraphs' => [
                'one' => 'In 1971, Rosa, Josep, Grandma Rosalia and Grandpa Antonio transformed a sandwich shop on Ausias Marc Street into a small traditional neighborhood store, Pa i Trago',
                'two' => 'From the beginning it was a trade specializing in cheeses, sausages, wines, cavas and also takeaway food. Grandma Rosalia\'s kitchen dazzled the palate of the neighbors who soon became part of the customers who appreciated good food.'
            ]
        ],
        'footer' => [
            'address' => [
                'title' => 'Our Address',
                'text' => 'C / Ausiàs March,<br>Lorem Ipsum is simply',
                'button' => 'View on Map'
            ],
            'schedule' => [
                'title' => 'Hours of Service',
                'text' => [
                    'not found' => 'There are no available hours',
                    'stairway' => ':first to :last',
                    'two days' => ':first and :last',
                    'and' => 'and'
                ]
            ],
            'contact' => [
                'title' => 'Contact Us',
                'phone' => '93 245 20 04',
                'email' => 'direccio@paitrago.com',
                'button' => 'Send Message'
            ],
            'copyright' => '© 2022 PaiTrago'
        ]
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
            'discount' => 'Discount',
            'total' => 'Total',
            'buttons' => [
                'checkout' => 'Order Now',
                'mobile' => 'View Order'
            ]
        ]
    ],

    'shop' => [
        'title' => 'Shop',
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
            ],
            'validations' => [
                'choose' => [
                    'min' => '{1} Select at least 1 option|[2,*] Select minimum :min options',
                    'max' => '{1} Select maximum 1 option|[2,*] Select max :max options'
                ]
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
                'cart' => 'Empty Cart',
                'coupons' => [
                    'error' => 'Wrong Coupon',
                    'not available' => 'Coupon Not Available',
                    'expired' => 'Expired Coupon',
                    'limit' => 'Limit Reached'
                ],
                'closed' => 'The store is closed'
            ],

            'messages' => [
                'cart' => 'The cart does not have any products.',
                'coupons' => [
                    'error' => 'This coupon is not correct.',
                    'not available' => 'You have already used this coupon.',
                    'expired' => 'This coupon has expired.',
                    'limit' => 'You have already used a coupon for this purchase.'
                ],
                'closed' => 'The store is closed at this time.',

                'subject' => [
                    'buy' => 'Purchase of products.'
                ],

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
    ],

    'js' => [
        'coupons' => [
            'buttons' => [
                'add' => 'Add a discount coupon',
                'remove' => 'Remove discount coupon',
                'close' => 'Close the discount coupon'
            ],

            'notifications' => [
                'add' => [
                    'title' => 'Coupon Added',
                    'message' => 'The discount coupon has been added successfully'
                ],

                'remove' => [
                    'title' => 'Coupon Removed',
                    'message' => 'The discount coupon has been removed successfully'
                ]
            ]
        ]
    ],

    'offline' => [
        'text' => 'You are currently not connected to any networks.'
    ]
];

?>