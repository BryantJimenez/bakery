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
        'currencies' => 'Currencies',
        'languages' => 'Languages',
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
                'shipping' => 'Shipping Information'
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
            ]
        ],
        'conditions' => [
            'required' => 'Required',
            'optional' => 'Optional'
        ],
        'methods' => [
            'card' => 'Card'
        ],
        'types_delivery' => [
            'eat on site' => 'Eat On Site',
            'to take away' => 'To Take Away',
            'delivery' => 'Delivery'
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

                'currencies' => [
                    'store' => 'The customer has been successfully registered.',
                    'update' => 'The customer has been successfully edited.',
                    'destroy' => 'The customer has been successfully deleted.',
                    'deactivate' => 'The customer has been successfully deactivated.',
                    'activate' => 'The customer has been successfully activated.'
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
                ]
            ]
        ]
    ]
];

?>