@extends('layouts.blog')

@section('content')
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">
                Create Post
            </h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="text-align: center;">

        <!-- This is a test and not a part of the actual blog -->
        <form id="dynamic-form">
            <div id="input-container">
                <!-- Initial input field -->
                <div>
                    <label for="item1">Item 1:</label>
                    <input type="text" name="item1">
                </div>
            </div>
            <button type="button" onclick="addInputField()">Add Input</button>
            <button type="submit">Submit</button>
        </form>

        <script>
            let counter = 1;

            function addInputField() {
                counter++;
                const inputContainer = document.getElementById('input-container');

                const newInput = document.createElement('div');
                newInput.innerHTML = `
                <label for="item${counter}">Item ${counter}:</label>
                <input type="text" name="item${counter}">
            `;

                inputContainer.appendChild(newInput);
            }
        </script>
        <!-- /// end of the test. -->

        <form
            action="{{ route('post.store')}}"
            method="POST"
            enctype="multipart/form-data">
            @csrf

            <input
                type="text"
                name="title"
                placeholder="Title..."> <br>
            <input
                type="text"
                name="category"
                placeholder="Category"> <br>

            <textarea
                name="description"
                placeholder="Description..."></textarea> <br>

            <textarea
                name="content"
                placeholder="Content..."></textarea> <br>

            <div>
                <label>
                <span>
                    {{ __('Select a file') }}
                </span>
                    <input
                        type="file"
                        name="image"
                        class="hidden">
                </label>
            </div> <br>

            <button
                type="submit"
                class="btn btn-primary">
                Submit Post
            </button>
        </form>
    </div>

@endsection
