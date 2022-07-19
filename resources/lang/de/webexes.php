<?php

return [

    //General

    'general'                               => [
        'new'                                   => 'Erstellen',
        'days'                                  => 'Tag(e)',
        'start'                                 => 'Noch',
        'yes'                                   => 'Ja',
        'no'                                    => 'Nein..',
        'newWorkshop'                           => 'Neuen Workshop erstellen',
        'back'                                  => 'Zurück',
        'all'                                   => 'Alle',
        'cancel'                                => 'abbrechen',
        'ended'                                 => 'Beendet',
        'upcoming'                              => 'Noch'
    ],

    // Confirmations

    'confirm'                               => [
        'Delete'                                => 'Wirklich löschen?',
        'Cancel'                                => 'Wirklich stornieren? Alle Teilnehmer/Trainer werden per eMail benachrichtigt.',
        'Restore'                               => 'Wirklich Reaktivieren?',
        'Edit'                                  => 'Sind alle Änderungen richtig?',
        'New'                                   => 'Sind alle Angaben richtig?',
    ],

    // Titles

    'showing-all-online'                        => 'Online',
    'showing-all-faceToFace'                    => 'FaceToFace',
    'users-menu-alt'                            => 'Show Users Management Menu',
    'editing-workshop'                          => 'Editing :name, Date  :date',
    'showing-workshop'                          => 'Showing :name',
    'showing-webex-title'                       => 'Webinar :name',


    // Edit Workshop
    'edit'                                   => [
    'remove-trainer'                            => '--Remove Trainer--',
    'status'                                    => 'Status',
    'topic_coreQuestions'                       => 'Inhalte - Kernfragen',


    ],


    // Flash Messages
    'createSuccess'                             => 'Workshop erfolgreich erstellt!',
    'updateSuccess'                             => 'Workshop erfolgreich bearbeitet! ',
    'deleteSuccess'                             => 'Workshop erfolgreich gelöscht! ',
    'cancelSuccess'                             => 'Workshop erfolgreich storniert! ',
    'uncancelSuccess'                           => 'Workshop Status erfolgreich Inaktiv geändert! ',

    // Labels For Workshop Show
    'labels'                                 => [
    'webex'                                  => 'Titel: ',
    'webex_additional_title'                 => 'Zusatztitel: ',
    'Clients'                                   => 'Teilnehmerliste: ',
    'Location'                                  => 'Location :',
    'StartDate'                                 => 'Start :',
    'EndDate'                                   => 'Ende :',
    'Date'                                      => 'Datum :',
    'ProcessFlow'                               => 'Ablauf:',
    'Misc'                                      => 'Sonstiges :',
    'MiscLink'                                  => 'Sonstiges Link :',
    'password'                                  => 'Webex Passwort :',
    'webLink'                                   => 'Webex Link :',
    'Targets'                                   => 'Zielgruppe :',
    'Details'                                   => 'Detail :',
    'Price'                                     => 'Netto Preis :',
    'OccupancyRate'                             => 'Auslastung :',
    'OccupancyRateClients'                      => '/12 gebucht',
    'Details'                                   => 'Nutzen - Zielsetzung : ',
    'TopicCoreQuestions'                        => 'Inhalte / Kernfragen :',
    'OtherDates'                                => 'Folgetermine:',
    'ChatRoom'                                  => 'Chat Room:',
    'Status'                                    => 'Status:',
    'CreatedAt'                                 => 'Erstellt am :',
    'UpdatedAt'                                 => 'Geändert am :',
    'DeletedAt'                                 => 'Gelöscht am :',
    'viewProfile'                               => 'Profil anzeigen',
    'addClients'                                => 'TN hinzufgen',
    'editClients'                               => 'TN ändern',
    'editWorkshop'                              => 'Bearbeiten',
    'deleteWorkshop'                            => 'Löschen',
    'canceledWorkshops'                         => 'Stornierte'
    ],

    // Labels For Workshop Create
    'forms'                                     => [
        'title'                                  => 'Titel: ',
        'additionalTitle'                 => 'Zusatztitel: ',
        'location'                                  => 'Standort :',
        'locationPh'                                => 'Bitte Wählen',
        'LocationIcon'                              => 'fa-map-marker',
        'trainer'                                  => 'Trainer :',
        'startDate'                                 => 'Startdatum :',
        'time'                                       => 'Uhrzeit :',
        'StartDateIcon'                             => 'fa-calendar',
        'endDate'                                   => 'Enddatum :',
        'EndDateIcon'                               => 'fa-calendar',
        'date'                                      => 'Datum :',
        'processFlow'                               => 'Ablauf :',
        'misc'                                      => 'Sonstiges :',
        'miscLink'                                  => 'Sonstiges Link :',
        'targets'                                   => 'Zielgruppe :',
        'details'                                   => 'Detail :',
        'price'                                     => 'Netto Preis :',
        'ccupancyRate'                             => 'Auslastung :',
        'OccupancyRateClients'                      => '/12 gebucht',
        'details'                                   => 'Nutzen - Zielsetzung : ',
        'topicCoreQuestions'                        => 'Inhalte / Kernfragen :',
        'OtherDates'                                => 'Weitere Daten:',
        'chatRoom'                                  => 'Chat Room:',
        'status'                                    => 'Status:',
        'CreatedAt'                                 => 'Erstellt am :',
        'UpdatedAt'                                 => 'Geändert am :',
        'DeletedAt'                                 => 'Gelöscht am :',
        'viewProfile'                               => 'Profil anzeigen',
        'addClients'                                => 'TN hinzufgen',
        'editClients'                               => 'TN ändern',
        'editWorkshop'                              => 'Bearbeiten',
        'deleteWorkshop'                            => 'Löschen',
        'canceledWorkshops'                         => 'Stornierte'
    ],

    // Labels For Workshop Index
    'index'                       => [
        'id'                                    => 'ID',
        'name'                                  => 'Workshop',
        'title'                                 => 'Titel:',
        'detail'                                => 'Nutzen - Zielsetzung:',
        'date'                                  => 'Datum:',
        'cancelDate'                            => 'Stornoablauf:',
        'location'                              => 'Location:',
        'trainer'                               => 'Trainer:',
        'trainerCount'                          => 'Anzahl Trainer:',
        'status'                                => 'Status:',
        'clientCount'                           => 'TN: ',
        'actions'                               => 'Optionen',
        'unbooked'                              => 'Keine Buchungen bisher..!',
        'onlyToday'                             => 'NUR HEUTE!',
        'until'                                 => 'Bis:',
        'ended'                                 => 'Endete am:',
        // Pagination Key Words
        'showing'                               => 'Zeige',
        'of'                                    => 'von',
        'workshops'                             => 'Workshops.',

    ],

    'buttons'                               => [
        'new'                                   => 'Erstellen',
        'cancel'                                => 'abbrechen',
        'cancelWorkshop'                        => 'Stornieren',
        'uncancelWorkshop'                      => 'Reaktivieren',
        'canceledWorkshops'                     => 'Storniert',
        'endedWorkshops'                        => 'Beendet',
        'delete'                                => 'Löschen',
        'show'                                  => 'Details',
        'edit'                                  => 'Bearbeiten',
        'editClients'                           => 'TN ändern',
        'backToWorkshops'                       => 'Zur Übersicht',
        'backToWorkshop'                        => 'Zurück zum Workshop',
        'group'                                 => 'Button Group',
        'active'                                => 'Aktive',
    ],

    'tooltips'                              => [
        'active'                                => 'Aktive Workshops anzeigen',
        'cancel'                                => 'Abbrechen',
        'cancelWorkshop'                        => 'Workshop stornieren',
        'uncancelWorkshop'                      => 'Workshop reaktivieren',
        'canceled'                              => 'Stornierte Workshops anzeigen',
        'delete'                                => 'Löschen',
        'show'                                  => 'Alle Details anzeigen',
        'edit'                                  => 'Workshop bearbeiten',
        'editClients'                           => 'Teilnehmer bearbeiten',
        'location'                              => 'Location',
        'trainer'                               => 'Trainer',
        'new'                                   => 'Neuen Workshop erstellen',
        'back-workshops'                        => 'Zurück zur Übersicht',
        'email-workshop'                        => 'Email :workshop',
        'submit-search'                         => 'Submit workshop Search',
        'clear-search'                          => 'Clear Search Results',
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
