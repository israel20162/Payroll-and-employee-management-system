<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- <div>
        {{ $employees }}


    </div> --}}

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <div class="flex flex-col overflow-x-auto">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class=" ">
                                    <div class='bg-slate-200 rounded-lg w-1/3 shadow-md p-4 py-8 '>
                                        <div class='flex items-center  justify-between'>
                                            <div class='text-gray-600'>Total Employees</div>
                                            <div class=' text-2xl font-bold text-gray-900'>{{$total_employees}}</div>
                                        </div>
                                    </div>
                                    <table class="min-w-full text-left text-sm font-light">
                                        <thead class="border-b    font-extrabold dark:border-neutral-500">
                                            <tr>
                                                <th scope="col" class="px-6 py-4 !capitalize">#</th>
                                                @foreach ($headings as $heading)
                                                    <th scope="col"
                                                        class="px-6 py-4 !whitespace-nowrap     !capitalize "
                                                        style="text-transform:capitalize">
                                                        {{ $heading }} </th>
                                                @endforeach



                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                        style="white-space: nowrap;">${{ $employee->current_salary }}
                                                    </td>


                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='p-2'>
        {{ $employees->links() }}
    </div>

</x-app-layout>
