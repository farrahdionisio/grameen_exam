<x-app-layout>

    @section('title') Employee Schedule | @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-2">
                        <label class="font-bold">Employee ID:</label> {{ $employee->employee_id }}
                    </div>
                    <div class="py-2">
                        <label class="font-bold">Employee Name:</label> {{ $employee->name }}
                    </div>
                    <div class="py-2">
                        <label class="font-bold">Country:</label> {{ $employee->country_name }}
                    </div>
                    <div class="py-2">
                        <label class="font-bold">Record Created At:</label> {{ $employee->created_at }}
                    </div>
                    <div class="mb-10 mt-10">
                        <a href="{{ route('employees.edit', ['id' => Crypt::encryptString($employee->employee_id)]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Update Employee Record
                        </a>
                    </div>
                    <!-- <div class="py-2"> -->
                    <!-- <label class="font-bold">Employee Schedule</label>
                        @foreach($employee->employee_schedule as $schedule)
                        <div class="py-2">
                            <label class="font-bold">:</label> {{ $employee->created_at }}
                        </div>
                        @endforeach -->
                </div>
            </div>
        </div>
    </div>

</x-app-layout>