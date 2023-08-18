<x-employee-layout>
    <x-slot name='slot'>
        <div class="container mx-auto">
            <div class="flex flex-col gap-10 mt-8">
                <div class="w-full">
                    <h1 class="text-3xl capitalize font-bold mb-4">
                        {{ $task->title }}
                    </h1>
                    <div class="flex gap-10 capitalize">
                        <p class="text-sm">
                            Assigned to: {{ $task->assignee->name }}
                        </p>
                        <p class="text-sm">
                            By: {{ $task->assigner->name }}
                        </p>

                    </div>
                    <p class=" mb-4 m-12 first-letter:capitalize text-4xl">
                        {{ $task->description }}
                    </p>



                    @if ($task->files )
                        @if ($task->files->count())
                            <div class="m-12">
                                <h2 class="mt-4 text-lg">Files</h2>

                                <ul class="list-reset">

                                    <li class="mb-2">
                                        <a href="" class="text-blue-500 hover:text-blue-600">
                                            {{ $task->files->original_name }}
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        @endif


                        @if ($task->files->count() > 1)
                            <h2 class="mt-4">Files</h2>

                            <ul class="list-reset">
                                @foreach ($task->files as $file)
                                    <li class="mb-2">
                                        <a href="" class="text-blue-500 hover:text-blue-600">
                                            {{ $file->original_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                  
                    @endif




                </div>
            </div>
        </div>
    </x-slot>
</x-employee-layout>
