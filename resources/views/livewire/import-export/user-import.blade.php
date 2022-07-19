

<div>
    <div class="container">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        Import
                        <button name="staffTags" wire:click.prevent="attachTagsToStaff()" label="Taggss">taggsss</button>

                    </div>
                </div>
                <div class="card-body">
                    {!! csrf_field() !!}
                    <div class="row">
                            <div class="col-md-6 col-12">
                                <x-shdw-file name="staffImport" label="Import"/>
                                <button name="import" wire:click.prevent="staffImport()">Mitarbeiter Import</button>
                            </div>
                            <div class="col-md-6 col-12">
                                <x-shdw-file name="staffTagsImport" label="Import"/>
                                <button name="import" wire:click.prevent="staffTagsImport()">Mitarbeiter Tags Import</button>
                                    </div>
                                </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-shdw-file name="companyTagsImport" label="Import"/>
                            <button name="import" wire:click.prevent="companyTagsImport()">Unternehmen Tags Import</button>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-shdw-file name="companiesImport" label="Import"/>
                            <button name="import" wire:click.prevent="companiesImport()">Unternehmen Import</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-shdw-file name="staffToCompanyImport" label="Import"/>
                            <button name="import" wire:click.prevent="staffToCompanyImport()">Mitarbeiter zu Unternehmen</button>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-shdw-file name="companiesImport" label="Import"/>
                            <button name="import" wire:click.prevent="companiesImport()">Unternehmen Import</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-shdw-file name="offersImport" label="Import"/>
                            <button name="import" wire:click.prevent="offersImport()">Angebote Import</button>
                        </div>
                        <div class="col-md-6 col-12">

                        </div>
                    </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
