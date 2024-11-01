<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('New Event') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('events.store') }}" x-data="{
                mentor: null,
                onMentorChange(event) {
                    axios.get(`/mentor/${event.target.value}`)
                }
            }" enctype="multipart/form-data"
                class="p-4 bg-white dark:bg-slate-800 rounded-md">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="nama_event"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Event</label>
                        <input type="text" id="nama_event" name="nama_event"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Nama event">
                        @error('nama_event')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="mentor_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose a Mentor</label>
                        <select id="mentor_id" x-model="mentor" x-on:change="onCountryChange" name="mentor_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Pilih option</option>
                            @foreach ($mentor as $mentor)
                                <option :value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                            @endforeach
                        </select>
                        @error('mentor_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Upload file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input" type="file" name="image">
                        @error('image')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="tanggal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Tanggal event">
                        @error('tanggal')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="start_time"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                            Time</label>
                        <input type="time" id="start_time" name="start_time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="start time event">
                        @error('start_time')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="kuota"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">kuota</label>
                        <input type="number" id="kuota" name="kuota"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="1">
                        @error('kuota')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" name="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Tulis deskripsi disini..."></textarea>
                        @error('description')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>