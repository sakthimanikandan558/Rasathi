<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Validation</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="py-10 grid grid-cols-2 w-[70%] m-auto">
    <div class="">
        <div class="max-w-3xl mx-auto bg-white p-5 rounded-lg shadow-lg w-[80%]">
            @if (session('success'))
                <p class="text-green-600 mb-4">{{ session('success') }}</p>
            @endif

            <form action="/form" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Name:</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="border border-gray-300 rounded-lg p-2 w-full">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Age:</label>
                    <input type="number" name="age" value="{{ old('age') }}"
                        class="border border-gray-300 rounded-lg p-2 w-full">
                    @error('age')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="border border-gray-300 rounded-lg p-2 w-full">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Course:</label>
                    <select name="course" id="course" class="border border-gray-300 rounded-lg p-2 w-full">
                        <option value="">Select Course</option>
                        <option value="medical">Medical</option>
                        <option value="engineering">Engineering</option>
                        <option value="arts">Arts</option>
                    </select>
                    @error('course')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">College:</label>
                    <select name="college" id="college" class="border border-gray-300 rounded-lg p-2 w-full">
                        <option value="">Select College</option>
                    </select>
                    @error('college')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Department:</label>
                    <select name="department" id="department" class="border border-gray-300 rounded-lg p-2 w-full">
                        <option value="">Select Department</option>
                    </select>
                    @error('department')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Mobile Number:</label>
                    <input type="text" name="mobile" value="{{ old('mobile') }}"
                        class="border border-gray-300 rounded-lg p-2 w-full">
                    @error('mobile')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">File Upload (PDF):</label>
                    <input type="file" name="file" class="border border-gray-300 rounded-lg p-2 w-full">
                    @error('file')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-green-500 text-white rounded-lg p-2 w-full hover:bg-blue-600 transition">
                    Submit
                </button>
            </form>
        </div>
    </div>
    <div class="">
        <img class="" src="https://visme.co/blog/wp-content/uploads/2023/03/How-to-Make-Your-Newsletter-Signup-Form-Stand-Out-from-the-Rest-Thumbnail.jpg" alt="no image">
    </div>


    <script>
        const colleges = {
            medical: ['medical clg1', 'medical clg2', 'medical clg3'],
            engineering: ['ece', 'it', 'cse'],
            arts: ['arts clg1', 'arts clg2', 'arts clg3']
        };

        const departments = {
            medical: ['mbbs', 'bds'],
            engineering: ['ece', 'it', 'cse'],
            arts: ['fine arts', 'literature'],
        };

        $('#course').change(function() {
            const course = $(this).val();
            const collegeSelect = $('#college');
            collegeSelect.empty().append('<option value="">Select College</option>');
            if (colleges[course]) {
                colleges[course].forEach(college => {
                    collegeSelect.append(`<option value="${college}">${college}</option>`);
                });
            }

            const departmentSelect = $('#department');
            departmentSelect.empty().append('<option value="">Select Department</option>');
            if (departments[course]) {
                departments[course].forEach(department => {
                    departmentSelect.append(`<option value="${department}">${department}</option>`);
                });
            }
        });
    </script>
</body>

</html>
