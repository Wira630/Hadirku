<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <title>Create User</title>
  <style>
    .form-input {
      transition: all 0.3s ease;
    }
    .form-input:focus {
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }
    .form-select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 0.5rem center;
      background-repeat: no-repeat;
      background-size: 1.5em 1.5em;
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">

  <!-- Header -->
  <header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-red-700 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-800">Create New User</h1>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto p-4 sm:p-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    </div>

<!-- Create Form Card (Lebar Diperkecil) -->
<div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200 max-w-md mx-auto">
  <!-- Card Header -->
  <div class="px-4 py-3 border-b bg-gradient-to-r from-red-600 to-red-700">
    <h3 class="text-lg font-semibold text-white">
      <i class="fas fa-user-plus mr-2"></i>User Information
    </h3>
  </div>

  <!-- Card Body -->
  <div class="p-4">
    <!-- Error Messages -->
    @if ($errors->any())
      <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded-lg">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <i class="fas fa-exclamation-circle text-red-500"></i>
          </div>
          <div class="ml-3">
            <h3 class="text-sm font-medium text-red-800">
              There were {{ $errors->count() }} errors with your submission
            </h3>
            <div class="mt-1 text-sm text-red-700">
              <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    @endif

    <!-- Form -->
    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Name Field -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
          Full Name
        </label>
        <div class="relative rounded-md shadow-sm">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-user text-gray-400"></i>
          </div>
          <input 
            type="text" 
            name="name" 
            id="name" 
            value="{{ old('name') }}"
            class="form-input block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500"
            placeholder="Enter Full Name"
            required
          >
        </div>
      </div>

      <!-- Email Field -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
          Email Address
        </label>
        <div class="relative rounded-md shadow-sm">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-envelope text-gray-400"></i>
          </div>
          <input 
            type="email" 
            name="email" 
            id="email" 
            value="{{ old('email') }}"
            class="form-input block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500"
            placeholder="example@email.com"
            required
          >
        </div>
      </div>

      <!-- Gender Field -->
      <div>
        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">
          Gender
        </label>
        <div class="relative rounded-md shadow-sm">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-venus-mars text-gray-400"></i>
          </div>
          <select 
            name="gender" 
            id="gender"
            class="form-select block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500"
          >
            <option value="">Select Gender</option>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
          </select>
        </div>
      </div>

      <!-- Form Actions -->
      <div class="flex items-center justify-end pt-4 border-t border-gray-200">
        <a 
          href="{{ route('users.index') }}" 
          class="mr-3 inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
        >
          <i class="fas fa-times mr-1"></i> Cancel
        </a>
        <button 
          type="submit"
          class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
        >
          <i class="fas fa-save mr-1"></i> Create User
        </button>
      </div>
    </form>
  </div>
</div>
  </main>
</body>
</html>