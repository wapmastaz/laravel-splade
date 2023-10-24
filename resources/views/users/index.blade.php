<x-layout>
  <x-slot name="header">
    {{ __('All Users') }}
  </x-slot>

  <x-panel class="flex flex-col items-center pt-16 pb-16">
    <x-application-logo class="block h-12 w-auto" />

    <div class="mt-8">
      <div class="my-4 flex justify-end">
        <Link href="{{ route('user.create') }}" class="bg-[blue] text-white rounded-3xl px-8 py-2">Add User</Link>
      </div>
      <x-splade-table :for="$users" pagination-scroll="head">
        @cell('action', $user)
          <Link class="bg-[red] text-white px-4 py-1 rounded-lg" href="{{ route('user.edit', $user->id) }}">Edit</Link>
        @endcell
      </x-splade-table>
    </div>
  </x-panel>
</x-layout>
