@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Quiz Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_question_index', ['id' => $question->quiz_id]) }}"><i class="bi bi-caret-left-fill"></i>
            Go Back</a>
    </div>

    <div class="form-wrap">
        <form action="{{ route('teacher_question_update', ['id' => $question->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row gy-2 gx-3">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="question_id" class="form-label">Question ID</label>
                        <input type="text" class="form-control" value="{{ $question->id }}" disabled readonly>
                    </div>
                    @error('question_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" id="question" name="question"
                            value="{{ old('question', $question->question) }}">
                    </div>
                    @error('question')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="option1" class="form-label">Option 1</label>
                        <input type="text" class="form-control" onchange="updateSelect(1)" id="option1" name="option1"
                            value="{{ old('option1', $question->option1) }}">
                    </div>
                    @error('option1')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="option2" class="form-label">Option 2</label>
                        <input type="text" class="form-control" onchange="updateSelect(2)" id="option2" name="option2"
                            value="{{ old('option2', $question->option2) }}">
                    </div>
                    @error('option2')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="option3" class="form-label">Option 3</label>
                        <input type="text" class="form-control" onchange="updateSelect(3)" id="option3" name="option3"
                            value="{{ old('option3', $question->option3) }}">
                    </div>
                    @error('option3')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="option4" class="form-label">Option 4</label>
                        <input type="text" class="form-control" onchange="updateSelect(4)" id="option4" name="option4"
                            value="{{ old('option4', $question->option4) }}">
                    </div>
                    @error('option4')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <script>
                    function updateSelect(x) {
                        var select = document.getElementById('selectOption' + x);
                        var option = document.getElementById('option' + x);
                        if (option.value == '' || option.value == null) {
                            select.innerHTML = 'Option ' + x;
                        } else {
                            select.innerHTML = option.value;
                        }
                    }
                </script>

                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="answer" class="form-label">Answer</label>
                        <select name="answer" id="answer" class="form-select">
                            <option id="selectOption1" value="1" @selected(old('answer', $question->answer) == 1)>{{ $question->option1 }}
                            </option>
                            <option id="selectOption2" value="2" @selected(old('answer', $question->answer) == 2)>{{ $question->option2 }}
                            </option>
                            <option id="selectOption3" value="3" @selected(old('answer', $question->answer) == 3)>{{ $question->option3 }}
                            </option>
                            <option id="selectOption4" value="4" @selected(old('answer', $question->answer) == 4)>{{ $question->option4 }}
                            </option>
                        </select>
                    </div>
                    @error('answer')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Save
                            Question</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
