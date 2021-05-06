<x-app-layout>

    @section('title') Employees | @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Employee Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('employees.store') }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                    @csrf       
                        <div class="mb-4 md:w-1/2">
                            @if (session('success'))
                                <div class="bg-green-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                                    <div class="flex">
                                        <div>
                                            <p class="font-bold">{{ session('success') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="employee-id">
                                Employee ID
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="employee-id" type="text" name="employee_id" placeholder="Employee ID" required>
                            @error('employee_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="employee-name">
                                Employee Name
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="employee-name" type="text" name="name" placeholder="Employee Name" required>
                            @error('employee_name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="employee-name">
                                Country
                            </label>
                            <select name="country_code" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                @foreach($countries as $country)
                                <option value="{{ $country->key }}">{{ $country->value }}</option>
                                @endforeach
                            </select>
                            @error('country_code')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Save
                            </button>
                            <a href="{{ route('employees') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
