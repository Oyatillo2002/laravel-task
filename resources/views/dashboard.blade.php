<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-green-500">
                    @if (auth()->user()->role->name == 'manager')
                        {{ __('Received Applications') }}
                        @foreach ($applications as $application)
                            <div class='mt-5'>
                                <div class="rounded-xl border p-5 mt-5 shadow-md w-9/12 bg-white">
                                    <div class="flex w-full items-center justify-between border-b pb-3">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]">
                                            </div>
                                            <div class="text-lg font-bold text-slate-700">{{ $application->user->name }}
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-8">
                                            <button
                                                class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs text-neutral-500 font-semibold">#
                                                {{ $application->id }}</button>
                                            <div class="text-xs text-neutral-500">{{ $application->created_at }}</div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div>
                                            <div class="mt-4 mb-6">
                                                <div class="mb-3 text-blue-500 font-bold">{{ $application->subject }}
                                                </div>
                                                <div class="text-sm text-neutral-600">{{ $application->message }}</div>
                                            </div>
                                            <div>
                                                <div class="flex items-center justify-between text-slate-500">
                                                    <div class="flex space-x-4 md:space-x-8">
                                                        {{ $application->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div
                                                class="border m-6 p-6 rounded hover:bg-gray-100 transition cursor-pointer flex flex-col items-center">
                                                @if (is_null($application->file_url))
                                                    No file
                                                @else
                                                    <a href="{{ asset('storage/' . $application->file_url) }}"
                                                        target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if ($application->answer()->exists())
                                        <div>
                                            <hr>
                                            <h3 class="text-xs font-bold mt-2 text-indigo-600">Answer:</h3>
                                            <p class="text-black">{{ $application->answer->body }}</p>
                                        </div>
                                    @else
                                        <div class="flex justify-end">
                                            <a href="{{ route('answers.create', ['application' => $application->id]) }}"
                                                type="button"
                                                class="middle none center mr-4 rounded-lg bg-green-500 py-1 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                data-ripple-light="true">
                                                Answer
                                            </a>
                                        </div>
                                    @endif
                                </div>
                        @endforeach()
                        {{ $applications->links() }}
                </div>
            @elseif(auth()->user()->role->name == 'client')
                {{-- {{ __("Your client") }} --}}

                @if (session()->has('error'))
                    <div class='flex flex-row bg-gray-900 h-10 w-[1170px] rounded-[30px]'>
                        <span
                            class='flex flex-col justify-center text-white font-bold grow-[1] max-w-[90%] text-center'>{{ session()->get('error') }}</span>
                        <div class='w-[10%] bg-yellow-400 rounded-r-2xl shadow-[0_0_20px_#ffbb3377]'></div>
                    </div>
                @endif

                <div class='flex items-center  from-teal-100 via-teal-300 to-teal-500 bg-white-to-br'>
                    <div class='w-full max-w-lg px-10 py-8 mx-auto  rounded-lg shadow-xl'>
                        <div class='max-w-md mx-auto space-y-6'>
                            <form action="{{ route('applications.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h2 class="text-2xl font-bold ">Submit your application</h2>
                                <hr class="my-6">
                                <label class="uppercase text-sm font-bold opacity-70">Subject</label>
                                <input type="text" name="subject" required
                                    class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
                                <label class="uppercase text-sm font-bold opacity-70">Message</label>
                                <textarea name="message" required rows="5"
                                    class=" p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none"></textarea>
                                <label class="uppercase text-sm font-bold opacity-70">file</label>
                                <input type="file" name="file"
                                    class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
                                <input type="submit"
                                    class="py-3 px-6 my-2 bg-emerald-500 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300"
                                    value="Send">
                            </form>

                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
