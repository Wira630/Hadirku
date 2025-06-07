<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <title>Event Management</title>
  <style>
    @media (max-width: 640px) {
      .action-buttons {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        justify-content: flex-end;
      }
      .action-btn {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
      }
      .action-text {
        display: none;
      }
    }

    /* Desktop styles */
    @media (min-width: 641px) {
      .action-btn {
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
      }
      .action-text {
        display: inline;
        margin-left: 0.25rem;
      }
    }

    /* Floating button styles */
    .floating-btn {
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .floating-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
      background: #E53E3E;
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #C53030;
    }

    /* Focus styles */
    input:focus, button:focus {
      outline: none;
      ring: 2px;
      ring-color: #E53E3E;
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">

  <!-- Header -->
  <header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ url('/') }}" class="text-gray-600 hover:text-red-900 transition-colors">
          <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-800">Event Management</h1>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto p-4 sm:p-6">

    <!-- Search Bar -->
    <div class="mb-4 sm:mb-6">
      <form method="GET" action="{{ route('events.index') }}" class="w-full">
        <div class="relative">
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search events..."
            class="w-full pl-9 sm:pl-10 pr-3 sm:pr-4 py-2 text-sm sm:text-base rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
          />
          <div class="absolute left-2 sm:left-3 top-2 sm:top-2.5 text-gray-400">
            <i class="fas fa-search text-sm sm:text-base"></i>
          </div>
        </div>
      </form>
    </div>

    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
      </div>
    @endif

    <!-- Desktop Table View -->
    <div class="hidden md:block bg-white rounded-lg shadow overflow-hidden">
      <div class="grid grid-cols-12 bg-gray-50 px-4 py-3 border-b border-gray-200 text-red-600 font-medium text-sm uppercase tracking-wider">
        <div class="col-span-1">No</div>
        <div class="col-span-3">Title</div>
        <div class="col-span-4">Description</div>
        <div class="col-span-2">Date</div>
        <div class="col-span-2 text-right">Actions</div>
      </div>

      @forelse ($events as $event)
        <div class="grid grid-cols-12 px-4 py-3 border-b border-gray-100 hover:bg-gray-50 items-center transition-colors">
          <div class="col-span-1 text-gray-500">{{ $loop->iteration }}</div>
          <div class="col-span-3 text-gray-800 font-medium truncate">{{ $event->title }}</div>
          <div class="col-span-4 text-gray-600 truncate">{{ $event->description }}</div>
          <div class="col-span-2 text-sm text-gray-600">
            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
          </div>
          <div class="col-span-2 flex justify-end">
            <div class="action-buttons">
              <a href="{{ route('events.edit', $event->id) }}"
                 class="action-btn bg-red-50 text-red-600 hover:bg-red-100 transition-colors"
                 title="Edit">
                <i class="fas fa-edit"></i>
                <span class="action-text">Edit</span>
              </a>
              <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="action-btn bg-red-50 text-red-600 hover:bg-red-100 transition-colors"
                        title="Delete">
                  <i class="fas fa-trash-alt"></i>
                  <span class="action-text">Delete</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="empty-state px-4 py-8 text-center rounded-lg">
          <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
          <p class="text-gray-500 font-medium">No events found</p>
          <p class="text-gray-400 text-sm mt-1">Create your first event by clicking the + button</p>
        </div>
      @endforelse
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-3">
      @forelse ($events as $event)
        <div class="event-card bg-white rounded-lg shadow p-4 transition-all">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="event-title text-gray-800">{{ $event->title }}</h3>
              <p class="text-gray-500 text-sm mt-1">
                <i class="far fa-calendar-alt mr-1"></i>
                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
              </p>
            </div>
            <div class="action-buttons">
              <a href="{{ route('events.edit', $event->id) }}"
                 class="action-btn bg-blue-50 text-red-600 hover:bg-blue-100 transition-colors"
                 title="Edit">
                <i class="fas fa-edit text-sm"></i>
              </a>
              <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Delete this event?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="action-btn bg-red-50 text-red-600 hover:bg-red-100 transition-colors"
                        title="Delete">
                  <i class="fas fa-trash-alt text-sm"></i>
                </button>
              </form>
            </div>
          </div>
          @if($event->description)
            <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ $event->description }}</p>
          @endif
        </div>
      @empty
        <div class="empty-state px-4 py-8 text-center rounded-lg">
          <i class="fas fa-calendar-times text-3xl mb-3 text-gray-300"></i>
          <p class="text-gray-500 font-medium">No events found</p>
        </div>
      @endforelse
    </div>
  </main>

  <!-- Floating Add Event Button -->
  <a href="{{ route('events.create') }}" 
     class="floating-btn fixed bottom-5 right-5 bg-red-600 text-white rounded-full p-4 hover:bg-red-700 transition duration-200"
     title="Add Event">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
         stroke-linecap="round" stroke-linejoin="round">
      <line x1="12" y1="5" x2="12" y2="19"></line>
      <line x1="5" y1="12" x2="19" y2="12"></line>
    </svg>
    <span class="sr-only">Add Event</span>
  </a>

</body>
</html>