<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <x-index-create>

      <livewire:companies.show-company :company="$company"/>
    </x-index-create>
{{--    <script>--}}
{{--        $(document).on('click', '.btnRem', function(){--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}
{{--            var route = "{{ url('companies/destroy/'.$company->slug) }}";--}}
{{--            var url = '/companies';--}}
{{--            var company = <?php echo $company ?>;--}}
{{--            Swal.fire({--}}
{{--                title: `{{trans('companies.confirm.delete')}}`,--}}
{{--                text: "{{trans('companies.confirm.deleteText')}}",--}}
{{--                icon: "warning",--}}
{{--                showCancelButton: true,--}}
{{--                confirmButtonText: '{{trans('companies.buttons.confirm')}}',--}}
{{--                cancelButtonText: '{{trans('companies.buttons.cancel')}}',--}}
{{--            }).then((result) => {--}}
{{--                if (result.isConfirmed) {--}}
{{--                    $.ajax(--}}
{{--                        {--}}
{{--                            type: 'GET',--}}
{{--                            url: route,--}}
{{--                            success: function(){--}}

{{--                                Swal.fire({--}}
{{--                                    position: 'top-end',--}}
{{--                                    icon: 'success',--}}
{{--                                    title: '{{trans('companies.success.delete')}}',--}}
{{--                                    showConfirmButton: false,--}}
{{--                                    timer: 1500--}}
{{--                                })--}}
{{--                                window.location = url;--}}
{{--                            }--}}
{{--                        }--}}
{{--                    )--}}
{{--                }--}}
{{--            })--}}

{{--        });--}}
    </script>
</x-app-layout>
