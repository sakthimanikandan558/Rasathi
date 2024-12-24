<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Library</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal-open {
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Container -->
    <div class="container mx-auto p-6 relative">

        <!-- Upload Button -->
        <button id="uploadButton"
            class="absolute top-4 right-4 bg-blue-500 text-white px-4 py-2 rounded shadow-lg hover:bg-blue-600">
            Upload New Image
        </button>

        <!-- Upload Modal -->
        <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-lg font-semibold mb-4">Upload Image</h2>
                <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="w-full border border-gray-300 p-2 rounded mb-4"
                        required>
                    <div class="flex justify-end">
                        <button type="button" id="closeModal"
                            class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Close</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Media Library -->
        <h1 class="text-2xl font-bold mb-4">photos</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($mediaItems as $media)
                @php
                    // Get the full URL
                    $fullUrl = $media->getUrl();

                    // Parse the URL to get the path
                    $path = parse_url($fullUrl, PHP_URL_PATH);
                @endphp
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ $path }}" alt="no image" class="w-full h-[500px] object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold mb-2">{{ $media->file_name }}</h2>
                        <button class="text-blue-500 hover:underline"
                            onclick="showDetails('{{ $path }}', '{{ $media->file_name }}')">
                            View Details
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Details Modal -->
        <div id="detailsModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-[30%]">
                <button id="closeDetails" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <img id="detailImage" src="" alt="no image" class="w-full h-[20%] mb-4">
                <p id="detailName" class="text-lg font-semibold"></p>
                <button id="backButton" class="bg-gray-500 text-white px-4 py-2 rounded">Back</button>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal Functionality -->
    <script>
        document.getElementById('uploadButton').addEventListener('click', function() {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.body.classList.add('modal-open');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('uploadModal').classList.add('hidden');
            document.body.classList.remove('modal-open');
        });

        document.getElementById('closeDetails').addEventListener('click', function() {
            document.getElementById('detailsModal').classList.add('hidden');
            document.body.classList.remove('modal-open');
        });

        document.getElementById('backButton').addEventListener('click', function() {
            document.getElementById('detailsModal').classList.add('hidden');
            document.body.classList.remove('modal-open');
        });
    </script>

</body>

</html>



{{-- <!DOCTYPE html>
<html>
<head>
    <title>Media Library</title>
</head>
<body>
    <h1>Upload Media</h1>
    <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <h1>Media Library</h1>
    <ul>
        @foreach ($mediaItems as $media)
            <li>
                <a href="{{ $media->getUrl() }}">{{ $media->file_name }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html> --}}
