<?php

return [
    'name' => 'Tiendita',
    'header' => [
        'profile' => 'My profile',
        'web' => 'Go to website',
        'logout' => 'Logout'
    ],

    'sidebar' => [
        'home' => 'Home',
        'users' => 'Users',
        'customers' => 'Customers',
        'categories' => 'Categories',
        'products' => 'Products',
        'complements' => 'Complements',
        'groups' => 'Groups',
        'orders' => 'Orders',
        'agencies' => 'Agencies',
        'attributes' => 'Attributes',
        'coupons' => 'Coupons',
        'currencies' => 'Currencies',
        'languages' => 'Languages',
        'schedules' => 'Schedules',
        'settings' => 'Settings'
    ],

    'footer' => [
        'copyright' => 'All rights reserved',
        'developed by' => 'Custom developed by'
    ],

    'home' => [
        'title' => 'Home',
        'welcome' => [
            'title' => 'Welcome:',
            'subtitle' => 'Manage your entire business in a simple, easy, comfortable and customized way!'
        ],
        'counters' => [
            'users' => 'Users',
            'customers' => 'Customers',
            'categories' => 'Categories',
            'products' => 'Products',
            'groups' => 'Groups',
            'complements' => 'Complements',
            'agencies' => 'Agencies',
            'attributes' => 'Attributes',
            'coupons' => 'Coupons',
            'orders' => [
                'confirms' => 'Orders Confirms',
                'pendings' => 'Orders Pendings'
            ],
            'payments' => 'Payments'
        ]
    ],

    'profile' => [
        'titles' => [
            'edit' => 'Edit Profile',
            'show' => 'User Profile'
        ],
        'subtitles' => [
            'show' => 'Personal Information'
        ]
    ],

    'users' => [
        'titles' => [
            'index' => 'List of Users',
            'create' => 'Create User',
            'edit' => 'Edit User',
            'show' => 'User Profile'
        ],
        'subtitles' => [
            'show' => 'Personal Information'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this user?',
                'activate' => 'Are you sure you want to activate this user?',
                'delete' => 'Are you sure you want to delete this user?'
            ]
        ]
    ],

    'customers' => [
        'titles' => [
            'index' => 'List of Customers',
            'create' => 'Create Customer',
            'edit' => 'Edit Customer',
            'show' => 'Customer Profile'
        ],
        'subtitles' => [
            'show' => 'Personal Information'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this customer?',
                'activate' => 'Are you sure you want to activate this customer?',
                'delete' => 'Are you sure you want to delete this customer?'
            ]
        ]
    ],

    'categories' => [
        'titles' => [
            'index' => 'List of Categories',
            'create' => 'Create Category',
            'edit' => 'Edit Category'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this category?',
                'activate' => 'Are you sure you want to activate this category?',
                'delete' => 'Are you sure you want to delete this category?'
            ]
        ]
    ],

    'products' => [
        'titles' => [
            'index' => 'List of Products',
            'create' => 'Create Product',
            'edit' => 'Edit Product',
            'show' => 'Product Information'
        ],
        'subtitles' => [
            'show' => [
                'data' => 'Product Data',
                'aditional' => 'Additional Information',
                'groups' => 'Groups'
            ]
        ],
        'info' => [
            'qty groups' => 'No. Groups'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this product?',
                'activate' => 'Are you sure you want to activate this product?',
                'delete' => 'Are you sure you want to delete this product?',
                'assign' => 'Select the groups to be assigned to this product'
            ]
        ]
    ],

    'complements' => [
        'titles' => [
            'index' => 'List of Complements',
            'create' => 'Create Complement',
            'edit' => 'Edit Complement',
            'show' => 'Complement Information'
        ],
        'subtitles' => [
            'show' => [
                'data' => 'Product Data',
                'aditional' => 'Additional Information'
            ]
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this complement?',
                'activate' => 'Are you sure you want to activate this complement?',
                'delete' => 'Are you sure you want to delete this complement?'
            ]
        ]
    ],

    'groups' => [
        'titles' => [
            'index' => 'List of Groups',
            'create' => 'Create Group',
            'edit' => 'Edit Group',
            'show' => 'Group Information',
            'complements' => 'Add Complements'
        ],
        'subtitles' => [
            'show' => [
                'data' => 'Group Information',
                'complements' => 'Complements'
            ]
        ],
        'info' => [
            'min' => 'Minimum number of options to select',
            'max' => 'Maximum number of options to select',
            'qty complements' => 'No. Complements'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this group?',
                'activate' => 'Are you sure you want to activate this group?',
                'delete' => 'Are you sure you want to delete this group?'
            ]
        ]
    ],

    'orders' => [
        'titles' => [
            'index' => 'List of Orders',
            'show' => 'Order Details'
        ],
        'subtitles' => [
            'show' => [
                'user' => 'User Information',
                'order' => 'Order Information',
                'products' => 'Order Products',
                'payment' => 'Payment Details',
                'shipping' => 'Shipping Information',
                'coupon' => 'Coupon Details'
            ]
        ],
        'info' => [
            'qty products' => 'Quantity of Products',
            'total paid' => 'Total Paid',
            'type delivery' => 'Type Delivery',
            'address shipping' => 'Address Shipping',
            'qty' => 'Quantity',
            'subtotal' => 'Subtotal',
            'shipping' => 'Shipping',
            'discount' => 'Discount',
            'total' => 'Total',
            'reason' => 'Reason',
            'commission' => 'Comission',
            'balance' => 'Balance'
        ],
        'modals' => [
            'titles' => [
                'reject' => 'Are you sure you want to reject this order?',
                'confirm' => 'Are you sure you want to confirm this order?'
            ]
        ]
    ],

    'agencies' => [
        'titles' => [
            'index' => 'List of Agencies',
            'create' => 'Create Agency',
            'edit' => 'Edit Agency'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this agency?',
                'activate' => 'Are you sure you want to activate this agency?',
                'delete' => 'Are you sure you want to delete this agency?'
            ]
        ]
    ],

    'attributes' => [
        'titles' => [
            'index' => 'List of Attributes',
            'create' => 'Create Attribute',
            'edit' => 'Edit Attribute'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this attribute?',
                'activate' => 'Are you sure you want to activate this attribute?',
                'delete' => 'Are you sure you want to delete this attribute?'
            ]
        ]
    ],

    'coupons' => [
        'titles' => [
            'index' => 'List of Coupons',
            'create' => 'Create Coupon',
            'edit' => 'Edit Coupon'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this coupon?',
                'activate' => 'Are you sure you want to activate this coupon?',
                'delete' => 'Are you sure you want to delete this coupon?'
            ]
        ]
    ],

    'currencies' => [
        'titles' => [
            'index' => 'List of Currencies',
            'create' => 'Create Currency',
            'edit' => 'Edit Currency'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this currency?',
                'activate' => 'Are you sure you want to activate this currency?',
                'delete' => 'Are you sure you want to delete this currency?'
            ]
        ]
    ],

    'languages' => [
        'titles' => [
            'languages' => [
                'index' => 'List of Languages',
                'create' => 'Add Language'
            ],
            'translations' => [
                'index' => 'List of Translations',
                'create' => 'Add Translation'
            ]
        ],
        'info' => [
            'group single' => 'Group / Single',
            'key' => 'Key',
            'search' => 'Search all translations'
        ]
    ],

    'schedules' => [
        'titles' => [
            'index' => 'List of Schedules',
            'create' => 'Create Schedule',
            'edit' => 'Edit Schedule'
        ],
        'modals' => [
            'titles' => [
                'deactivate' => 'Are you sure you want to deactivate this schedule?',
                'activate' => 'Are you sure you want to activate this schedule?',
                'delete' => 'Are you sure you want to delete this schedule?'
            ]
        ]
    ],

    'settings' => [
        'titles' => [
            'edit' => 'Edit Settings'
        ]
    ],

    'table' => [
        'actions' => 'Actions',
        'profile' => 'Profile',
        'show' => 'View',
        'edit' => 'Edit',
        'deactivate' => 'Deactivate',
        'activate' => 'Activate',
        'delete' => 'Delete',
        'assign' => [
            'groups' => 'Assign Groups',
            'complements' => 'Assign Complements'
        ],
        'reject' => 'Reject',
        'confirm' => 'Confirm',
        'order' => 'View Order',
        'translations' => 'List of Translations'
    ],

    'values_attributes' => [
        'unknown' => 'Unknown',
        'states' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'products' => [
                'not available' => 'Not Available',
                'out of stock' => 'Out of Stock'
            ],
            'complements' => [
                'available' => 'Available',
                'not available' => 'Not Available',
                'out of stock' => 'Out of Stock',
                'not visible' => 'Not Visible'
            ],
            'orders' => [
                'rejected' => 'Rejected',
                'confirmed' => 'Confirmed',
                'waiting' => 'Waiting'
            ],
            'payments' => [
                'rejected' => 'Rejected',
                'confirmed' => 'Confirmed',
                'pending' => 'Pending'
            ],
            'settings' => [
                'open' => 'Open',
                'closed' => 'Closed'
            ]
        ],
        'types' => [
            'coupons' => [
                'fixed' => 'Fixed',
                'percentage' => 'Percentage'
            ],
            'deliveries' => [
                'eat on site' => 'Eat On Site',
                'to take away' => 'To Take Away',
                'delivery' => 'Delivery'
            ]
        ],
        'conditions' => [
            'required' => 'Required',
            'optional' => 'Optional'
        ],
        'methods' => [
            'card' => 'Card'
        ],
        'days' => [
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
            '7' => 'Sunday'
        ],
        'forces' => [
            'yes' => 'Yes',
            'no' => 'No'
        ]
    ],
    'not added' => 'Not Added',

    'notifications' => [
        'success' => [
            'titles' => [
                'store' => 'Successful registration',
                'update' => 'Successful edition',
                'destroy' => 'Successful deletion'
            ],

            'messages' => [
                'profile' => [
                    'update' => 'The profile has been successfully edited.'
                ],

                'users' => [
                    'store' => 'The user has been successfully registered.',
                    'update' => 'The user has been successfully edited.',
                    'destroy' => 'The user has been successfully deleted.',
                    'deactivate' => 'The user has been successfully deactivated.',
                    'activate' => 'The user has been successfully activated.'
                ],

                'customers' => [
                    'store' => 'The client has been successfully registered.',
                    'update' => 'The client has been successfully edited.',
                    'destroy' => 'The client has been successfully deleted.',
                    'deactivate' => 'The client has been successfully deactivated.',
                    'activate' => 'The client has been successfully activated.'
                ],

                'categories' => [
                    'store' => 'The category has been successfully registered.',
                    'update' => 'The category has been successfully edited.',
                    'destroy' => 'The category has been successfully deleted.',
                    'deactivate' => 'The category has been successfully deactivated.',
                    'activate' => 'The category has been successfully activated.'
                ],

                'products' => [
                    'store' => 'The product has been successfully registered.',
                    'update' => 'The product has been successfully edited.',
                    'destroy' => 'The product has been successfully deleted.',
                    'deactivate' => 'The product has been successfully deactivated.',
                    'activate' => 'The product has been successfully activated.',
                    'assign' => 'The complements group has been successfully assigned.'
                ],

                'complements' => [
                    'store' => 'The complement has been successfully registered.',
                    'update' => 'The complement has been successfully edited.',
                    'destroy' => 'The complement has been successfully deleted.',
                    'deactivate' => 'The complement has been successfully deactivated.',
                    'activate' => 'The complement has been successfully activated.'
                ],

                'groups' => [
                    'store' => 'The group has been successfully registered.',
                    'update' => 'The group has been successfully edited.',
                    'destroy' => 'The group has been successfully deleted.',
                    'deactivate' => 'The group has been successfully deactivated.',
                    'activate' => 'The group has been successfully activated.',
                    'assign' => 'The complements have been assigned successfully.'
                ],

                'orders' => [
                    'reject' => 'The order has been successfully rejected.',
                    'confirm' => 'The order has been successfully confirmed.'
                ],

                'agencies' => [
                    'store' => 'The agency has been successfully registered.',
                    'update' => 'The agency has been successfully edited.',
                    'destroy' => 'The agency has been successfully deleted.',
                    'deactivate' => 'The agency has been successfully deactivated.',
                    'activate' => 'The agency has been successfully activated.'
                ],

                'attributes' => [
                    'store' => 'The attribute has been successfully registered.',
                    'update' => 'The attribute has been successfully edited.',
                    'destroy' => 'The attribute has been successfully deleted.',
                    'deactivate' => 'The attribute has been successfully deactivated.',
                    'activate' => 'The attribute has been successfully activated.'
                ],

                'coupons' => [
                    'store' => 'The coupon has been successfully registered.',
                    'update' => 'The coupon has been successfully edited.',
                    'destroy' => 'The coupon has been successfully deleted.',
                    'deactivate' => 'The coupon has been successfully deactivated.',
                    'activate' => 'The coupon has been successfully activated.'
                ],

                'currencies' => [
                    'store' => 'The customer has been successfully registered.',
                    'update' => 'The customer has been successfully edited.',
                    'destroy' => 'The customer has been successfully deleted.',
                    'deactivate' => 'The customer has been successfully deactivated.',
                    'activate' => 'The customer has been successfully activated.'
                ],

                'languages' => [
                    'store' => 'The language has been successfully registered.'
                ],

                'schedules' => [
                    'store' => 'The schedule has been successfully registered.',
                    'update' => 'The schedule has been successfully edited.',
                    'destroy' => 'The schedule has been successfully deleted.',
                    'deactivate' => 'The schedule has been successfully deactivated.',
                    'activate' => 'The schedule has been successfully activated.'
                ],

                'settings' => [
                    'update' => 'The settings have been successfully edited.'
                ]
            ]
        ],

        'error' => [
            '500' => 'An error occurred during the process, please try again.',
            'titles' => [
                'store' => 'Failed registration',
                'update' => 'Failed edition',
                'destroy' => 'Failed delete'
            ],

            'messages' => [
                'customers' => [
                    '403' => [
                        'title' => 'User is not a customer',
                        'msg' => 'This user is not a customer, he has a different role.'
                    ]
                ],

                'categories' => [
                    '422' => [
                        'title' => 'The category already exists',
                        'msg' => 'This category is already registered.'
                    ]
                ],

                'attributes' => [
                    '422' => [
                        'title' => 'The attribute already exists',
                        'msg' => 'This attribute is already registered.'
                    ]
                ],

                'currencies' => [
                    '422' => [
                        'title' => 'The currency already exists',
                        'msg' => 'This currency is already registered.'
                    ]
                ],

                'languages' => [
                    '422' => [
                        'title' => 'The language already exists',
                        'msg' => 'This language is already registered.'
                    ]
                ],

                'schedules' => [
                    '422' => [
                        'title' => 'The schedule already exists',
                        'msg' => 'This schedule interferes with another already registered.'
                    ]
                ]
            ]
        ]
    ],

    'js' => [
        '500' => [
            'title' => 'Error',
            'msg' => 'A problem has occurred, please try again.'
        ],

        'table' => [
            'info' => 'Results from :start to :end of a total of :total records',
            'search' => 'Search...',
            'length' => 'Show :menu records',
            'processing' => 'Processing...',
            'empty' => [
                'zero' => 'No results found',
                'table' => 'No results available in this table',
                'info' => 'No results',
            ],
            'filter' => '(filtered from a total of :max records)',
            'loading' => 'Loading...',
            'sort' => [
                'asc' => ': Activate to sort the column in ascending order',
                'desc' => ': Activate to sort the column in descending order'
            ],
            'buttons' => [
                'copy' => 'Copy',
                'print' => 'Print'
            ]
        ],

        'file' => [
            'messages' => [
                'default' => 'Drag and drop an image or click to select it',
                'replace' => 'Drag and drop an image or click to replace',
                'remove' => 'Remove',
                'error' => 'Sorry, the file is too big'
            ],

            'error' => [
                'fileSize' => 'The file size is too large (:value maximum).',
                'minWidth' => 'The width of the image is too small (:value px minimum).',
                'maxWidth' => 'The width of the image is too large (max :value px).',
                'minHeight' => 'Image height is too small (:value px minimum).',
                'maxHeight' => 'The height of the image is too large (maximum :value px).',
                'imageFormat' => 'The image format is not allowed (Must be :value).'
            ]
        ],

        'date' => [
            'cancel' => 'Cancel',
            'clear' => 'Clear'
        ]
    ]
];

?>