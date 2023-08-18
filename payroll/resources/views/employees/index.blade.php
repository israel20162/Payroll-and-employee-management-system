<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Mata Tags -->
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Employees</title>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employees') }}
            </h2>
            <div class="p-6">


            </div>
        </x-slot>


        <x-slot name="slot">
            <div x-data="{ tab: 'home' }" class="bg-white w-full mt-4">
                <nav class="flex bg-white w-full space-x-4 !text-lg">
                    <button :class="{ 'bg-blue-500 text-white ': tab === 'home' }"
                        class="px-3 py-2 font-bold text-gray-500  rounded-md " @click="tab = 'home'">All</button>
                    <button :class="{ 'bg-blue-500 text-white ': tab === 'about' }"
                        class="px-3 py-2 font-medium text-gray-500 rounded-md " @click="tab = 'about'">Roles</button>
                    <button :class="{ 'bg-blue-500 text-white ': tab === 'services' }"
                        class="px-3 py-2 font-medium text-gray-500 rounded-md "
                        @click="tab = 'services'">Services</button>
                </nav>

                <div class="mt-4">
                    <div x-show="tab === 'home'">
                        <div class='bg-gray-60 mt-4 border-none  '
                            style='border:none;background-color:white;max-width:100%;'>

                            <form action='/search'method='POST' class='bg-transparent' role='search'>
                                @csrf
                                <div class=' items-center justify-between flex gap-1 bg-inherit '
                                    style='background-color:transparent'>
                                    <div class="flex items-center " style="align-items: center;margin: 0">
                                        <a href={{ route('employees.create') }}><button
                                                class="text-center rounded bg-green-500 my-auto py-2 px-4 ml-3 "
                                                style="margin-top: " type="button">
                                                <span class="text-extrabold text-xl text-center">+</span> Add new
                                            </button></a>

                                    </div>
                                    <div>
                                        <input type='text' class='form-control rounded form-input  m-2 px-2'
                                            name='q' placeholder='Search Employees' />
                                        <span class='input-group-btn'>
                                            <button type='submit'
                                                class='bg-blue-500 text-sm hover:bg-blue-600 text-white font-bold py-2 px-4 rounded'>
                                                Search
                                            </button>
                                        </span>
                                    </div>

                                </div>
                            </form>

                        </div>

                        <div class="font-semibold text-xl text-gray-800 leading-tight">
                            <table class="min-w-full text-left text-sm font-light border border-black rounded tab ">
                                <thead class="border-b    font-extrabold dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 !capitalize">#</th>
                                        @foreach ($headings as $heading)
                                            <th scope="col" class="px-6 py-4 !whitespace-nowrap     !capitalize "
                                                style="text-transform:capitalize">
                                                {{ $heading }} </th>
                                        @endforeach



                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($message))

                                        <tr class='text-4xl text-center mx-auto w-full row-span-full'>
                                            <td colspan='8'>
                                                {{ $message }}</td>
                                        </tr>
                                    @else
                                        @foreach ($employees as $employee)
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                    {{ $employee->id }}</td>
                                                <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                                    style="white-space: nowrap;">{{ $employee->name }}</td>
                                                <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                                    style="white-space: nowrap;">{{ $employee->contact }}</td>
                                                <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                                    style="white-space: nowrap;">{{ $employee->employee_id }}</td>
                                                <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                                    style="white-space: nowrap;">{{ $employee->department }}
                                                </td>
                                                <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize truncate "
                                                    style="white-space: ;max-width:170px">{{ $employee->position }}
                                                </td>
                                                <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                                    style="white-space: nowrap;">
                                                    ${{ number_format($employee->current_salary, 2) }}
                                                </td>


                                            </tr>
                                        @endforeach
                                    @endif



                                </tbody>
                            </table>
                            <div class='p-2 px-12'>
                                {{ $employees->links() }}
                            </div>

                        </div>
                    </div>

                    <div x-show="tab === 'about'" class="bg-white w-full">
                        <div class="flex justify-end w-full">
                            <button class="rounded px-4 py-2 m-2 bg-green-500" onclick="toggleAssignModal()">Assign
                                Role</button>
                            <button class="rounded px-4 py-2 m-2 bg-blue-500" onclick="toggleCreateModal()">Create new
                                Role</button>

                        </div>
                        <!-- Content for Roles tab goes here -->
                        <table class="min-w-full divide-y divide-gray-200 rounded mt-2">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Permissions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $role->name }}
                                        </td>
                                        <td class="px-6 py-4 ">
                                            @foreach ($role->permissions->pluck('name') as $permission)
                                                <span
                                                    class="capitalize rounded p-2 bg-green-500 text-white">{{ $permission }}</span>
                                            @endforeach

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>

                    <div x-show="tab === 'services'">
                        <!-- Content for Services tab goes here -->
                        <p>Services content...</p>
                    </div>
                </div>
            </div>

            {{-- assign role modal --}}
            <div class="fixed z-10 inset-0 overflow-y-auto hidden " id="assign-modal" aria-labelledby="modal-title"
                role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                        onclick="toggleAssignModal()" aria-hidden="true"></div>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg flex items-center justify-between leading-6 font-medium text-gray-900"
                                id="modal-title">
                                <span>Create Role</span>
                                <span class="text-3xl font-bold cursor-pointer" onclick="toggleAssignModal()">x</span>
                            </h3>
                            <div class="mt-2">

                                <form method="POST" action={{ route('employees.assignRole') }} class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="employee"
                                            class="block text-sm font-medium text-gray-700">Employee:</label>
                                        <select id="employee" name="employee"
                                            class="mt-1 block capitalize w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="role"
                                            class="block text-sm font-medium text-gray-700">Role:</label>
                                        <select id="role" name="role"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Assign Role
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- create role modal --}}
            <div class="fixed z-10 inset-0 overflow-y-auto hidden " id="create-modal" aria-labelledby="modal-title"
                role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                        onclick="toggleCreateModal()" aria-hidden="true"></div>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg flex items-center justify-between leading-6 font-medium text-gray-900"
                                id="modal-title">
                                <span>Create Role</span>
                                <span class="text-3xl font-bold cursor-pointer" onclick="toggleCreateModal()">x</span>
                            </h3>
                            <div class="mt-2">


                                <form method="POST" action="{{ route('roles.store') }}" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Role
                                            Name:</label>
                                        <input type="text" id="name" name="name" required
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="permissions"
                                            class="block text-sm font-medium text-gray-700">Permissions:</label>
                                        <div class="mt-2 space-y-1 grid-cols-2 grid">
                                            @foreach ($permissions as $permission)
                                                <div>
                                                    <label class="inline-flex capitalize items-center">
                                                        <input type="checkbox"
                                                            class="form-checkbox rounded  text-indigo-600"
                                                            value="{{ $permission->name }}" name="permissions[]">
                                                        <span
                                                            class="ml-2 text-sm text-gray-700">{{ $permission->name }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Create Role
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>

        @push('scripts')
            <script>
                function toggleCreateModal() {
                    document.getElementById('create-modal').classList.toggle('hidden');
                }

                function toggleAssignModal() {
                    document.getElementById('assign-modal').classList.toggle('hidden');
                }
            </script>




            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        @endpush
    </x-app-layout>

</body>

</html>
