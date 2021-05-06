<x-app-layout>

    @section('title') Update Employee Schedule | @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Employee Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('schedules.update', ['id' => Crypt::encryptString($schedule->id)]) }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
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
                            @if (session('failed'))
                                <div class="bg-red-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                                    <div class="flex">
                                        <div>
                                            <p class="font-bold">{{ session('failed') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="employee-id">
                                Employee 
                            </label>
                            <select name="employee_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->employee_id }}" @if($employee->employee_id == $schedule->employee_id) selected @endif>{{ $employee->employee_id }} | {{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Title
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" value="{{ $schedule->title }}" placeholder="Title" required>
                            @error('title')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="details">
                                Details
                            </label>
                            <textarea name="details" class="form-textarea mt-1 block w-full" rows="3" placeholder="Enter schedule details." required> {{ $schedule->details }}</textarea>
                            @error('details')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="schedule-date">
                                Select Schedule Date
                            </label>
                            <input type="date" value="{{ $schedule->schedule_date }}" id="schedule-date" name="schedule_date" required> 
                            @error('schedule_date')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="start-time">
                                Set Schedule Start Time
                            </label>     
                            <input type="time" value="{{ date('H:i', strtotime($schedule->schedule_start_time)) }}" id="start-time" name="schedule_start_time" min="00:00" max="24:00" required>
                            @error('schedule_start_time')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>           
                        <div class="mb-6 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="end-time">
                                Set Schedule End Time
                            </label>  
                            <input type="time" value="{{ date('H:i', strtotime($schedule->schedule_end_time)) }}" id="end-time" name="schedule_end_time" min="01:00" max="24:00" required>  
                            @error('schedule_end_time')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="mb-6 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="end-time">
                                Schedule Status
                            </label> 
                            <select name="is_active" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="1" @if($schedule->is_active == 1) selected @endif>Active</option>
                                <option value="0" @if($schedule->is_active == 0) selected @endif>Inactive</option>
                            </select>
                        </div>
                        <div class="items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Save
                            </button>
                            <a href="{{ route('schedules') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
