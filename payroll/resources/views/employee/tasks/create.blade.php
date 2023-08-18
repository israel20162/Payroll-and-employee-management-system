<html lang="en">
<x-employee-layout>
    <x-slot name='slot'>

        <body class="">
            <div class="container mx-auto p-8">
                <form method="POST" action="{{ route('employee.tasks.store') }}" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Task Name:</label>
                        <input type="text" id="name" name="title" required
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                        <textarea id="description" name="description" required
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    </div>
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date:</label>
                        <input type="date" id="due_date" name="due_date"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="assignee_id" class="block text-sm font-medium text-gray-700">Assign to:</label>
                        <select id="assignee_id" name="assignee_id"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Attach Files:</label>
                        <input type="file" name="attachments[]" multiple>


                    </div>
                    <div class="hidden">
                        <input type="text" name="assigner_id" value={{ session('user')->id }}>
                    </div>
                    <div>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create Task
                        </button>
                    </div>
                </form>


            </div>
        </body>




    </x-slot>
</x-employee-layout>

</html>
