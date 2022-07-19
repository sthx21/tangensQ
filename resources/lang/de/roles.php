<?php

return [
    // Generic Labels
    'general'                                =>[
        'new'                                   => 'Erstellen',
        'days'                                  => 'Tag(e)',
        'start'                                 => 'Noch',
        'yes'                                   => 'Ja',
        'no'                                    => 'Nein..',
        'newRole'                               => 'Neue Rolle erstellen',
        'back'                                  => 'Zurück',
        'all'                                   => 'Alle',
        'cancel'                                => 'abbrechen',
        'remove'                                => 'Entfernen',
        'cant'                                  => 'Diese Rolle kann nicht verändert werden!',


    ],
    // Titles
    'allRoles'                                => 'Rollen Management',

    'showDeletedUsers'                        => 'Gelöschte Benutzer anzeigen',
    'editingUser'                             => ':name bearbeiten',
    'showingUser'                             => ':name',
    'showingUserTitle'                        => ':name\'s Informationen',

    // Confirmations

    'confirm'                               => [
        'delete'                                => 'Wirklich löschen?',
        'restore'                               => 'Wirklich Reaktivieren?',
        'edit'                                  => 'Sind alle Änderungen richtig?',
        'new'                                   => 'Sind alle Angaben richtig?',
    ],
    // Flash Messages
    'success'                                =>[
        'create'                                => 'Rolle erfolgreich erstellt! ',
        'update'                                => 'Rolle erfolgreich bearbeitet! ',
        'delete'                                => 'Rolle erfolgreich gelöscht! ',
        'restore'                               => 'Rolle erfolgreich wiederhergestellt! ',
    ],
    // General Labels
    'labels'                                 =>[
        'group'                               => 'Gruppe:',
        'info'                                  => 'Info:',
        'name'                                  => 'Name:',
        'permissions'                           => 'Rechte:',
       'show'                                   => 'Rollendetails',
        'status'                                => 'Status:',
        'createdAt'                             => 'Erstellt am:',
        'updatedAt'                             => 'Zuletzt geändert:',
    ],
    // Edit Role
    'edit'                                   => [
        'role'                                  => 'Rolle bearbeiten:',
        'name'                                  => 'Name ändern:',
        'permissions'                           => 'Rechte:',
        'removePermission'                             => 'Recht entfernen',
        'trainerOne'                                => 'Erster Trainer:',
        'trainerTwo'                                => 'Zweiter Trainer:',
        'status'                                    => 'Status: ',
        'topic_coreQuestions'                       => 'Inhalte - Kernfragen: ',
        'title'                                     => 'Titel: ',
        'additionalTitle'                           => 'Zusatztitel: ',
        'targets'                                   => 'Zielgruppe: ',
        'processFlow'                               => 'Ablauf: ',
        'detail'                                    => 'Nutzen - Zielsetzung: ',
        'startDate'                                     => 'Anfang: ',
        'endDate'                                   => 'Ende: ',
        'location'                                  => 'Hotel: ',
    ],
    // Form Labels
    'forms'                                 =>[
        'createRole_label'                      => 'Neuer Benutzer',
        'userName_label'                      => 'Name',
        'userName_ph'                         => 'Wie lautet der Name?',
        'userName_icon'                       => 'fa-user',
        'addPermission_label'                   => 'Workshop hinzufügen',
        'addPermission_ph'                      => 'Workshop wählen..',
        'addPermission_icon'                    => 'fa-user',
        'role_label'                            => 'Rolle',
        'role_icon'                            => 'fas fa-user-tag',
        'password_icon'                            => 'fas fa-key',
        'password_label'                            => 'Passwort',
        'password_label_confirm'                            => 'Passwort wiederholen',

        'addRole_label'                      => 'Benutzerrolle hinzufgen',
        'addRole_ph'                         => 'Benutzerrolle wählen',
        'addRole_icon'                       => 'fas fa-user-tag',
        'changeRole_label'                      => 'Benutzerrolle ändern',
        'changeRole_ph'                         => 'Benutzerrolle ändern',
        'changeRole_icon'                       => 'fa-user-tag',
        'name_label'                            => 'Name',
        'name_ph'                               => 'Namen eingeben..',
        'name_icon'                             => 'fa-user',

        'email_label'                           => 'Email',
        'email_ph'                              => 'Wie lautet die Email Adresse..? (Pflichtfeld!)',
        'email_icon'                            => 'fa-envelope',


        'bookedWorkshop_label' => 'Gebuchte Workshops',
        'bookedWorkshop_ph' => 'Gebuchte Workshop',
        'bookedWorkshop_icon' => 'fa-user',
        'removeWorkshop_label' => 'Zum entfernen in der Liste Entfernen auswählen',
        'removeWorkshop_ph' => 'Workshop entfernen...',
        'removeWorkshop_icon' => 'fa-user',



    ],

    // Index Labels
    'index'                                  =>[
        'id'                                    => 'ID',
        'number'                                => 'Nr.',
        'name'                                  => 'Rolle :',
        'permissions'                           => 'Berechtigungen :',
        'status'                                => 'Status :',
        'email'                                 => 'Email',
        'created'                               => 'Erstellt am :',
        'updated'                               => 'Geändert am :',
        'actions'                               => 'Aktionen',
    ],
    // User Button Labels
    'buttons'                                =>[
        'createNew'                             => 'Neue Rolle',
        'delete'                                => 'Löschen',
        'show'                                  => 'Details',
        'edit'                                  => 'Bearbeiten',
        'backToRoles'                           => 'Rollen Management',
        'backToUser'                            => 'Zurück zu Rollendetails',
        'removeWorkshop'                        => 'Workshop entfernen',
        'saveChanges'                           => 'Änderungen speichern',


    ],

    'tooltips'                              =>[
        'delete'                                => 'Rolle löschen...',
        'show'                                  => 'Anzeigen',
        'edit'                                  => 'Bearbeiten',
        'createNew'                             => 'Neue Rolle erstellen',
        'backToUsers'                         => 'Zurück zur Rollenübersicht',
        'backToUser'                          => 'Zurück zu Rollendetails',
        'removeWorkshop'                        => 'Workshop entfernen...',
        'email'                                 => 'Email :User',
        'submitSearch'                          => 'Submit User Search',
        'clearSearch'                           => 'Clear Search Results',
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
        'User-creation-success'  => 'Successfully created User!',
        'update-User-success'    => 'Successfully updated User!',
        'delete-success'         => 'Successfully deleted the User!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
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
