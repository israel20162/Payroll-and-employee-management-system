<html lang="en">
<x-employee-layout>
    <x-slot name='slot'>

        <body class="">
            <div class="container mx-auto p-8">
                @can('give tasks')
                    <div class="flex justify-end w-full">
                        <a href="{{ route('employee.tasks.create', ['id' => session('user')->employee_id]) }}">
                            <button class="rounded px-4 py-2 bg-blue-500">Create Tasks</button>
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Task Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Due Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Assignee
                                </th>
                                  <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($given_tasks as $given_task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $given_task->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $given_task->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $given_task->due_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $given_task->assignee->name }}
                                    </td>
                                      <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $given_task->status }}
                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap text-xl font-semibold capitalize">
                                       <a href="/employee/tasks/{{$given_task->id}}">view</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No tasks found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endcan

                @if (in_array('give tasks',session('permissions',[])) == false)
  <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Task Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Due Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Assigner
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($tasks as $task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $task->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $task->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $task->due_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        {{ $task->assigner->name }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No tasks found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif





            </div>
        </body>




    </x-slot>
    @push('scripts')
        <script>
            document.getElementById('options-menu').addEventListener('click', function() {
                document.getElementById('dropdown-content').classList.toggle('hidden');
            });
        </script>
    @endpush
</x-employee-layout>

</html>
