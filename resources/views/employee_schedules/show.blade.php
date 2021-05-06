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
                        <label class="font-bold">Schedule ID:</label> {{ $schedule->id }}
                    </div>
                    <div class="py-2">
                        <label class="font-bold">Title:</label> {{ $schedule->title }}
                    </div>
                    <div class="py-2">
                        <label class="font-bold">Details:</label> {{ $schedule->details }}
                    </div>
                    <div class="py-2">
                        <label class="font-bold">Employee Name:</label> {{ $schedule->employee->name }}
                    </div>
                    <div class="py-2">
                        <label class="font-bold">Schedule Date:</label> {{ $schedule->schedule_date }}
                    </div>
                    <div class="py-2">
                        <label class="font-bold">Start Time:</label> {{ $schedule->schedule_start_time }}
                    </div>
                    <div class="py-2">
                        <label class="font-bold">End Time:</label> {{ $schedule->schedule_end_time }}
                    </div> 
                    <div class="mb-10 mt-10">
                        <a href="{{ route('schedules.edit', ['id' => Crypt::encryptString($schedule->id)]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Update Schedule
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>