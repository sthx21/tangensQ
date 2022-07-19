<div>
    <div class="container">
        <div class="col-lg-12 ">
            <div class="card">
                <div class="card-header">
                <span>Reminder erstellen</span>
                </div>
                <div class="card-body">
                    {!! csrf_field() !!}

                    <div class="col-12 col-md-6">
                        <x-shdw-input type="date" name="reminder.due_date" label="Errinerungs Datum"/>
                    </div>
                </div>
            </div>

            <div class="row">

                    <x-shdw-input name="reminder.title" label="Titel"/>

                    <x-shdw-input type="text" name="reminder.description" label="Text"/>
                </div>



            </div>
            <div class="row pt-3 col-6 d-flex">
                <div class="d-flex justify-content-end">
                    <button class="storeButton" name="storeButton" wire:click.prevent="store()">Erstellen</button>
                </div>
            </div>
        </div>
    </div>
