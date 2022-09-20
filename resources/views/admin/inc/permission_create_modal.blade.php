
<div class="modal fade" id="modal-default-permission">
    <div class="modal-dialog">
         <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">ნებართვის დამატება</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('admin.permissions.store')}}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="name" :value="__('ნებართვის სახელი')" />

                <x-text-input id="name" class="block border-success mt-1 w-full" style="min-height: 30px" type="name" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ml-3">
                    {{ __('დამატება') }}
                </x-primary-button>
            </div>
        </form>
        </div>
        </div>
         <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal --></div>
