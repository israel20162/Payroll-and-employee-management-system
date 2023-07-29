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
                {{ __('Departments') }}
            </h2>
        </x-slot>

        <x-slot name="slot">
            <div class='bg-gray-60 mt-4 border-none  ' style='border:none;background-color:white;max-width:100%;'>

                <form action='/search'method='POST' class='bg-transparent' role='search'>
                    @csrf
                    <div class=' items-center justify-between flex gap-1 bg-inherit '
                        style='background-color:transparent'>
                        <div class="flex items-center " style="align-items: center;margin: 0">
                            <a href={{ route('employees.create') }}><button
                                    class="text-center rounded bg-blue-500 my-auto py-2 px-4 ml-3 " style="margin-top: "
                                    type="button">
                                    <span class="text-extrabold text-xl text-center">+</span> Add new
                                </button></a>
                            <button onclick="toggleModal()"
                                class="text-center rounded bg-green-500 my-auto py-2 px-4 ml-3 " style="margin-top: "
                                type="button">
                                <span class="text-extrabold text-xl text-center">+</span> Import from Excel
                            </button>

                        </div>
                        <div>
                            <input type='text' class='form-control rounded form-input  m-2 px-2' name='q'
                                placeholder='Search Employees' />
                            <span class='input-group-btn'>
                                <button type='submit'
                                    class='bg-blue-500 text-sm hover:bg-blue-600 text-white font-bold py-2 px-4 rounded'>
                                    Search
                                </button>
                            </span>
                        </div>

                    </div>
                </form>

                <div class="table-responsive">
                    <table
                        class="min-w-full text-left text-sm font-light border border-black rounded tab ">
                        <thead class="table-light">
                            <caption>Table Name</caption>
                            <tr>
                                <th>#</th>
                                <th>Department</th>
                                <th>No of Employees</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($departments as $department)
                                <tr class="table-primary">
                                    <td scope="row">{{$department->id}}</td>
                                    <td>{{$department->name}}</td>
                                    <td>3</td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>


            </div>


            <!-- import excel modal -->
            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modal" aria-labelledby="modal-title"
                role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Import Excel File
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Your Excel file should be structured as follows:
                                    <br>
                                    Column 1: Name
                                <div class="flex"> <svg aria-hidden="true" fill="none"
                                        class="h-6 w-6 text-green-400 bg-clip-content" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <span class="text-sm text-red-900" style="color:">
                                        First row should be "Name",following rows in the columns are the name of the
                                        departments
                                    </span>
                                </div>


                                </p>
                                <p class="text-sm text-blue-700 mb-2">
                                    <span class="font-bold">Excel File Import Instructions:</span>
                                    <br>
                                    To ensure your data is imported correctly, please structure your Excel file as
                                    follows:
                                    <br>

                                    - Column 1: 'Name' (text format)
                                    <br>
                                    For example:
                                    <br>
                                    | Name |
                                    <br>
                                    | Sales |
                                    <br>
                                    | Marketing |
                                </p>

                                <form method="POST" action="{{ route('import.excel') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="file_upload" class="block text-sm font-medium text-gray-700">Choose
                                            file</label>
                                        <input type="file" name="file_upload" id="file_upload"
                                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Import
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
                function toggleModal() {
                    document.getElementById('modal').classList.toggle('hidden');
                }
            </script>
        @endpush
    </x-app-layout>

</body>

</html>
