<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                
                <form method="POST" action="{{route('ticket.store') }}">
                 @csrf

            <!-- Subject -->
            <div>
                <x-errored-label for="subject" :value="__('Subject')" :field="'subject'" />
                <x-input id="subject" class="block mt-4 w-full" type="text" name="subject" :value="old('subject')" />
            </div>

            <!-- Contents -->
            <div>
                <x-errored-label for="contents" :value="__('Contents')" :field="'contents'" />
                <x-textarea id="contents" class="block mt-4 w-full" name="contents" >{{ old('contents')}} </x-textarea>
            </div>

            <!-- category -->
            <div>
                <x-errored-label for="category" :value="__('Category')" :field="'category'" />
                    <x-select id="category" class="block mt-4 w-full" name="category" size="{{ $categories->count() }}" >
                    @foreach ( $categories as $category )
                    <option value="{{$category->id}}" {{ $category->id == old('category') ? 'selected' : '' }} > {{$category->name}}  </option>
                    @endforeach
                </x-select>
            </div>


            <!-- Apply (or not) -->
            <!-- <div class="block mt-4">
                <label for="apply" class="inline-flex items-center">
                    <input id="apply" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="apply">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Apply') }}</span>
                </label>
            </div> -->


            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Make Ticket') }}
                </x-button>
            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
