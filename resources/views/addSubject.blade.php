<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Style for the selected items container */
        #selectedItems {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        /* Style for each selected item */
        .selected-item {
            background-color: #ddd;
            padding: 5px;
            margin: 5px;
            border-radius: 3px;
            display: flex;
            align-items: center;
        }

        /* Style for the remove button on selected items */
        .remove-btn {
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Subject') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form action="{{ route('subject.user', ['id' => $id]) }}" method="post">
                    @csrf
                    <div>
                        <label>Select Subjects:</label>
                        @foreach ($subjects as $subject)
                            <div class="form-check">
                                @if (in_array($subject->id, $userSubjectIds))
                                    <input class="form-check-input" type="checkbox" name="subjects[]"
                                        value="{{ $subject->id }}" id="subject_{{ $subject->id }}" checked>
                                    <label class="form-check-label" for="subject_{{ $subject->id }}">
                                        {{ $subject->subject_name }}
                                    </label>
                                @else
                                    <input class="form-check-input" type="checkbox" name="subjects[]"
                                        value="{{ $subject->id }}" id="subject_{{ $subject->id }}">
                                    <label class="form-check-label" for="subject_{{ $subject->id }}">
                                        {{ $subject->subject_name }}
                                    </label>
                                @endif
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-outline-secondary"
                            onclick="return confirm('Are you sure you want to add?')">Add Selected Subjects</button>
                    </div>
                </form>
            </div>
        </div>

    </x-app-layout>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedItemsContainer = document.getElementById('selectedItems');
            var dropdown = document.getElementById('dropdown');

            dropdown.addEventListener('change', function() {
                for (var i = 0; i < dropdown.options.length; i++) {
                    var option = dropdown.options[i];
                    if (option.selected && !isOptionSelected(option.value)) {
                        addSelectedItem(option.value, option.text);
                    }
                }
                var selectedValues = Array.from(dropdown.options)
                    .filter(option => option.selected)
                    .map(option => option.value);
                console.log(selectedValues);
            });

            function addSelectedItem(value, text) {
                var selectedItem = document.createElement('div');
                selectedItem.className = 'selected-item';
                selectedItem.textContent = text;

                var removeBtn = document.createElement('span');
                removeBtn.className = 'remove-btn';
                removeBtn.innerHTML = '&times;';

                removeBtn.addEventListener('click', function() {
                    selectedItemsContainer.removeChild(selectedItem);
                    // Remove corresponding option in the dropdown
                    var option = Array.from(dropdown.options).find(opt => opt.value === value);
                    if (option) {
                        option.selected = false;
                    }
                });

                selectedItem.appendChild(removeBtn);
                selectedItemsContainer.appendChild(selectedItem);
            }

            function isOptionSelected(value) {
                return Array.from(selectedItemsContainer.children).some(item => item.textContent.trim() === value);
            }
        });
    </script> --}}



</body>

</html>
