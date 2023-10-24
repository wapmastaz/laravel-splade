<x-layout>
  <x-slot name="header">
    {{ __('Edit User') }}
  </x-slot>

  <x-panel class="flex flex-col items-center pt-16 pb-16">
    <x-application-logo class="block h-12 w-auto" />

    <div class="mt-8">

      <x-splade-form method="put" action="{{route('user.update', $user->id)}}" :default="$user">

        <div class="relative mb-4">
          <x-splade-input name="name" type="text" v-model="form.name" placeholder="Your FullName" />
        </div>

        <div class="relative mb-4">
          <x-splade-input name="email" type="email" v-model="form.email" placeholder="Your Email Address" />
        </div>

        <div class="relative mb-4">
          <x-splade-select  name="role" v-model="form.role" placeholder="Select role..." :options="$roles"
            option-label="name" option-value="name" />
        </div>

        <x-splade-submit label="Update" :spinner="false" />
      </x-splade-form>

    </div>
  </x-panel>
</x-layout>
