<?php

return [
    // Generic Labels
    'general'                                =>[
        'new'                                   => 'Erstellen',
        'days'                                  => 'Tag(e)',
        'start'                                 => 'Noch',
        'yes'                                   => 'Ja',
        'no'                                    => 'Nein..',
        'newUser'                             => 'Neuen Benutzer erstellen',
        'back'                                  => 'Zurück',
        'all'                                   => 'Alle',
        'cancel'                                => 'abbrechen',
        'remove'                                => 'Entfernen',


    ],
    // Titles
    'allUsers'                                => 'Benutzerliste',

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
        'create'                                => 'Benutzer erfolgreich erstellt! ',
        'update'                                => 'Benutzer erfolgreich bearbeitet! ',
        'delete'                                => 'Benutzer erfolgreich gelöscht! ',
        'restore'                               => 'Benutzer erfolgreich wiederhergestellt! ',
    ],
    // General Labels
    'labels'                                 =>[
        'User'                                => 'Benutzer:',
        'company'                               => 'Arbeitgeber:',
        'email'                                 => 'Email:',
        'phone'                                 => 'Telefon:',
        'info'                                  => 'Info:',
        'upcomingWorkshops'                     => 'Zukünftige Workshops:',
        'bookedWorkshops'                       => 'Gebuchte Workshops:',
        'workshopHistory'                       => 'Workshop Historie:',
        'workshopTitle'                         => 'Titel',
        'workshopDate'                          => 'Datum',
        'firstName'                             => 'Vorname:',
        'lastName'                              => 'Nachname:',
        'status'                                => 'Status:',
        'createdAt'                             => 'Erstellt am:',
        'updatedAt'                             => 'Zuletzt geändert:',
    ],
    // Form Labels
    'forms'                                 =>[
        'createUser_label'                      => 'Neuer Benutzer',
        'editUser_label'                      => 'Benutzer bearbeiten',

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
        'name'                                  => 'User',
        'email'                                 => 'Email',
        'created'                               => 'Erstellt',
        'updated'                               => 'Geändert',
        'actions'                               => 'Aktionen',
    ],
    // User Button Labels
    'buttons'                                =>[
        'createNew'                             => 'Erstellen',
        'delete'                                => 'Benutzer löschen',
        'show'                                  => 'Details',
        'edit'                                  => 'Ändern',
        'backToUsers'                           => 'Benutzer Management',
        'backToUser'                            => 'Zurück zu Benutzer details',
        'removeWorkshop'                        => 'Workshop entfernen',
        'saveChanges'                           => 'Änderungen speichern',


    ],

    'tooltips'                              =>[
        'delete'                                => 'Benutzer löschen...',
        'show'                                  => 'Anzeigen',
        'edit'                                  => 'Bearbeiten',
        'createNew'                             => 'Neuen Benutzer erstellen',
        'backToUsers'                         => 'Zurück zur Benutzer Liste',
        'backToUser'                          => 'Zurück zu Benutzer details',
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
