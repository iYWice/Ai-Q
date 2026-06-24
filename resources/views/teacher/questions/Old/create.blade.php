<h1>Add Question</h1>

<form method="POST" action="/teacher/exams/{{ $exam->id }}/questions">
    @csrf

    {{-- QUESTION TEXT --}}
    <div>
        <label>Question</label>
        <textarea name="question_text"
                  rows="3"
                  required></textarea>
    </div>

    <br>

    {{-- QUESTION TYPE --}}
    <div>
        <label>Question Type</label>

        <select name="question_type"
                id="question_type">

            <option value="mcq">Multiple Choice</option>
            <option value="tf">True / False</option>
            <option value="identification">Identification</option>

        </select>
    </div>

    <br>

    {{-- POINTS --}}
    <div>
        <label>Points</label>

        <input type="number"
               name="points"
               value="1"
               min="1"
               required>
    </div>

    <hr>

    {{-- ================= MCQ ================= --}}
    <div id="mcq-fields">

        <h3>Options</h3>

        <input type="text" name="options[]" placeholder="Option A">
        <br><br>

        <input type="text" name="options[]" placeholder="Option B">
        <br><br>

        <input type="text" name="options[]" placeholder="Option C">
        <br><br>

        <input type="text" name="options[]" placeholder="Option D">

        <br><br>

        <label>Correct Option</label>

        <select name="correct_option">

            <option value="0">Option A</option>
            <option value="1">Option B</option>
            <option value="2">Option C</option>
            <option value="3">Option D</option>

        </select>

    </div>

    {{-- ============== TRUE/FALSE ============== --}}
    <div id="true-false-fields" style="display:none;">

        <h3>Correct Answer</h3>

        <label>
            <input type="radio"
                   name="correct_answer"
                   value="True">

            True
        </label>

        <br>

        <label>
            <input type="radio"
                   name="correct_answer"
                   value="False">

            False
        </label>

    </div>

    {{-- ============== IDENTIFICATION ============== --}}
    <div id="identification-fields" style="display:none;">

        <h3>Correct Answer</h3>

        <input type="text"
               name="identification_answer"
               placeholder="Correct Answer">

    </div>

    <br>

    <button type="submit">
        Save Question
    </button>

</form>

<script>

const typeSelect =
document.getElementById('question_type');

const mcqFields =
document.getElementById('mcq-fields');

const tfFields =
document.getElementById('true-false-fields');

const idFields =
document.getElementById('identification-fields');

function toggleFields()
{
    const type = typeSelect.value;

    // hide all first
    mcqFields.style.display = 'none';
    tfFields.style.display = 'none';
    idFields.style.display = 'none';

    // MCQ
    if(type === 'mcq')
    {
        mcqFields.style.display = 'block';
    }

    // TRUE/FALSE
    if(type === 'tf')
    {
        tfFields.style.display = 'block';
    }

    // IDENTIFICATION
    if(type === 'identification')
    {
        idFields.style.display = 'block';
    }
}

typeSelect.addEventListener('change', toggleFields);

toggleFields();

</script>