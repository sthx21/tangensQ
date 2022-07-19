<?php

return [

    // Titles
    'showing-all-companies'     => 'Companies',
    'users-menu-alt'        => 'Show Users Management Menu',
    'create-new-company'       => 'New Company',
    'show-deleted-companies'    => 'Show Deleted Companies',
    'editing-company'          => 'Editing :name',
    'showing-company'          => 'Showing :name',
    'showing-company-name'    => ':name\'s Information',

    // Flash Messages
    'createSuccess'   => 'Successfully created company! ',
    'updateSuccess'   => 'Successfully updated company! ',
    'deleteSuccess'   => 'Successfully deleted company! ',
    'deleteSelfError' => 'You cannot delete yourself! ',

    // Show User Tab
    'viewProfile'            => 'View Profile',
    'editCompany'               => 'Edit Company',
    'deleteCompany'             => 'Delete Company',
    'usersBackBtn'           => 'Back to Companies',
    'usersPanelTitle'        => 'Company Information',
    'labelCompany'          => 'Company:',
    'labelName'          => 'Company Name:',
    'labelAddress'          => 'Company Address:',
    'labelStaff'          => 'Staff:',
    'labelEmail'             => 'Company Email:',
    'labelPhone'             => 'Company Phone:',
    'labelInfo'             => 'Company Info:',
    'labelUpcoming'             => 'Upcoming Booked Workshops:',
    'labelHrEmail'             => 'HR Email:',
    'labelHrPhone'             => 'HR Phone:',
    'labelHrTitle'          => 'Title:',
    'labelHrName'         => 'HR Full Name:',
    'labelHrFirstName'      => 'HR First Name',
    'labelHrLastName'          => 'HR Last Name:',
    'labelHrInfo'              => 'HR Info:',
    'labelStatus'            => 'Status:',
    'labelAccessLevel'       => 'Access',
    'labelPermissions'       => 'Permissions:',
    'labelCreatedAt'         => 'Created At:',
    'labelUpdatedAt'         => 'Updated At:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpConfirm'         => 'Confirmation IP:',
    'labelIpSocial'          => 'Socialite Signup IP:',
    'labelIpAdmin'           => 'Admin Signup IP:',
    'labelIpUpdate'          => 'Last Update IP:',
    'labelDeletedAt'         => 'Deleted on',
    'labelIpDeleted'         => 'Deleted IP:',
    'usersDeletedPanelTitle' => 'Deleted User Information',
    'usersBackDelBtn'        => 'Back to Deleted Users',

    'successRestore'    => 'User successfully restored.',
    'successDestroy'    => 'User record successfully destroyed.',
    'errorUserNotFound' => 'User not found.',

    'labelUserLevel'  => 'Level',
    'labelUserLevels' => 'Levels',

    'companies-table' => [
        'caption'   => '{1} :userscount user total|[2,*] :userscount total users',
        'id'        => 'ID',
        'name'      => 'Company',
        'fname'     => 'HR First Name',
        'lname'     => 'HR Last Name',
        'email'     => 'Company Email',
        'staff'      => 'Staff',
        'created'   => 'Created',
        'updated'   => 'Updated',
        'actions'   => 'Actions',

    ],

    'buttons' => [
        'create-new'    => 'New Company',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'back-to-companies' => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">Companies</span>',
        'back-to-company'  => 'Back  <span class="hidden-xs">to Company</span>',
        'delete-user'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> Company</span>',
        'edit-user'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> Company</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New Company',
        'back-companies'    => 'Back to companies',
        'email-company'    => 'Email :company',
        'submit-search' => 'Submit Company Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'userNameTaken'          => 'Username is taken',
        'userNameRequired'       => 'Username is required',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'User role is required.',
        'company-creation-success'  => 'Successfully created Company!',
        'update-company-success'    => 'Successfully updated Company!',
        'delete-success'         => 'Successfully deleted the Company!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-user' => [
        'id'                => 'User ID',
        'name'              => 'Username',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'User Role',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'User Role',
        'labelAccessLevel'  => '<span class="hidden-xs">User</span> Access Level|<span class="hidden-xs">User</span> Access Levels',
    ],

    'search'  => [
        'title'             => 'Showing Search Results',
        'found-footer'      => ' Record(s) found',
        'no-results'        => 'No Results',
        'search-users-ph'   => 'Search Users',
    ],

    'modals' => [
        'delete_user_message' => 'Are you sure you want to delete :user?',
    ],
];
