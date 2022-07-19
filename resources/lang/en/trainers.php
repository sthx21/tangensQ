<?php

return [
    // Generic Labels
    'general'                                =>[
        'new'                                   => 'Erstellen',
        'days'                                  => 'Tag(e)',
        'start'                                 => 'Noch',
        'yes'                                   => 'Ja',
        'no'                                    => 'Nein..',
        'newClient'                             => 'Neuen Teilnehmer erstellen',
        'back'                                  => 'Zurück',
        'all'                                   => 'Alle',
        'cancel'                                => 'abbrechen',
        'remove'                                => 'Entfernen',


    ],
    // Titles
    'showing-all-trainers'     => 'Trainers',
    'users-menu-alt'        => 'Show Users Management Menu',
    'create-new-trainer'       => 'New trainer',
    'show-deleted-trainers'    => 'Show Deleted trainers',
    'editing-trainer'          => 'Trainer :name bearbeiten',
    'showing-trainer'          => 'Trainer :name\'s Infos ',
    'showing-trainer-title'    => 'Trainer :name\'s Information',

    // Confirmations
    'confirm'                               => [
        'delete'                                => 'Wirklich löschen?',
        'deleteText'                            => 'Dieser Vorgang ist Endgültig..!',
        'restore'                               => 'Wirklich Reaktivieren?',
        'edit'                                  => 'Sind alle Änderungen richtig?',
        'new'                                   => 'Sind alle Angaben richtig?'
    ],
    // Flash Messages
    'success'                                =>[
        'create'                                => 'Trainer erfolgreich erstellt! ',
        'update'                                => 'Trainer erfolgreich bearbeitet! ',
        'delete'                                => 'Trainer erfolgreich gelöscht! ',
        'restore'                               => 'Trainer erfolgreich wiederhergestellt! '
    ],

    // Show User Tab
    'viewProfile'            => 'View Profile',
    'editTrainer'               => 'Edit Trainer',
    'deleteTrainer'             => 'Delete Trainer',
    'usersBackBtn'           => 'Back to trainers',
    'usersPanelTitle'        => 'trainer Information',
    'labelTrainer'          => 'Trainer:',
    'labelCompany'          => 'Company:',
    'labelEmail'             => 'Email:',
    'labelPhone'             => 'Phone:',
    'labelInfo'             => 'Info:',
    'labelUpcoming'             => 'Upcoming Booked Workshops:',
    'labelHrEmail'             => 'HR Email:',
    'labelHrPhone'             => 'HR Phone:',
    'labelFirstName'         => 'First Name:',
    'labelLastName'          => 'Last Name:',
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

    'trainers-table' => [
        'caption'   => '{1} :userscount user total|[2,*] :userscount total users',
        'id'        => 'ID',
        'name'      => 'trainer',
        'fname'     => 'First Name',
        'lname'     => 'Last Name',
        'email'     => 'Email',
        'company'      => 'Company',
        'created'   => 'Created',
        'updated'   => 'Updated',
        'actions'   => 'Actions',

    ],

    // Trainer Button Labels
    'buttons'                                =>[
        'create'                                => 'Erstellen',
        'createNew'                             => 'Neuen Trainer Erstellen',
        'delete'                                => 'Löschen',
        'cancel'                                => 'Verklickt..',
        'confirm'                                => 'Los..',
        'show'                                  => 'Details',
        'edit'                                  => 'Bearbeiten',
        'backToTrainers'                         => 'Zurück zur Trainer Liste',
        'backToTrainer'                          => 'Zurück zu Trainer details',
        'removeWorkshop'                        => 'Workshop entfernen',
        'saveChanges'                           => 'Änderungen speichern'

    ],

    'tooltips'                              =>[
        'delete'                                => 'Trainer löschen...',
        'show'                                  => 'Trainer Details anzeigen',
        'edit'                                  => 'Trainer bearbeiten',
        'createNew'                             => 'Neuen Teilnehmer erstellen',
        'backToTrainers'                         => 'Zurück zur Trainer Übersicht',
        'backToTrainer'                          => 'Zurück zu Trainer details',
        'removeWorkshop'                        => 'Workshop entfernen...',
        'email'                                 => 'Email :client',

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
        'trainer-creation-success'  => 'Successfully created trainer!',
        'update-trainer-success'    => 'Successfully updated trainer!',
        'delete-success'         => 'Successfully deleted the trainer!',
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
