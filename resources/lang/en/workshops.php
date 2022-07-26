<?php

return [

    // Titles
    'showing-all-online' => 'Online',
    'showing-all-faceToFace' => 'FaceToFace',
    'users-menu-alt' => 'Show Users Management Menu',
    'create-new-workshop' => 'New workshop',
    'show-deleted-workshops' => 'Show Deleted workshops',
    'editing-workshop' => 'Editing :name, Date  :date',
    'showing-workshop' => 'Showing :name',
    'showing-workshop-title' => 'Workshop :name',

    // Edit Workshop
    'remove-trainer' => '--Remove Trainer--',

    // Flash Messages
    'createSuccess' => 'Successfully created workshop! ',
    'updateSuccess' => 'Successfully updated workshop! ',
    'deleteSuccess' => 'Successfully deleted workshop! ',
    'deleteSelfError' => 'You cannot delete yourself! ',

    // Show Workshop Tab
    'viewProfile' => 'View Profile',
    'addClients' => 'Add Client ',
    'editClients' => 'Edit Clients',
    'editWorkshop' => 'Edit workshop',
    'deleteWorkshop' => 'Delete',
    'usersBackBtn' => 'Back to workshops',
    'usersPanelTitle' => 'workshop Information',
    'labelWorkshop' => 'Title:',
    'labelClients' => 'Clients:',
    'labelLocation' => 'Location:',
    'labelStartDate' => 'Start:',
    'labelEndDate' => 'End:',
    'labelDate' => 'Date:',
    'labelPhone' => 'Phone:',
    'labelDetails' => 'Details:',
    'labelOtherDates' => 'Other Dates:',
    'labelHrEmail' => 'HR Email:',
    'labelHrPhone' => 'HR Phone:',
    'labelFirstName' => 'First Name:',
    'labelLastName' => 'Last Name:',
    'labelChatRoom' => 'Chat Room:',
    'labelStatus' => 'Status:',
    'labelAccessLevel' => 'Access',
    'labelPermissions' => 'Permissions:',
    'labelCreatedAt' => 'Created At:',
    'labelUpdatedAt' => 'Updated At:',
    'labelIpEmail' => 'Email Signup IP:',
    'labelIpConfirm' => 'Confirmation IP:',
    'labelIpSocial' => 'Socialite Signup IP:',
    'labelIpAdmin' => 'Admin Signup IP:',
    'labelIpUpdate' => 'Last Update IP:',
    'labelDeletedAt' => 'Deleted on',
    'labelIpDeleted' => 'Deleted IP:',
    'usersDeletedPanelTitle' => 'Deleted User Information',
    'usersBackDelBtn' => 'Back to Deleted Users',

    'successRestore' => 'User successfully restored.',
    'successDestroy' => 'User record successfully destroyed.',
    'errorUserNotFound' => 'User not found.',

    'labelUserLevel' => 'Level',
    'labelUserLevels' => 'Levels',

    'workshops-table' => [
        'caption' => '{1} :userscount user total|[2,*] :userscount total users',
        'id' => 'ID',
        'name' => 'Workshop',
        'title' => 'Title:',
        'detail' => 'Details:',
        'date' => 'Date:',
        'location' => 'Location:',
        'trainer' => 'Trainer:',
        'trainerCount' => 'Trainer Count:',
        'status' => 'Status:',
        'clientCount' => 'Clients:',
        'created' => 'Created',
        'updated' => 'Updated',
        'actions' => 'Actions',

    ],

    'buttons' => [
        'create-new' => 'New workshop',
        'cancel' => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Cancel</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'delete' => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'show' => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'edit' => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> </span>',
        'back-to-workshops' => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">workshops</span>',
        'back-to-workshop' => 'Back  <span class="hidden-xs">to workshop</span>',
        'delete-user' => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> workshop</span>',
        'edit-user' => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> workshop</span>',
    ],

    'tooltips' => [
        'cancel' => 'Cancel',
        'delete' => 'Delete',
        'show' => 'Show',
        'edit' => 'Edit',
        'location' => 'Location',
        'trainer' => 'Trainer',
        'create-new' => 'Create New workshop',
        'back-workshops' => 'Back to workshops',
        'email-workshop' => 'Email :workshop',
        'submit-search' => 'Submit workshop Search',
        'clear-search' => 'Clear Search Results',
    ],

    'messages' => [
        'userNameTaken' => 'Username is taken',
        'userNameRequired' => 'Username is required',
        'fNameRequired' => 'First Name is required',
        'lNameRequired' => 'Last Name is required',
        'emailRequired' => 'Email is required',
        'emailInvalid' => 'Email is invalid',
        'passwordRequired' => 'Password is required',
        'PasswordMin' => 'Password needs to have at least 6 characters',
        'PasswordMax' => 'Password maximum length is 20 characters',
        'captchaRequire' => 'Captcha is required',
        'CaptchaWrong' => 'Wrong captcha, please try again.',
        'roleRequired' => 'User role is required.',
        'workshop-creation-success' => 'Successfully created workshop!',
        'update-workshop-success' => 'Successfully updated workshop!',
        'delete-success' => 'Successfully deleted the workshop!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-user' => [
        'id' => 'User ID',
        'name' => 'Username',
        'email' => '<span class="hidden-xs">User </span>Email',
        'role' => 'User Role',
        'created' => 'Created <span class="hidden-xs">at</span>',
        'updated' => 'Updated <span class="hidden-xs">at</span>',
        'labelRole' => 'User Role',
        'labelAccessLevel' => '<span class="hidden-xs">User</span> Access Level|<span class="hidden-xs">User</span> Access Levels',
    ],

    'search' => [
        'title' => 'Showing Search Results',
        'found-footer' => ' Record(s) found',
        'no-results' => 'No Results',
        'search-users-ph' => 'Search Users',
    ],

    'modals' => [
        'delete_user_message' => 'Are you sure you want to delete :user?',
    ],
];
