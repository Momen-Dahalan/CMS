<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('هذه منطقة آمنة للتطبيق. يرجى تأكيد كلمة المرور الخاصة بك قبل الاستمرار.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('site.password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('تأكيد') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
